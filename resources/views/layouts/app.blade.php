<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : app.blade.php
Tanggal edit    : 1-11-2026
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIAKAD') | {{ config('app.name') }}</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"
          rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}"
          rel="stylesheet">
    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}"
          rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-body-tertiary">
    @include('layouts.partials.navbar')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.partials.sidebar')

            <main class="col-lg-9 col-xl-10 px-3 px-md-4 py-4">    

                @yield('content')

                <footer class="text-center text-body-secondary small mt-5">
                    &copy; {{ date('Y') }} {{ config('app.name') }}
                    - D3 Teknik Informatika
                </footer>
            </main>
        </div>
    </div>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @include('layouts.partials.flash')
    @stack('scripts')
</body>
</html>