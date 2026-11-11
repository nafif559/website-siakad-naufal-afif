<?php

/*
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : web.php
Tanggal edit    : 4-11-2026
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\PenggunaController;
use App\Http\Middleware\NoStore;
use Illuminate\Support\Facades\Route;

// Halaman untuk tamu: hanya bisa dibuka bila BELUm login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.attempt');
});

// Halaman internal: hanya bisa dibuka bila SUDAH login
Route::middleware('auth', NoStore::class)->group(function() {
    Route::get('/', fn ()=>redirect()->route('dashboard'));

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
      

    // Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
    // Hanya admin
    Route::get('/pengguna', [PenggunaController::class, 'index'])
        ->middleware('role:admin')
        ->name('pengguna.index');

    

    // CRUD dosen
    Route::get('/dosen/data', [DosenController::class, 'data'])->name('dosen.data');
    Route::middleware('role:admin')->group(function () {
        Route::resource('dosen', DosenController::class)
            ->except(['index', 'show']);
    });
    Route::resource('dosen', DosenController::class)
        ->only(['index', 'show']);

    //CRUD mahasiswa
    Route::get('/mahasiswa/data', [MahasiswaController::class, 'data'])->name('mahasiswa.data');
    Route::middleware('role:admin')->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class)
            ->except(['index', 'show']);
    });
    Route::resource('mahasiswa', MahasiswaController::class)
        ->only(['index', 'show']);
    // Tugas mandiri 3
    Route::get('/mahasiswa/{mahasiswa:nim}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');

    // Route Mata Kuliah
    Route::get('/matakuliah/data', [MataKuliahController::class, 'data'])->name('matakuliah.data');
    Route::middleware('role:admin')->group(function () {
        Route::resource('matakuliah', MataKuliahController::class)
            ->parameters(['matakuliah' => 'mataKuliah'])
            ->except(['index', 'show']);
    });
    Route::resource('matakuliah', MataKuliahController::class)
        ->parameters(['matakuliah' => 'mataKuliah'])
        ->only(['index', 'show']);

    // Route KRS
    Route::get('/krs/data', [KrsController::class, 'data'])->name('krs.data');
    Route::middleware('role:admin')->group(function () {
        Route::resource('krs', KrsController::class)
            ->parameters(['krs' => 'krs'])
            ->except(['index', 'show']);
    });
    Route::resource('krs', KrsController::class)
        ->parameters(['krs' => 'krs'])
        ->only(['index', 'show']);
        
    // fitur cetak krs
    Route::get('/krs/{krs}/cetak', [KrsController::class, 'cetak'])
        ->name('krs.cetak');
});
