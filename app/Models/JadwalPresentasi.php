<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPresentasi extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal_presentasi', 'waktu_presentasi', 'status'];

    // Relasi ke model Kelompok
    public function kelompok()
    {
        return $this->hasMany(Kelompok::class);
    }
}
