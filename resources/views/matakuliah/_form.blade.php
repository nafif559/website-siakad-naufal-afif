<!--
Nama            : Naufal Afif
NIM             : 3202416082
Kelas           : 5C-TIF
Nama file       : _form.blade.php (mata-kuliah)
Tanggal buat    : 10-11-2026
-->

<div class="mb-3">
    <x-form-input label="Kode Mata Kuliah" name="kode_mk"
                  :value="$mataKuliah->kode_mk"
                  maxlength="10" required autofocus />
</div>

<div class="mb-3">
    <x-form-input label="Nama Mata Kuliah" name="nama_mk"
                  :value="$mataKuliah->nama_mk"
                  maxlength="100" required />
</div>

<div class="mb-3">
    <x-form-input label="Jumlah SKS" name="sks" type="number"
                  :value="$mataKuliah->sks"
                  min="1" max="255" required />
</div>
