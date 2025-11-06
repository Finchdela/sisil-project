<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan;
use App\Models\Peralatan;
use App\Models\PeminjamanDetailAlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['ruangan', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $ruangan = Ruangan::all();
        $peralatan = Peralatan::where('jumlah_tersedia', '>', 0)->get();
        
        return view('peminjaman.create', compact('ruangan', 'peralatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruang_id' => 'required|exists:ruangan,id',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'tujuan_peminjaman' => 'required|string|max:500',
            'alat_id' => 'sometimes|array',
            'alat_id.*' => 'exists:peralatan,id'
        ]);

        // Cek konflik jadwal
        $konflik = Peminjaman::where('ruang_id', $request->ruang_id)
            ->where('status', 'disetujui')
            ->where(function($query) use ($request) {
                $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                      ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai])
                      ->orWhere(function($q) use ($request) {
                          $q->where('waktu_mulai', '<=', $request->waktu_mulai)
                            ->where('waktu_selesai', '>=', $request->waktu_selesai);
                      });
            })->exists();

        if ($konflik) {
            return back()->withErrors(['error' => 'Ruangan sudah dipesan pada waktu tersebut!'])->withInput();
        }

        // Create peminjaman
        $peminjaman = Peminjaman::create([
            'user_id' => Auth::id(),
            'ruang_id' => $request->ruang_id,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'tujuan_peminjaman' => $request->tujuan_peminjaman,
            'status' => 'pending'
        ]);

        // Attach peralatan jika ada
        if ($request->has('alat_id')) {
            foreach ($request->alat_id as $alatId) {
                $peminjaman->peralatan()->attach($alatId, [
                    'jumlah_pinjam' => 1
                ]);

                // Kurangi stok tersedia
                $alat = Peralatan::find($alatId);
                $alat->decrement('jumlah_tersedia');
            }
        }

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diajukan! Menunggu persetujuan admin.');
    }

    public function kalender()
    {
        $events = Peminjaman::with(['ruangan', 'user'])
            ->where('status', 'disetujui')
            ->get()
            ->map(function ($peminjaman) {
                return [
                    'title' => $peminjaman->ruangan->nama_ruang . ' - ' . $peminjaman->user->name,
                    'start' => $peminjaman->waktu_mulai,
                    'end' => $peminjaman->waktu_selesai,
                    'color' => '#0d6efd',
                ];
            });

        return view('peminjaman.kalender', compact('events'));
    }
} 