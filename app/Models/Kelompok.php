<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul_proyek',
        'ketua',
        'npm_ketua',
        'anggota',
        'npm_anggota',
        'lab_id',
        'jadwal_presentasi_id',
        'kelas_id',
        'status',
        'selesai',
        'jadwal_lab_opened',
    ];
    protected $casts = [
        'anggota' => 'array',
        'npm_anggota' => 'array',
    ];
    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function jadwalPresentasi()
    {
        return $this->belongsTo(JadwalPresentasi::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOwnedByUser($userId)
    {
        return $this->user_id == $userId;
    }
}
