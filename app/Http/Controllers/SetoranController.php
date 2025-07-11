<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setoran;
use App\Models\Nasabah;

class SetoranController extends Controller
{

    public function index()
    {
        $setorans = Setoran::with('nasabah')->orderBy('tanggal', 'desc')->get();
        return view('setoran.index', compact('setorans'));
    }


    public function create()
    {
        $nasabahs = Nasabah::all();
        return view('setoran.create', compact('nasabahs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'tanggal' => 'required|date',
            'jenis_sampah' => 'required|string|max:255',
            'berat' => 'required|numeric|min:0',
            'harga_per_kg' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        // Simpan setoran
        $setoran = Setoran::create([
            'nasabah_id' => $request->nasabah_id,
            'tanggal' => $request->tanggal,
            'jenis_sampah' => $request->jenis_sampah,
            'berat' => $request->berat,
            'harga_per_kg' => $request->harga_per_kg,
            'total' => $request->total,
        ]);

        // Tambahkan saldo ke nasabah
        $nasabah = $setoran->nasabah;
        $nasabah->saldo += $setoran->total;
        $nasabah->save();

        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil disimpan dan saldo nasabah bertambah.');
    }


    /**
     * Tampilkan form edit setoran.
     */
    public function edit(Setoran $setoran)
    {
        $nasabahs = Nasabah::all();
        return view('setoran.edit', compact('setoran', 'nasabahs'));
    }

    /**
     * Update data setoran.
     */
    public function update(Request $request, Setoran $setoran)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'tanggal' => 'required|date',
            'jenis_sampah' => 'required|string|max:255',
            'berat' => 'required|numeric|min:0',
            'jumlah' => 'required|numeric|min:0'
        ]);

        $setoran->update([
            'nasabah_id' => $request->nasabah_id,
            'tanggal' => $request->tanggal,
            'jenis_sampah' => $request->jenis_sampah,
            'berat' => $request->berat,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil diperbarui.');
    }

    /**
     * Hapus data setoran.
     */
    public function destroy(Setoran $setoran)
    {
        $setoran->delete();
        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil dihapus.');
    }
}
