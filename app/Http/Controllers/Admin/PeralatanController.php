<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peralatan;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeralatanController extends Controller
{
    public function index()
    {
        $peralatan = Peralatan::with('ruangan')->get();
        return view('admin.peralatan.index', compact('peralatan'));
    }

    public function create()
    {
        $ruangan = Ruangan::all();
        return view('admin.peralatan.create', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ruangan_id' => 'required|exists:ruangan,id',
            'nama_alat' => 'required|string|max:255',
            'kode_alat' => 'required|string|unique:peralatan,kode_alat|max:50',
            'merk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Peralatan::create([
            'ruangan_id' => $request->ruangan_id,
            'nama_alat' => $request->nama_alat,
            'kode_alat' => $request->kode_alat,
            'merk' => $request->merk,
            'tipe' => $request->tipe,
            'jumlah' => $request->jumlah,
            'kondisi' => $request->kondisi,
            'status' => 'tersedia',
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.peralatan.index')
            ->with('success', 'Peralatan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $peralatan = Peralatan::findOrFail($id); // PERBAIKAN: findOrFall -> findOrFail
        $ruangan = Ruangan::all();
        return view('admin.peralatan.edit', compact('peralatan', 'ruangan')); // PERBAIKAN: edu! -> edit
    }

    public function update(Request $request, $id)
    {
        $peralatan = Peralatan::findOrFail($id); // PERBAIKAN: findOrFall -> findOrFail

        $validator = Validator::make($request->all(), [
            'ruangan_id' => 'required|exists:ruangan,id', // PERBAIKAN: required[ -> required|
            'nama_alat' => 'required|string|max:255', // PERBAIKAN: required] -> required|
            'kode_alat' => 'required|string|max:50|unique:peralatan,kode_alat,' . $id, // PERBAIKAN: required] -> required|
            'merk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $peralatan->update($request->all());

        return redirect()->route('admin.peralatan.index')
            ->with('success', 'Peralatan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $peralatan = Peralatan::findOrFail($id);
        $peralatan->delete();

        return redirect()->route('admin.peralatan.index')
            ->with('success', 'Peralatan berhasil dihapus');
    }
}