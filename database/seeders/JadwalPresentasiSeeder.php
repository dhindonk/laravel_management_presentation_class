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
                // Gab A
                'tanggal_presentasi' => '2024-12-31',
                'waktu_presentasi' => '13:00:00'
            ],
            [
                // Gab B
                'tanggal_presentasi' => '2025-01-02',
                'waktu_presentasi' => '07:30:00'
            ],
            [
                // Gab C
                'tanggal_presentasi' => '2024-12-31',
                'waktu_presentasi' => '10:30:00'
            ],
            [
                // Gab D
                'tanggal_presentasi' => '2024-12-31',
                'waktu_presentasi' => '07:30:00'
            ],
        ];

        foreach ($jadwals as $jadwal) {
            JadwalPresentasi::create($jadwal);
        }
        
    }
}
