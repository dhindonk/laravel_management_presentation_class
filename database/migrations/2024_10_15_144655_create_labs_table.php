<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lab')->unique();
            $table->timestamps();
        });

        // Tambahkan beberapa data lab sebagai default
        DB::table('labs')->insert([
            ['nama_lab' => 'Lab Data Science'],
            ['nama_lab' => 'Lab Multimedia'],
            ['nama_lab' => 'Lab Sistem Cerdas'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labs');
    }
};
