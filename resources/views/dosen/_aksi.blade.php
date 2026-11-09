<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : _aksi.blade.php
Tanggal buat    : 6-11-2026
-->

<div class="btn-group btn-group-sm" role="group">
    <a href="{{ route('dosen.show', $dosen) }}" class="btn btn-outline-info"
       title="Detail" aria-label="Detail {{ $dosen->nama }}">
        <i class="bi bi-eye"></i>
    </a>

    @if (Auth::user()->role === 'admin')
        <a href="{{ route('dosen.edit', $dosen) }}" class="btn btn-outline-warning"
           title="Ubah" aria-label="Ubah {{ $dosen->nama }}">
            <i class="bi bi-pencil-square"></i>
        </a>

        <button type="button" class="btn btn-outline-danger btn-hapus"
                data-url="{{ route('dosen.destroy', $dosen, false) }}"
                data-nama="{{ $dosen->nama }}" title="Hapus"
                aria-label="Hapus {{ $dosen->nama }}">
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>
