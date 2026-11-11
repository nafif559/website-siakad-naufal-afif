<?php

/*
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : MataKuliahController.php
Tanggal edit    : 10-11-2026
*/

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('matakuliah.index');
    }

    public function data(): JsonResponse
    {
        // hanya kolom yang dibutuhkan tabel yang diambil dari database
        $query = MataKuliah::query()->select([
            'id',
            'kode_mk',
            'nama_mk',
            'sks'
        ]);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (MataKuliah $mataKuliah) {
                return view('matakuliah._aksi', compact('mataKuliah'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('matakuliah.create', [
            'mataKuliah' => new MataKuliah()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $mataKuliah = MataKuliah::create($this->validated($request));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah ' . $mataKuliah->nama_mk . ' berhasil ditambahkan.');
    }

    public function show(MataKuliah $mataKuliah): View
    {
        return view('matakuliah.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah): View
    {
        return view('matakuliah.edit', compact('mataKuliah'));
    }

    public function update(Request $request, MataKuliah $mataKuliah): RedirectResponse
    {
        $mataKuliah->update($this->validated($request, $mataKuliah));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah ' . $mataKuliah->nama_mk . ' berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah): JsonResponse
    {
        try {
            $mataKuliah->delete();
        } catch (QueryException $e) {
            // misalnya masih dirujuk foreign key dari tabel lain
            return response()->json([
                'message' => 'Data mata kuliah tidak dapat dihapus: masih dipakai data lain.',
            ], 409);
        }

        return response()->json([
            'message' => 'Data mata kuliah ' . $mataKuliah->nama_mk . ' berhasil dihapus.',
        ]);
    }

    /** Aturan validasi bersama untuk store dan update. */
    private function validated(Request $request, ?MataKuliah $mataKuliah = null): array
    {
        return $request->validate([
            'kode_mk' => [
                'required',
                'string',
                'max:10',
                Rule::unique(MataKuliah::class, 'kode_mk')->ignore($mataKuliah?->id)
            ],
            'nama_mk' => ['required', 'string', 'max:100'],
            'sks' => ['required', 'integer', 'min:1', 'max:255'],
        ], [
            'kode_mk.required' => 'Kode mata kuliah wajib diisi.',
            'kode_mk.max' => 'Kode mata kuliah maksimal 10 karakter.',
            'kode_mk.unique' => 'Kode mata kuliah sudah digunakan.',
            'nama_mk.required' => 'Nama mata kuliah wajib diisi.',
            'nama_mk.max' => 'Nama mata kuliah maksimal 100 karakter.',
            'sks.required' => 'Jumlah SKS wajib diisi.',
            'sks.integer' => 'Jumlah SKS harus berupa bilangan bulat.',
            'sks.min' => 'Jumlah SKS minimal 1.',
            'sks.max' => 'Jumlah SKS maksimal 255.',
        ]);
    }
}
