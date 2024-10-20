<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelompok_id', 'nama_penilai', 'penilaian_presentasi', 'penilaian_materi', 'penilaian_diskusi', 'catatan'
    ];

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }
}
