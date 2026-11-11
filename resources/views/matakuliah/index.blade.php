<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : index.blade.php (mata-kuliah)
Tanggal edit    : 10-11-2026
-->

@extends('layouts.app')

@section('title', 'Data Mata Kuliah')

@section('content')
    <x-page-header judul="Data Mata Kuliah"
                   deskripsi="Pencarian dan pengurutan diproses di server." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body d-flex justify-content-between
                     align-items-center">
            <span class="fw-semibold">Daftar Mata Kuliah</span>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('matakuliah.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> Tambah Mata Kuliah
                </a>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabel-mata-kuliah"
                       class="table table-striped table-hover align-middle w-100">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap5.min.css') }}"
          rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(function () {
            $('#tabel-mata-kuliah').DataTable({
                processing: true,
                serverSide: true,
                ajax: @json(route('matakuliah.data', [], false)),
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex',
                      orderable: false, searchable: false },
                    { data: 'kode_mk', name: 'kode_mk' },
                    { data: 'nama_mk', name: 'nama_mk' },
                    { data: 'sks', name: 'sks' },
                    { data: 'aksi', name: 'aksi', className: 'text-nowrap',
                      orderable: false, searchable: false },
                ],
                order: [[2, 'asc']],
                language: {
                    processing: 'Memuat data...',
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(disaring dari _MAX_ data)',
                    zeroRecords: 'Data tidak ditemukan',
                    paginate: {
                        first: 'Awal', last: 'Akhir',
                        next: 'Berikutnya', previous: 'Sebelumnya',
                    },
                },
            });
        });
    </script>
@endpush

@push('scripts')
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        const csrfToken = @json(csrf_token());

        // Event delegation untuk tombol hapus
        $(document).on('click', '.btn-hapus', function () {
            const url = this.dataset.url;
            const nama = this.dataset.nama;

            Swal.fire({
                title: 'Hapus data mata kuliah?',
                text: 'Data ' + nama + ' akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc3545',
            }).then(function (hasil) {
                if (!hasil.isConfirmed) {
                    return;
                }

                $.ajax({
                    url: url,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                }).done(function (respons) {
                    $('#tabel-mata-kuliah').DataTable().ajax.reload(null, false);

                    Swal.fire({
                        toast: true,
                        position: 'top',
                        icon: 'success',
                        title: 'Berhasil',
                        text: respons.message,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                }).fail(function (xhr) {
                    const pesan = (xhr.responseJSON && xhr.responseJSON.message)
                        || 'Data tidak dapat dihapus.';

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal (' + xhr.status + ')',
                        text: pesan,
                    });
                });
            });
        });
    </script>
@endpush
