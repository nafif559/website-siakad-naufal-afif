<?php

/*
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : DashboardController.php
Tanggal edit    : 10-11-2026
*/

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Krs;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Statistik berdasarkan jumlah data di database
        $statistik = [
            [
                'judul' => 'Mahasiswa',
                'jumlah' => Mahasiswa::count(),
                'ikon' => 'bi-mortarboard-fill',
                'warna' => 'primary',
            ],
            [
                'judul' => 'Dosen',
                'jumlah' => Dosen::count(),
                'ikon' => 'bi-person-badge-fill',
                'warna' => 'success',
            ],
            [
                'judul' => 'Mata Kuliah',
                'jumlah' => MataKuliah::count(),
                'ikon' => 'bi-book-fill',
                'warna' => 'warning',
            ],
            [
                'judul' => 'KRS',
                'jumlah' => Krs::count(),
                'ikon' => 'bi-journal-check',
                'warna' => 'info',
            ],
        ];

        $kolomKrs = [
            'nim' => 'NIM',
            'nama' => 'Nama Mahasiswa',
            'sks' => 'SKS',
            'status' => 'Status',
        ];

        // Data KRS terbaru dan status KRS
        // Mengambil 5 data KRS terbaru dari database
        $krsTerbaru = Krs::with([
            'mahasiswa:id,nim,nama',
            'mataKuliah:id,sks',
        ])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($krs) {
                return [
                    'nim' => $krs->mahasiswa->nim,
                    'nama' => $krs->mahasiswa->nama,
                    'sks' => $krs->mataKuliah->sum('sks'),
                    'status' => ucfirst($krs->status),
                ];
            })
            ->toArray();
        
        // Menghitung jumlah seluruh KRS
        $totalKrs = Krs::count();
        
        // Menghitung jumlah KRS berdasarkan status
        $jumlahPerStatus = Krs::selectRaw('status, COUNT(*) as jumlah')
            ->groupBy('status')
            ->pluck('jumlah', 'status');
        
        // Menyiapkan statistik status KRS
        $statusKrs = [];
        
        $daftarStatus = [
            'draft' => [
                'label' => 'Draft',
                'warna' => 'secondary',
            ],
            'diajukan' => [
                'label' => 'Diajukan',
                'warna' => 'warning',
            ],
            'disetujui' => [
                'label' => 'Disetujui',
                'warna' => 'success',
            ],
            'ditolak' => [
                'label' => 'Ditolak',
                'warna' => 'danger',
            ],
        ];
        
        foreach ($daftarStatus as $status => $detail) {
            $jumlah = (int) ($jumlahPerStatus[$status] ?? 0);
        
            $statusKrs[] = [
                'label' => $detail['label'],
                'jumlah' => $jumlah,
                'persen' => $totalKrs > 0
                    ? round(($jumlah / $totalKrs) * 100)
                    : 0,
                'warna' => $detail['warna'],
            ];
        }

        return view('dashboard', compact(
            'statistik',
            'kolomKrs',
            'krsTerbaru',
            'statusKrs'
        ));
    }
}
