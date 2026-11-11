<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : show.blade.php (krs)
Tanggal buat    : 10-11-2026
-->

@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
    <x-page-header judul="Detail KRS"
                   deskripsi="Informasi lengkap Kartu Rencana Studi mahasiswa." />

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-body fw-semibold">
            Informasi KRS
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 text-muted">NIM</div>
                <div class="col-md-9 fw-semibold">
                    {{ $krs->mahasiswa->nim }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 text-muted">Nama Mahasiswa</div>
                <div class="col-md-9">
                    {{ $krs->mahasiswa->nama }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 text-muted">Tahun Akademik</div>
                <div class="col-md-9">
                    {{ $krs->tahun_akademik }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 text-muted">Semester</div>
                <div class="col-md-9">
                    {{ $krs->semester }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 text-muted">Status KRS</div>
                <div class="col-md-9">
                    @php
                        $warnaStatus = [
                            'draft' => 'secondary',
                            'diajukan' => 'warning',
                            'disetujui' => 'success',
                            'ditolak' => 'danger',
                        ];
                    @endphp

                    <span class="badge bg-{{ $warnaStatus[$krs->status] ?? 'secondary' }}">
                        {{ ucfirst($krs->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-body fw-semibold">
            Daftar Mata Kuliah
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th class="text-center">SKS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($krs->mataKuliah as $index => $mk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mk->kode_mk }}</td>
                                <td>{{ $mk->nama_mk }}</td>
                                <td class="text-center">{{ $mk->sks }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Belum ada mata kuliah yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total SKS</th>
                            <th class="text-center">
                                {{ $krs->mataKuliah->sum('sks') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('krs.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        @if (Auth::user()->role === 'admin')
            <a href="{{ route('krs.edit', $krs) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Ubah KRS
            </a>
        @endif

        <a href="{{ route('krs.cetak', $krs) }}"
            target="_blank"
            class="btn btn-danger">
            <i class="bi bi-file-pdf"></i> Cetak KRS
        </a>
    </div>
@endsection
