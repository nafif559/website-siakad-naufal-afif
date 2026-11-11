<?php

/*
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : KrsController.php
Tanggal edit    : 10-11-2026
*/

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class KrsController extends Controller
{
    public function index(): View
    {
        return view('krs.index');
    }

    public function data(): JsonResponse
    {
        // Mengambil data KRS beserta identitas mahasiswa dan total SKS.
        $query = Krs::query()
            ->join('mahasiswa', 'krs.mahasiswa_id', '=', 'mahasiswa.id')
            ->leftJoin('krs_detail', 'krs.id', '=', 'krs_detail.krs_id')
            ->leftJoin('mata_kuliah', 'krs_detail.mata_kuliah_id', '=', 'mata_kuliah.id')
            ->select([
                'krs.id',
                'krs.mahasiswa_id',
                'krs.tahun_akademik',
                'krs.semester',
                'krs.status',
                'mahasiswa.nim',
                'mahasiswa.nama',
            ])
            ->selectRaw('COALESCE(SUM(mata_kuliah.sks), 0) as total_sks')
            ->groupBy(
                'krs.id',
                'krs.mahasiswa_id',
                'krs.tahun_akademik',
                'krs.semester',
                'krs.status',
                'mahasiswa.nim',
                'mahasiswa.nama'
            );

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (Krs $krs) {
                return view('krs._aksi', compact('krs'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('krs.create', [
            'krs' => new Krs(),
            'mahasiswa' => Mahasiswa::orderBy('nama')
                ->get(['id', 'nim', 'nama']),
            'mataKuliah' => MataKuliah::orderBy('kode_mk')
                ->get(['id', 'kode_mk', 'nama_mk', 'sks']),
            'mataKuliahTerpilih' => [],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        $krs = DB::transaction(function () use ($data) {
            $krs = Krs::create([
                'mahasiswa_id' => $data['mahasiswa_id'],
                'tahun_akademik' => $data['tahun_akademik'],
                'semester' => $data['semester'],
                'status' => $data['status'],
            ]);

            // Menyimpan daftar mata kuliah ke tabel krs_detail.
            $krs->mataKuliah()->sync($data['mata_kuliah_ids']);

            return $krs;
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'KRS mahasiswa berhasil ditambahkan.');
    }

    public function show(Krs $krs): View
    {
        $krs->load([
            'mahasiswa:id,nim,nama',
            'mataKuliah:id,kode_mk,nama_mk,sks',
        ]);

        return view('krs.show', compact('krs'));
    }

    //fitur cetak krs
    public function cetak(Krs $krs)
    {
        $krs->load([
            'mahasiswa:id,nim,nama',
            'mataKuliah:id,kode_mk,nama_mk,sks',
        ]);
    
        $pdf = Pdf::loadView('krs.pdf', compact('krs'))
            ->setPaper('a4', 'portrait');
    
        return $pdf->stream(
            'KRS-' . $krs->mahasiswa->nim . '.pdf'
        );
    }

    public function edit(Krs $krs): View
    {
        $krs->load('mataKuliah:id,kode_mk,nama_mk,sks');

        return view('krs.edit', [
            'krs' => $krs,
            'mahasiswa' => Mahasiswa::orderBy('nama')
                ->get(['id', 'nim', 'nama']),
            'mataKuliah' => MataKuliah::orderBy('kode_mk')
                ->get(['id', 'kode_mk', 'nama_mk', 'sks']),
            'mataKuliahTerpilih' => $krs->mataKuliah->pluck('id')->all(),
        ]);
    }

    public function update(Request $request, Krs $krs): RedirectResponse
    {
        $data = $this->validated($request, $krs);

        DB::transaction(function () use ($data, $krs) {
            $krs->update([
                'mahasiswa_id' => $data['mahasiswa_id'],
                'tahun_akademik' => $data['tahun_akademik'],
                'semester' => $data['semester'],
                'status' => $data['status'],
            ]);

            // Memperbarui daftar mata kuliah yang diambil.
            $krs->mataKuliah()->sync($data['mata_kuliah_ids']);
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil diperbarui.');
    }

    public function destroy(Krs $krs): JsonResponse
    {
        try {
            // Detail KRS akan ikut terhapus melalui cascadeOnDelete.
            $krs->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data KRS tidak dapat dihapus: masih dipakai data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data KRS berhasil dihapus.',
        ]);
    }

    /** Aturan validasi bersama untuk store dan update. */
    private function validated(Request $request, ?Krs $krs = null): array
    {
        return $request->validate([
            'mahasiswa_id' => [
                'required',
                'integer',
                Rule::exists('mahasiswa', 'id'),
            ],
            'tahun_akademik' => [
                'required',
                'string',
                'max:9',
                'regex:/^\d{4}\/\d{4}$/',
            ],
            'semester' => [
                'required',
                Rule::in(['Ganjil', 'Genap']),
                Rule::unique('krs', 'semester')
                    ->where(fn ($query) => $query
                        ->where('mahasiswa_id', $request->mahasiswa_id)
                        ->where('tahun_akademik', $request->tahun_akademik))
                    ->ignore($krs?->id),
            ],
            'status' => [
                'required',
                Rule::in(['draft', 'diajukan', 'disetujui', 'ditolak']),
            ],
            'mata_kuliah_ids' => [
                'required',
                'array',
                'min:1',
            ],
            'mata_kuliah_ids.*' => [
                'required',
                'integer',
                'distinct',
                Rule::exists('mata_kuliah', 'id'),
            ],
        ], [
            'mahasiswa_id.required' => 'Mahasiswa wajib dipilih.',
            'mahasiswa_id.exists' => 'Mahasiswa yang dipilih tidak ditemukan.',
            'tahun_akademik.required' => 'Tahun akademik wajib diisi.',
            'tahun_akademik.max' => 'Tahun akademik maksimal 9 karakter.',
            'tahun_akademik.regex' => 'Format tahun akademik harus YYYY/YYYY.',
            'semester.required' => 'Semester wajib dipilih.',
            'semester.in' => 'Pilihan semester tidak valid.',
            'semester.unique' => 'Mahasiswa sudah memiliki KRS untuk tahun akademik dan semester tersebut.',
            'status.required' => 'Status KRS wajib dipilih.',
            'status.in' => 'Pilihan status KRS tidak valid.',
            'mata_kuliah_ids.required' => 'Mata kuliah wajib dipilih.',
            'mata_kuliah_ids.array' => 'Pilihan mata kuliah tidak valid.',
            'mata_kuliah_ids.min' => 'Pilih minimal satu mata kuliah.',
            'mata_kuliah_ids.*.exists' => 'Mata kuliah yang dipilih tidak ditemukan.',
            'mata_kuliah_ids.*.distinct' => 'Mata kuliah tidak boleh dipilih lebih dari sekali.',
        ]);
    }
}
