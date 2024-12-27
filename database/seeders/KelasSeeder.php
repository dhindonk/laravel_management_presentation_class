<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $kelas = [
            ['nama_kelas' => 'Gab A', 'penanggung_jawab' => 'Moch. Fahdin'],
            ['nama_kelas' => 'Gab B', 'penanggung_jawab' => 'Ajiz Abdul Majid'],
            ['nama_kelas' => 'Gab C', 'penanggung_jawab' => 'Ajiz Abdul Majid'],
            ['nama_kelas' => 'Gab D', 'penanggung_jawab' => 'Moch. Fahdin'],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }
    }
}
