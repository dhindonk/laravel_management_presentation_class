<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = ['nama_lab'];

    // Relasi ke model Kelompok
    public function kelompoks()
    {
        return $this->hasMany(Kelompok::class);
    }
}
