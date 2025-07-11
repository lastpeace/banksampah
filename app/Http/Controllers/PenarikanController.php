<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Nasabah;
use Illuminate\Http\Request;

class PenarikanController extends Controller
{
    public function index()
    {
        $penarikans = Penarikan::with('nasabah')->latest()->get();
        return view('penarikan.index', compact('penarikans'));
    }

    public function create()
    {
        $nasabahs = Nasabah::all();
        return view('penarikan.create', compact('nasabahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $nasabah = Nasabah::findOrFail($request->nasabah_id);

        if ($nasabah->saldo < $request->jumlah) {
            return redirect()->back()->withErrors(['jumlah' => 'Saldo tidak mencukupi untuk penarikan.'])->withInput();
        }

        // Kurangi saldo
        $nasabah->saldo -= $request->jumlah;
        $nasabah->save();

        Penarikan::create([
            'nasabah_id' => $request->nasabah_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('penarikan.index')->with('success', 'Penarikan berhasil disimpan dan saldo dikurangi.');
    }

    public function edit(Penarikan $penarikan)
    {
        return view('penarikan.edit', compact('penarikan'));
    }

    public function update(Request $request, Penarikan $penarikan)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $nasabah = $penarikan->nasabah;

        $jumlah_lama = $penarikan->jumlah;
        $jumlah_baru = $request->jumlah;
        $selisih = $jumlah_baru - $jumlah_lama;

        if ($selisih > 0 && $nasabah->saldo < $selisih) {
            return redirect()->back()->withErrors(['jumlah' => 'Saldo tidak mencukupi untuk menaikkan jumlah penarikan.'])->withInput();
        }

        // Update saldo sesuai selisih
        $nasabah->saldo -= $selisih;
        $nasabah->save();

        // Update data penarikan
        $penarikan->update([
            'tanggal' => $request->tanggal,
            'jumlah' => $jumlah_baru,
        ]);

        return redirect()->route('penarikan.index')->with('success', 'Penarikan berhasil diperbarui.');
    }

    public function destroy(Penarikan $penarikan)
    {
        $nasabah = $penarikan->nasabah;

        // Kembalikan saldo
        $nasabah->saldo += $penarikan->jumlah;
        $nasabah->save();

        $penarikan->delete();

        return redirect()->route('penarikan.index')->with('success', 'Penarikan berhasil dihapus dan saldo dikembalikan.');
    }
}
