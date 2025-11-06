<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';

    protected $fillable = [
        'nama_ruang', 'kapasitas', 'lokasi', 'fasilitas'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'ruang_id');
    }
}