<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setoran;
use App\Models\Penarikan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start') ?? now()->startOfMonth()->toDateString();
        $end = $request->input('end') ?? now()->endOfMonth()->toDateString();

        $setorans = Setoran::with('nasabah')
            ->whereBetween('tanggal', [$start, $end])
            ->get()
            ->map(fn($item) => [
                'tanggal' => $item->tanggal,
                'jenis' => 'Setoran',
                'nasabah' => $item->nasabah,
                'jumlah' => $item->total,
            ]);

        $penarikans = Penarikan::with('nasabah')
            ->whereBetween('tanggal', [$start, $end])
            ->get()
            ->map(fn($item) => [
                'tanggal' => $item->tanggal,
                'jenis' => 'Penarikan',
                'nasabah' => $item->nasabah,
                'jumlah' => $item->jumlah,
            ]);

        $transaksis = $setorans->merge($penarikans)->sortByDesc('tanggal');

        $totalSetoran = $setorans->sum('jumlah');
        $totalPenarikan = $penarikans->sum('jumlah');
        $saldoBersih = $totalSetoran - $totalPenarikan;

        return view('laporan.index', compact(
            'totalSetoran',
            'totalPenarikan',
            'saldoBersih',
            'transaksis'
        ));
    }



}
