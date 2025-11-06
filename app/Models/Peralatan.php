<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;

    protected $table = 'peralatan';
    
    protected $fillable = [
        'ruangan_id',
        'nama_alat',
        'kode_alat',
        'merk',
        'tipe',
        'jumlah',
        'kondisi',
        'status',
        'deskripsi'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function laporanKerusakan()
    {
        return $this->hasMany(LaporanKerusakan::class, 'alat_id');
    }
}