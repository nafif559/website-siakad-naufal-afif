<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : create.blade.php (krs)
Tanggal buat    : 10-11-2026
-->

@extends('layouts.app')

@section('title', 'Tambah KRS')

@section('content')
    <x-page-header judul="Tambah KRS"
                   deskripsi="Tambahkan data KRS mahasiswa." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Form Tambah KRS
        </div>

        <div class="card-body">
            <form action="{{ route('krs.store') }}" method="POST">
                @csrf

                @include('krs._form')

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>

                    <a href="{{ route('krs.index') }}"
                       class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
