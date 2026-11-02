<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : navbar.blade.php
Tanggal edit    : 1-11-2026
-->
<nav class="navbar navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none me-2" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">
                <i class="bi bi-mortarboard-fill me-1"></i>
                {{ config('app.name') }}
            </a>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- Tugas mandiri 5 -->
            <button type="button" id="themeToggle"
                    class="btn btn-outline-light btn-sm">
                <i class="bi bi-moon-stars-fill me-1"></i>
                <span>Gelap</span>
            </button>

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                    <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <span class="dropdown-item-text small">
                            {{ Auth::user()->email }}
                            <span class="badge text-bg-secondary ms-1">{{ Auth::user()->role }}</span>
                        </span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-1"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tombolTema = document.getElementById('themeToggle');
            const html = document.documentElement;

            // Ambil tema yang tersimpan, default-nya terang
            const temaTersimpan = localStorage.getItem('tema') || 'light';

            // Terapkan tema saat halaman dibuka
            html.setAttribute('data-bs-theme', temaTersimpan);

            // Sesuaikan tulisan dan ikon tombol
            function perbaruiTombol(tema) {
                tombolTema.innerHTML = tema === 'dark'
                    ? '<i class="bi bi-sun-fill me-1"></i><span>Terang</span>'
                    : '<i class="bi bi-moon-stars-fill me-1"></i><span>Gelap</span>';
            }

            perbaruiTombol(temaTersimpan);

            // Ganti tema saat tombol diklik
            tombolTema.addEventListener('click', function () {
                const temaSekarang = html.getAttribute('data-bs-theme');
                const temaBaru = temaSekarang === 'dark' ? 'light' : 'dark';

                html.setAttribute('data-bs-theme', temaBaru);

                // Simpan pilihan tema di browser
                localStorage.setItem('tema', temaBaru);

                perbaruiTombol(temaBaru);
            });
        });
    </script>
@endpush
