<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'asprak@admin.com',
            'password' => Hash::make('mobpro2024'),
            'role' => 'admin'
        ]);

        // Create sample student user
        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa'
        ]);
    }
}
