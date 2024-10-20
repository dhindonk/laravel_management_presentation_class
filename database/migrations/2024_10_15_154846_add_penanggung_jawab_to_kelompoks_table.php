<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kelompoks', function (Blueprint $table) {
            $table->string('penanggung_jawab')->nullable(); // Menambahkan kolom penanggung_jawab
        });
    }

    public function down()
    {
        Schema::table('kelompoks', function (Blueprint $table) {
            $table->dropColumn('penanggung_jawab');
        });
    }
};
