<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKerusakan extends Model
{
    use HasFactory;

    protected $table = 'laporan_kerusakan';

    protected $fillable = [
        'user_id', 'alat_id', 'deskripsi_kerusakan', 'tanggal_lapor', 
        'status', 'tindakan', 'keterangan'
    ];

    protected $casts = [
        'tanggal_lapor' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peralatan()
    {
        return $this->belongsTo(Peralatan::class, 'alat_id');
    }

    // Helper methods untuk status
    public function isDilaporkan()
    {
        return $this->status === 'dilaporkan';
    }

    public function isDiproses()
    {
        return $this->status === 'diproses';
    }

    public function isSelesai()
    {
        return $this->status === 'selesai';
    }

    // Scope untuk filter status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}