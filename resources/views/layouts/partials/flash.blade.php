<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : flash.blade.php
Tanggal buat    : 1-11-2026
-->
@foreach ([
    'success' => 'success',
    'error'   => 'danger',
    'warning' => 'warning',
    'info'    => 'info',
] as $kunci => $kelas)
    @if (session($kunci))
        <div class="alert alert-{{ $kelas }} alert-dismissible fade show"
             role="alert">
            {{ session($kunci) }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif
@endforeach
