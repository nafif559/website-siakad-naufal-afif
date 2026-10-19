<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>{{ $namaAplikasi }}</title> 
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
</head> 
<body> 
    <h1>{{ $namaAplikasi }}</h1> 
    <p>Konfigurasi berhasil. Hari ini {{ $waktu }}.</p>
  
    <table border="1" cellpadding="6" cellspacing="0"> 
        <tr><th align="left">Laravel</th><td>{{ $versiLaravel }}</td></tr> 
        <tr><th align="left">PHP</th><td>{{ $versiPhp }}</td></tr> 
        <tr><th align="left">MySQL</th><td>{{ $versiMysql }}</td></tr> 
        <tr><th align="left">Database</th><td>{{ $namaDatabase }}</td></tr> 
    </table>

    <i class="bi bi-house">Ini icon dari bootstrap-icons.min.css</i>
</body> 
</html> 