@extends('layouts.app')

@section('content')
    <x-page-header
        judul="Detail Mahasiswa"
        deskripsi="Informasi lengkap mahasiswa."
    />

    <div class="card shadow-sm">
        <div class="card-header">
            Detail Mahasiswa
        </div>

        <div class="card-body">
            <p>
                <strong>NIM:</strong>
                {{ $mahasiswa['nim'] }}
            </p>

            <p>
                <strong>Nama:</strong>
                {{ $mahasiswa['nama'] }}
            </p>

            <p>
                <strong>Status:</strong>
                {{ $mahasiswa['status'] }}
            </p>

            <a href="{{ route('mahasiswa.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
@endsection