<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : dashboard.blade.php
Tanggal edit    : 10-11-2026
-->

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <x-page-header judul="Dashboard"
                   deskripsi="Ringkasan statistik data akademik." />

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xxl-4 g-3 mb-4">
        @foreach ($statistik as $item)
            <div class="col">
                <x-stat-card :judul="$item['judul']" :jumlah="$item['jumlah']"
                             :ikon="$item['ikon']" :warna="$item['warna']" />
            </div>
        @endforeach
    </div>

    <div class="row g-3">
        <div class="col-12 col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-body fw-semibold">KRS Terbaru</div>
                <div class="card-body p-0">
                    @if (count($krsTerbaru) > 0)
                        <x-tabel :kolom="$kolomKrs" :baris="$krsTerbaru" />
                    @else
                        <p class="text-center text-muted py-4 mb-0">
                            Belum ada data KRS.
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-body fw-semibold">Status KRS</div>                
                    <div class="card-body">
                        @foreach ($statusKrs as $s)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span>{{ $s['label'] }} ({{ $s['jumlah'] }})</span>
                                    <span>{{ $s['persen'] }}%</span>
                                </div>
                    
                                <div class="progress" role="progressbar"
                                    aria-valuenow="{{ $s['persen'] }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100">
                                    <div class="progress-bar bg-{{ $s['warna'] }}"
                                        style="width: {{ $s['persen'] }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

            </div>
        </div>
    </div>
@endsection
