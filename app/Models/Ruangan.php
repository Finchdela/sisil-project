<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    
    protected $fillable = [
        'nama_ruangan',
        'lokasi',
        'kapasitas',
        'deskripsi',
        'status'
    ];

    public function peralatan()
    {
        return $this->hasMany(Peralatan::class, 'ruangan_id');
    }
}