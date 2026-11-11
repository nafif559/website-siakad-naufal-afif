
# Website SIAKAD - Naufal Afif

Sistem Informasi Akademik (SIAKAD) berbasis web yang dikembangkan menggunakan Laravel 12 sebagai bagian dari pengerjaan Jobsheet mata kuliah.

## Teknologi yang Digunakan

- **Framework:** Laravel 12
- **Bahasa Pemrograman:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 5
- **DataTables:** Yajra Laravel DataTables
- **PDF:** Laravel DomPDF

## Fitur Aplikasi

- Autentikasi pengguna (Login dan Logout).
- Manajemen data Dosen (CRUD).
- Manajemen data Mahasiswa (CRUD).
- Manajemen data Mata Kuliah (CRUD).
- Manajemen Kartu Rencana Studi (KRS).
- Pemilihan beberapa mata kuliah dalam satu KRS.
- Perhitungan total SKS.
- Status KRS: Draft, Diajukan, Disetujui, dan Ditolak.
- Cetak KRS dalam format PDF.
- Dashboard statistik akademik.
- Tabel data menggunakan Yajra DataTables server-side.

## Persyaratan Sistem

- PHP sesuai persyaratan Laravel 12.
- Composer.
- MySQL.
- Node.js dan NPM.
- Web server lokal seperti Laragon.

## Instalasi

1. Clone repository:

   ```bash
   git clone https://github.com/nafif559/website-siakad-naufal-afif.git
   ```

2. Masuk ke direktori project:

   ```bash
   cd website-siakad-naufal-afif
   ```

3. Install dependency PHP:

   ```bash
   composer install
   ```

4. Salin file konfigurasi:

   ```bash
   copy .env.example .env
   ```

5. Generate application key:

   ```bash
   php artisan key:generate
   ```

6. Sesuaikan konfigurasi database pada file `.env`.

7. Jalankan migrasi database:

   ```bash
   php artisan migrate
   ```

8. Jalankan aplikasi:

   ```bash
   php artisan serve
   ```

Buka aplikasi melalui alamat yang ditampilkan oleh Laravel.

## Framework

Project ini dikembangkan menggunakan [Laravel](https://laravel.com), framework PHP untuk membangun aplikasi web dengan sintaks yang ekspresif dan elegan.

Dokumentasi Laravel dapat diakses melalui [laravel.com/docs](https://laravel.com/docs).

## Developer

**Naufal Afif**

Project Sistem Informasi Akademik (SIAKAD).
