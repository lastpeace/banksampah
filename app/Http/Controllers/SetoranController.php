<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Nasabah;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    // Tampilkan semua setoran
    public function index()
    {
        $setorans = Setoran::with('nasabah')->latest()->get();
        return view('setoran.index', compact('setorans'));
    }

    // Form tambah setoran
    public function create()
    {
        $nasabahs = Nasabah::all();
        return view('setoran.create', compact('nasabahs'));
    }

    // Simpan setoran baru
    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'tanggal' => 'required|date',
            'jenis_sampah' => 'required|string|max:255',
            'item_sampah' => 'nullable|string|max:255',
            'berat' => 'required|numeric|min:0',
            'harga_per_kg' => 'required|numeric|min:0',
            'poin' => 'nullable|integer',
            'persentase_nasabah' => 'nullable|integer|min:0|max:100',
        ]);

        $berat = $request->berat;
        $harga = $request->harga_per_kg;
        $total = $berat * $harga;

        $persentase = $request->persentase_nasabah ?? 50;
        $bagi_nasabah = ($total * $persentase) / 100;
        $bagi_pengelola = $total - $bagi_nasabah;

        $setoran = Setoran::create([
            'nasabah_id'           => $request->nasabah_id,
            'tanggal'              => $request->tanggal,
            'jenis_sampah'         => $request->jenis_sampah,
            'item_sampah'          => $request->item_sampah,
            'berat'                => $berat,
            'harga_per_kg'         => $harga,
            'total'                => $total,
            'persentase_nasabah'  => $persentase,
            'bagi_hasil_nasabah'  => $bagi_nasabah,
            'bagi_hasil_pengelola'=> $bagi_pengelola,
            'poin'                 => $request->poin,
        ]);

        // Tambahkan ke saldo nasabah
        $nasabah = Nasabah::find($request->nasabah_id);
        $nasabah->saldo += $bagi_nasabah;
        $nasabah->save();

        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil disimpan.');
    }

    // Form edit
    public function edit(Setoran $setoran)
    {
        $nasabahs = Nasabah::all();
        return view('setoran.edit', compact('setoran', 'nasabahs'));
    }

    // Update data setoran
    public function update(Request $request, Setoran $setoran)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'tanggal' => 'required|date',
            'jenis_sampah' => 'required|string|max:255',
            'item_sampah' => 'nullable|string|max:255',
            'berat' => 'required|numeric|min:0',
            'harga_per_kg' => 'required|numeric|min:0',
            'poin' => 'nullable|integer',
            'persentase_nasabah' => 'nullable|integer|min:0|max:100',
        ]);

        // Hitung ulang
        $berat = $request->berat;
        $harga = $request->harga_per_kg;
        $total = $berat * $harga;
        $persentase = $request->persentase_nasabah ?? 50;
        $bagi_nasabah = ($total * $persentase) / 100;
        $bagi_pengelola = $total - $bagi_nasabah;

        // Kurangi saldo nasabah sebelumnya
        $nasabahLama = Nasabah::find($setoran->nasabah_id);
        $nasabahLama->saldo -= $setoran->bagi_hasil_nasabah;
        $nasabahLama->save();

        // Update setoran
        $setoran->update([
            'nasabah_id'           => $request->nasabah_id,
            'tanggal'              => $request->tanggal,
            'jenis_sampah'         => $request->jenis_sampah,
            'item_sampah'          => $request->item_sampah,
            'berat'                => $berat,
            'harga_per_kg'         => $harga,
            'total'                => $total,
            'persentase_nasabah'  => $persentase,
            'bagi_hasil_nasabah'  => $bagi_nasabah,
            'bagi_hasil_pengelola'=> $bagi_pengelola,
            'poin'                 => $request->poin,
        ]);

        // Tambah saldo nasabah baru
        $nasabahBaru = Nasabah::find($request->nasabah_id);
        $nasabahBaru->saldo += $bagi_nasabah;
        $nasabahBaru->save();

        return redirect()->route('setoran.index')->with('success', 'Data setoran berhasil diperbarui.');
    }

    // Hapus setoran
    public function destroy(Setoran $setoran)
    {
        // Kurangi saldo nasabah
        $nasabah = Nasabah::find($setoran->nasabah_id);
        $nasabah->saldo -= $setoran->bagi_hasil_nasabah;
        $nasabah->save();

        $setoran->delete();

        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil dihapus.');
    }
}
