<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;

    protected $table = 'peralatan';

    protected $fillable = [
        'nama_alat', 'kategori', 'jumlah_total', 'jumlah_tersedia', 'kondisi'
    ];

    public function peminjamanDetail()
    {
        return $this->hasMany(PeminjamanDetailAlat::class, 'alat_id');
    }
}