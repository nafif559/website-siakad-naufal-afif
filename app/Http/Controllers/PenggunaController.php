<?php

/*
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : PenggunaController.php
Tanggal buat    : 1-11-2026
*/

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'name' => 'Nama',
            'email' => 'Email',
            'role' => 'Peran',
        ];

        // Password tidak ikut diambil dari database
        $pengguna = User::orderBy('name')
            ->get(['name', 'email', 'role'])
            ->toArray();

        return view('pengguna.index', compact('kolom', 'pengguna'));
    }
}
