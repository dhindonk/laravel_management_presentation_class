<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelompok;
use App\Models\JadwalPresentasi;

class KelompokSeeder extends Seeder
{
    public function run()
    {
        // Mengambil id jadwal presentasi
        $jadwalPresentasiIds = JadwalPresentasi::pluck('id')->toArray();

        Kelompok::create([
            'judul_proyek' => 'Kelompok A',
            'ketua' => 'Ketua A',
            'npm_ketua' => '19030101',
            'anggota' => ['Anggota A1', 'Anggota A2'],  // Simpan sebagai array
            'npm_anggota' => ['19030102', '19030103'],  // Simpan sebagai array
            'kelas_id' => 1,
            'lab' => 'Lab Data Science',
            'status' => 'Pending',
            'jadwal_presentasi_id' => $jadwalPresentasiIds[0] ?? null,
        ]);

        Kelompok::create([
            'judul_proyek' => 'Kelompok B',
            'ketua' => 'Ketua B',
            'npm_ketua' => '19030104',
            'anggota' => ['Anggota B1', 'Anggota B2'],  // Simpan sebagai array
            'npm_anggota' => ['19030105', '19030106'],  // Simpan sebagai array
            'kelas_id' => 2,
            'lab' => 'Lab Multimedia',
            'status' => 'Pending',
            'jadwal_presentasi_id' => $jadwalPresentasiIds[1] ?? null,
        ]);

        Kelompok::create([
            'judul_proyek' => 'Kelompok C',
            'ketua' => 'Ketua C',
            'npm_ketua' => '19030107',
            'anggota' => ['Anggota C1', 'Anggota C2'],  // Simpan sebagai array
            'npm_anggota' => ['19030108', '19030109'],  // Simpan sebagai array
            'kelas_id' => 3,
            'lab' => 'Lab Sistem Cerdas',
            'status' => 'Pending',
            'jadwal_presentasi_id' => $jadwalPresentasiIds[2] ?? null,
        ]);
    }
}
