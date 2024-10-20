<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalPresentasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan data jadwal presentasi
        DB::table('jadwal_presentasis')->insert([
            [
                'tanggal_presentasi' => '2024-10-20',
                'waktu_presentasi' => '09:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_presentasi' => '2024-10-21',
                'waktu_presentasi' => '10:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_presentasi' => '2024-10-22',
                'waktu_presentasi' => '11:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_presentasi' => '2024-10-23',
                'waktu_presentasi' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_presentasi' => '2024-10-24',
                'waktu_presentasi' => '14:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
