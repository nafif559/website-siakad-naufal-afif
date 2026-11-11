<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : pdf.blade.php 
Tanggal buat    : 10-11-2026
-->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Rencana Studi</title>

    <style>
        @page {
            margin: 35px 45px;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #222;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0 0 5px;
            font-size: 17px;
        }
        .header p {
            margin: 3px 0;
            font-size: 10px;
        }
        .judul {
            text-align: center;
            margin-bottom: 20px;
        }
        .judul h3 {
            margin: 0 0 5px;
            font-size: 15px;
            text-decoration: underline;
        }
        .identitas {
            width: 100%;
            margin-bottom: 20px;
        }
        .identitas td {
            padding: 5px 3px;
            vertical-align: top;
        }
        .label {
            width: 125px;
        }
        .tabel-krs {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .tabel-krs th,
        .tabel-krs td {
            border: 1px solid #333;
            padding: 8px;
        }
        .tabel-krs th {
            background-color: #eaeaea;
            text-align: center;
        }
        .tengah {
            text-align: center;
        }
        .total {
            font-weight: bold;
        }
        .tanda-tangan {
            width: 100%;
            margin-top: 55px;
        }
        .tanda-tangan td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }
        .nama-ttd {
            margin-top: 65px;
            font-weight: bold;
            text-decoration: underline;
        }
        .footer {
            margin-top: 35px;
            text-align: center;
            font-size: 9px;
            color: #666;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>POLITEKNIK NEGERI PONTIANAK</h2>
        <p>JURUSAN TEKNIK ELEKTRO</p>
        <p>Jl. Jenderal Ahmad Yani, Bansir Laut, Kecamatan Pontianak Tenggara, Kota Pontianak, Kalimantan Barat 78124</p>
    </div>

    <div class="judul">
        <h3>KARTU RENCANA STUDI</h3>
        <p>Tahun Akademik {{ $krs->tahun_akademik }}</p>
    </div>

    <table class="identitas">
        <tr>
            <td class="label">NIM</td>
            <td>: {{ $krs->mahasiswa->nim }}</td>
        </tr>
        <tr>
            <td class="label">Nama Mahasiswa</td>
            <td>: {{ $krs->mahasiswa->nama }}</td>
        </tr>
        <tr>
            <td class="label">Tahun Akademik</td>
            <td>: {{ $krs->tahun_akademik }}</td>
        </tr>
        <tr>
            <td class="label">Semester</td>
            <td>: {{ $krs->semester }}</td>
        </tr>
        <tr>
            <td class="label">Status KRS</td>
            <td>: {{ ucfirst($krs->status) }}</td>
        </tr>
    </table>

    <strong>Daftar Mata Kuliah yang Diambil</strong>

    <table class="tabel-krs">
        <thead>
            <tr>
                <th width="7%">No.</th>
                <th width="20%">Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th width="15%">SKS</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($krs->mataKuliah as $index => $mk)
                <tr>
                    <td class="tengah">{{ $index + 1 }}</td>
                    <td>{{ $mk->kode_mk }}</td>
                    <td>{{ $mk->nama_mk }}</td>
                    <td class="tengah">{{ $mk->sks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="tengah">
                        Belum ada mata kuliah yang dipilih.
                    </td>
                </tr>
            @endforelse
        </tbody>

        <tfoot>
            <tr class="total">
                <td colspan="3" class="tengah">TOTAL SKS</td>
                <td class="tengah">
                    {{ $krs->mataKuliah->sum('sks') }}
                </td>
            </tr>
        </tfoot>
    </table>

    <table class="tanda-tangan">
        <tr>
            <td>
                Mengetahui,<br>
                Dosen Pembimbing Akademik

                <div class="nama-ttd">
                    (................................)
                </div>
            </td>

            <td>
                Mahasiswa,

                <div class="nama-ttd">
                    ({{ $krs->mahasiswa->nama }})
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dokumen Kartu Rencana Studi - Sistem Informasi Akademik
    </div>

</body>
</html>
