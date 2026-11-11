<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : _aksi.blade.php (mata kuliah)
Tanggal buat    : 10-11-2026
-->

<div class="btn-group btn-group-sm" role="group">
    <a href="{{ route('matakuliah.show', $mataKuliah) }}" class="btn btn-outline-info"
       title="Detail" aria-label="Detail {{ $mataKuliah->nama_mk }}">
        <i class="bi bi-eye"></i>
    </a>

    @if (Auth::user()->role === 'admin')
        <a href="{{ route('matakuliah.edit', $mataKuliah) }}" class="btn btn-outline-warning"
           title="Ubah" aria-label="Ubah {{ $mataKuliah->nama_mk }}">
            <i class="bi bi-pencil-square"></i>
        </a>

        <button type="button" class="btn btn-outline-danger btn-hapus"
                data-url="{{ route('matakuliah.destroy', $mataKuliah, false) }}"
                data-nama="{{ $mataKuliah->nama_mk }}" title="Hapus"
                aria-label="Hapus {{ $mataKuliah->nama_mk }}">
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>
