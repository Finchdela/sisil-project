<?php

namespace App\Http\Controllers;

use App\Models\LaporanKerusakan;
use App\Models\Peralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanKerusakanController extends Controller
{
    // User: Lihat laporan sendiri
    public function index()
    {
        $laporan = LaporanKerusakan::with(['peralatan'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('laporan_kerusakan.index', compact('laporan'));
    }

    // User: Form buat laporan baru
    public function create()
    {
        $peralatan = Peralatan::orderBy('nama_alat')->get();
        return view('laporan_kerusakan.create', compact('peralatan'));
    }

    // User: Simpan laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:peralatan,id',
            'deskripsi_kerusakan' => 'required|string|max:1000',
            'tanggal_lapor' => 'required|date',
        ]);

        LaporanKerusakan::create([
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'deskripsi_kerusakan' => $request->deskripsi_kerusakan,
            'tanggal_lapor' => $request->tanggal_lapor,
            'status' => 'dilaporkan',
        ]);

        return redirect()->route('laporan-kerusakan.index')
            ->with('success', 'Laporan kerusakan berhasil dikirim! Admin akan menindaklanjuti laporan Anda.');
    }

    // User: Lihat detail laporan
    public function show($id)
    {
        $laporan = LaporanKerusakan::with(['peralatan', 'user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('laporan_kerusakan.show', compact('laporan'));
    }

    // Admin: Lihat semua laporan
    public function adminIndex()
    {
        $laporan = LaporanKerusakan::with(['peralatan', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total' => LaporanKerusakan::count(),
            'dilaporkan' => LaporanKerusakan::where('status', 'dilaporkan')->count(),
            'diproses' => LaporanKerusakan::where('status', 'diproses')->count(),
            'selesai' => LaporanKerusakan::where('status', 'selesai')->count(),
        ];

        return view('admin.laporan_kerusakan', compact('laporan', 'stats'));
    }

    // Admin: Update status laporan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:dilaporkan,diproses,selesai',
            'tindakan' => 'nullable|string|max:500',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $laporan = LaporanKerusakan::findOrFail($id);
        $laporan->update([
            'status' => $request->status,
            'tindakan' => $request->tindakan,
            'keterangan' => $request->keterangan,
        ]);

        // Jika status selesai, update kondisi alat menjadi rusak
        if ($request->status === 'selesai') {
            $alat = $laporan->peralatan;
            $alat->update(['kondisi' => 'rusak']);
        }

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui!');
    }
}