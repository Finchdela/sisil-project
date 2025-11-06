<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan;
use App\Models\Peralatan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_peminjaman' => Peminjaman::count(),
            'peminjaman_pending' => Peminjaman::where('status', 'pending')->count(),
            'total_ruangan' => Ruangan::count(),
            'total_alat' => Peralatan::count(),
            'alat_rusak' => Peralatan::where('kondisi', 'rusak')->count(),
        ];

        $peminjaman_terbaru = Peminjaman::with(['user', 'ruangan'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'peminjaman_terbaru'));
    }

    public function peminjaman()
    {
        $peminjaman = Peminjaman::with(['user', 'ruangan', 'peralatan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.peminjaman', compact('peminjaman'));
    }

    public function approvePeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => 'disetujui']);

        return redirect()->back()->with('success', 'Peminjaman berhasil disetujui!');
    }

    public function rejectPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Kembalikan stok alat jika ada
        foreach ($peminjaman->peralatan as $alat) {
            $alat->increment('jumlah_tersedia', $alat->pivot->jumlah_pinjam);
        }

        $peminjaman->update(['status' => 'ditolak']);

        return redirect()->back()->with('success', 'Peminjaman berhasil ditolak!');
    }
}