<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : _aksi.blade.php (mahasiswa)
Tanggal edit    : 9-11-2026
-->

<div class="btn-group btn-group-sm" role="group">
    <a href="{{ route('mahasiswa.show', $mahasiswa->nim) }}" class="btn btn-outline-info"
       title="Detail" aria-label="Detail {{ $mahasiswa->nama }}">
        <i class="bi bi-eye"></i>
    </a>

    @if (Auth::user()->role === 'admin')
        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn btn-outline-warning"
           title="Ubah" aria-label="Ubah {{ $mahasiswa->nama }}">
            <i class="bi bi-pencil-square"></i>
        </a>

        <button type="button" class="btn btn-outline-danger btn-hapus"
                data-url="{{ route('mahasiswa.destroy', $mahasiswa, false) }}"
                data-nama="{{ $mahasiswa->nama }}" title="Hapus"
                aria-label="Hapus {{ $mahasiswa->nama }}">
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>
