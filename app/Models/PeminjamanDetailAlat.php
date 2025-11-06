<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetailAlat extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_detail_alat';

    protected $fillable = [
        'peminjaman_id', 'alat_id', 'jumlah_pinjam'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function peralatan()
    {
        return $this->belongsTo(Peralatan::class, 'alat_id');
    }
}