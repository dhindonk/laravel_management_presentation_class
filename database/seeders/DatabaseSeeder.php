<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin
        User::create([
            'name' => 'Admin',
            'email' => 'asprak@maroon.lab',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        Kelas::create([
            'nama_kelas' => 'Gab A',
            'penanggung_jawab' => 'Ajiz Abdul Majid',
        ]);

        Kelas::create([
            'nama_kelas' => 'Gab B',
            'penanggung_jawab' => 'Fakhriza',
        ]);
        Kelas::create([
            'nama_kelas' => 'Gab C',
            'penanggung_jawab' => 'Fahdin',
        ]);
        Kelas::create([
            'nama_kelas' => 'Gab D',
            'penanggung_jawab' => 'Ridho',
        ]);

        $this->call([
            JadwalPresentasiSeeder::class,
            // KelompokSeeder::class,
        ],);
    }
}
