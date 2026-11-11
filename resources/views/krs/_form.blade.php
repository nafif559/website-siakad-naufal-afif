<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : _form.blade.php (krs)
Tanggal buat    : 10-11-2026
-->

<div class="mb-3">
    <label for="mahasiswa_id" class="form-label">Mahasiswa</label>

    <select id="mahasiswa_id" name="mahasiswa_id"
            @class(['form-select', 'is-invalid' => $errors->has('mahasiswa_id')])
            required autofocus>
        <option value="">-- Pilih Mahasiswa --</option>

        @foreach ($mahasiswa as $mhs)
            <option value="{{ $mhs->id }}"
                @selected(old('mahasiswa_id', $krs->mahasiswa_id) == $mhs->id)>
                {{ $mhs->nim }} - {{ $mhs->nama }}
            </option>
        @endforeach
    </select>

    @error('mahasiswa_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <x-form-input label="Tahun Akademik" name="tahun_akademik"
                  :value="$krs->tahun_akademik"
                  placeholder="Contoh: 2026/2027"
                  maxlength="9" required />
</div>

<div class="mb-3">
    <label for="semester" class="form-label">Semester</label>

    <select id="semester" name="semester"
            @class(['form-select', 'is-invalid' => $errors->has('semester')])
            required>
        <option value="">-- Pilih Semester --</option>

        @foreach (['Ganjil', 'Genap'] as $semester)
            <option value="{{ $semester }}"
                @selected(old('semester', $krs->semester) === $semester)>
                {{ $semester }}
            </option>
        @endforeach
    </select>

    @error('semester')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status KRS</label>

    <select id="status" name="status"
            @class(['form-select', 'is-invalid' => $errors->has('status')])
            required>
        <option value="">-- Pilih Status --</option>

        @foreach (['draft', 'diajukan', 'disetujui', 'ditolak'] as $status)
            <option value="{{ $status }}"
                @selected(old('status', $krs->status ?? 'draft') === $status)>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>

    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Daftar Mata Kuliah</label>

    @php
        $terpilih = old('mata_kuliah_ids', $mataKuliahTerpilih);
    @endphp

    <div class="border rounded p-3">
        @forelse ($mataKuliah as $mk)
            <div class="form-check mb-2">
                <input class="form-check-input js-mata-kuliah"
                       type="checkbox"
                       name="mata_kuliah_ids[]"
                       id="mata_kuliah_{{ $mk->id }}"
                       value="{{ $mk->id }}"
                       data-sks="{{ $mk->sks }}"
                       @checked(in_array($mk->id, $terpilih))>

                <label class="form-check-label"
                       for="mata_kuliah_{{ $mk->id }}">
                    {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                    <span class="text-muted">({{ $mk->sks }} SKS)</span>
                </label>
            </div>
        @empty
            <p class="text-muted mb-0">
                Belum ada data mata kuliah.
            </p>
        @endforelse
    </div>

    @error('mata_kuliah_ids')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror

    @error('mata_kuliah_ids.*')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="total_sks" class="form-label">Total SKS</label>

    <input type="text" id="total_sks"
           class="form-control" value="0 SKS" readonly>

    <div class="form-text">
        Total SKS dihitung otomatis berdasarkan mata kuliah yang dipilih.
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mataKuliah = document.querySelectorAll('.js-mata-kuliah');
            const totalSks = document.getElementById('total_sks');

            function hitungTotalSks() {
                let total = 0;

                mataKuliah.forEach(function (item) {
                    if (item.checked) {
                        total += Number(item.dataset.sks);
                    }
                });

                totalSks.value = total + ' SKS';
            }

            mataKuliah.forEach(function (item) {
                item.addEventListener('change', hitungTotalSks);
            });

            // Menghitung kembali saat form pertama kali dibuka.
            hitungTotalSks();
        });
    </script>
@endpush
