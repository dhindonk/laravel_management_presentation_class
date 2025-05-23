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
        Schema::create('jadwal_presentasis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_presentasi');
            $table->enum('status', ['normal', 'pending', 'approved', 'rejected'])->default('normal');
            $table->time('waktu_presentasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_presentasis');
    }
};
