<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $kelas = [
            ['nama_kelas' => 'IF-A', 'penanggung_jawab' => 'Dosen A'],
            ['nama_kelas' => 'IF-B', 'penanggung_jawab' => 'Dosen B'],
            ['nama_kelas' => 'IF-C', 'penanggung_jawab' => 'Dosen C'],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }
    }
}
