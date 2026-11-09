<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : 403.blade.php
Tanggal buat    : 2-11-2026
-->

@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center"
             style="min-height: 65vh;">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body p-5">

                        <i class="bi bi-shield-lock-fill text-danger"
                           style="font-size: 5rem;"></i>

                        <h1 class="display-3 fw-bold text-danger mt-3">
                            403
                        </h1>

                        <h2 class="h4 fw-semibold mb-3">
                            Akses Ditolak
                        </h2>

                        <p class="text-body-secondary">
                            Maaf, Anda tidak memiliki hak akses
                            untuk membuka halaman ini.
                        </p>

                        <a href="{{ route('dashboard') }}"
                           class="btn btn-primary mt-3">
                            <i class="bi bi-house-door-fill me-1"></i>
                            Kembali ke Dashboard
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
