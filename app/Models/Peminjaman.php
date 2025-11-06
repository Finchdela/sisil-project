<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id', 'ruang_id', 'waktu_mulai', 'waktu_selesai', 'tujuan_peminjaman', 'status'
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruang_id');
    }

    public function peralatan()
    {
        return $this->belongsToMany(Peralatan::class, 'peminjaman_detail_alat', 'peminjaman_id', 'alat_id')
                    ->withPivot('jumlah_pinjam')
                    ->withTimestamps();
    }
}