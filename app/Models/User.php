<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationships
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function laporanKerusakan()
    {
        return $this->hasMany(LaporanKerusakan::class);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDosen()
    {
        return $this->role === 'dosen';
    }

    public function isAsisten()
    {
        return $this->role === 'asisten';
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }
}