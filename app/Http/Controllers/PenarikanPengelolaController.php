<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenarikanPengelola;
use App\Models\Setoran;

class PenarikanPengelolaController extends Controller
{
    public function index()
    {
        $penarikans = PenarikanPengelola::latest()->get();
        $totalBagiHasil = Setoran::sum('bagi_hasil_pengelola');
        $totalPenarikan = PenarikanPengelola::sum('jumlah');
        $saldoPengelola = $totalBagiHasil - $totalPenarikan;

        return view('pengelola.index', compact('penarikans', 'saldoPengelola'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $totalBagiHasil = Setoran::sum('bagi_hasil_pengelola');
        $totalPenarikan = PenarikanPengelola::sum('jumlah');
        $saldo = $totalBagiHasil - $totalPenarikan;

        if ($request->jumlah > $saldo) {
            return back()->with('error', 'Saldo pengelola tidak mencukupi!');
        }

        PenarikanPengelola::create([
            'tanggal' => now(),
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengelola.index')->with('success', 'Penarikan berhasil!');
    }

    public function destroy($id)
{
    $penarikan = PenarikanPengelola::findOrFail($id);
    $penarikan->delete();

    return redirect()->route('pengelola.index')->with('success', 'Penarikan berhasil dihapus.');
}
}
