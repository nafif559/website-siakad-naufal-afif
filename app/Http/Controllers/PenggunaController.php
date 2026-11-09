<?php

/*
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : PenggunaController.php
Tanggal buat    : 1-11-2026     edit(3-11-2026)
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
            'last_login_at' => 'Login Terakhir',
        ];

        // Password tidak ikut diambil dari database
        $pengguna = User::orderBy('name')
            ->get(['name', 'email', 'role', 'last_login_at'])
            ->toArray();

        return view('pengguna.index', compact('kolom', 'pengguna'));
    }
}
