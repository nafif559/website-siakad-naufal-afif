<?php

namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = Mahasiswa::orderBy('id')
            ->take(10)
            ->get();

        $mataKuliahIds = MataKuliah::pluck('id');

        if ($mataKuliahIds->count() < 5) {
            $this->command->warn(
                'Data mata kuliah harus tersedia minimal 5.'
            );

            return;
        }

        foreach ($mahasiswa as $mhs) {
            $krs = Krs::updateOrCreate(
                [
                    'mahasiswa_id' => $mhs->id,
                    'tahun_akademik' => '2026/2027',
                    'semester' => 'Ganjil',
                ],
                [
                    'status' => 'draft',
                ]
            );

            // Hapus pilihan mata kuliah sebelumnya
            $krs->mataKuliah()->detach();

            // Pilih 5 mata kuliah secara acak
            $pilihan = MataKuliah::inRandomOrder()
                ->limit(5)
                ->pluck('id');

            // Hubungkan mata kuliah ke KRS
            $krs->mataKuliah()->attach($pilihan);
        }
    }
}
