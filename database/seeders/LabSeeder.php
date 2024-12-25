<?php

namespace Database\Seeders;

use App\Models\Lab;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    public function run()
    {
        $labs = [
            ['nama_lab' => 'Lab Data Science'],
            ['nama_lab' => 'Lab Multimedia'],
            ['nama_lab' => 'Lab Sistem Cerdas'],
        ];

        foreach ($labs as $lab) {
            Lab::create($lab);
        }
    }
}
