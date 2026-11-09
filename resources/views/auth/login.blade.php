<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : login.blade.php
Tanggal buat    : 1-11-2026
-->

@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="text-center mb-4">
        <i class="bi bi-mortarboard-fill display-5 text-primary"></i>
        <h1 class="h3 fw-bold mb-1">{{ config('app.name') }}</h1>
        <p class="text-body-secondary mb-0">Politeknik Negeri Pontianak</p>
    </div>

    @include('layouts.partials.flash')

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h2 class="h5 mb-3">Masuk ke akun Anda</h2>

            <form method="POST" action="{{ route('login.attempt') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <x-form-input label="Email" name="email" type="email"
                                  autocomplete="username" required autofocus />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>

                    <div class="input-group">
                        <input type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            required>

                        <button class="btn btn-outline-secondary"
                                type="button"
                                id="togglePassword"
                                aria-label="Tampilkan kata sandi">
                            <i class="bi bi-eye" id="iconPassword"></i>
                        </button>
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox"
                           name="remember" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const iconPassword = document.getElementById('iconPassword');

    togglePassword.addEventListener('click', function () {
        if (password.type === 'password') {
            password.type = 'text';
            iconPassword.classList.replace('bi-eye', 'bi-eye-slash');
            togglePassword.setAttribute('aria-label', 'Sembunyikan kata sandi');
        } else {
            password.type = 'password';
            iconPassword.classList.replace('bi-eye-slash', 'bi-eye');
            togglePassword.setAttribute('aria-label', 'Tampilkan kata sandi');
        }
    });
</script>
@endpush