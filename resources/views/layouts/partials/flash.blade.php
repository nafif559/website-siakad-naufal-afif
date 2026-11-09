<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : flash.blade.php
Tanggal buat    : 1-11-2026
-->
@if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top',
            icon: 'success',
            title: @json(session('success')),
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top',
            icon: 'error',
            title: @json(session('error')),
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true
        });
    </script>
@endif
