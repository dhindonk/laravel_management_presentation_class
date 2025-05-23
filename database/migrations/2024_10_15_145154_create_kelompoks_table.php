<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelompoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('judul_proyek');
            $table->string('ketua');
            $table->string('link')->nullable();
            $table->string('npm_ketua');
            $table->json('anggota')->nullable();
            $table->json('npm_anggota')->nullable();
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->foreignId('jadwal_presentasi_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('requested_jadwal_id')->nullable()->constrained('jadwal_presentasis')->onDelete('set null');
            $table->foreignId('lab_id')->nullable()->constrained('labs');
            $table->enum('status', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->boolean('selesai')->default(false);
            $table->boolean('mode')->default(false);
            $table->boolean('jadwal_lab_opened')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompoks');
    }
};
