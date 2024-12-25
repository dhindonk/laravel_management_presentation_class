<?php

namespace Database\Seeders;

use App\Models\JadwalPresentasi;
use Illuminate\Database\Seeder;

class JadwalPresentasiSeeder extends Seeder
{
    public function run()
    {
        $jadwals = [
            [
                'tanggal_presentasi' => '2024-01-01',
                'waktu_presentasi' => '08:00:00'
            ],
            [
                'tanggal_presentasi' => '2024-01-01',
                'waktu_presentasi' => '10:00:00'
            ],
            [
                'tanggal_presentasi' => '2024-01-01',
                'waktu_presentasi' => '13:00:00'
            ],
        ];

        foreach ($jadwals as $jadwal) {
            JadwalPresentasi::create($jadwal);
        }
    }
}
