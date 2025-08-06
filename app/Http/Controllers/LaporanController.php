<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setoran;
use App\Models\Penarikan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal awal & akhir dari input atau default ke bulan ini
        $start = $request->input('start') ?? now()->startOfMonth()->toDateString();
        $end = $request->input('end') ?? now()->endOfMonth()->toDateString();

        // Ambil data Setoran (asli, untuk perhitungan)
        $setoranModels = Setoran::with('nasabah')
            ->whereBetween('tanggal', [$start, $end])
            ->get();

        // Ambil data Penarikan (asli, untuk perhitungan)
        $penarikanModels = Penarikan::with('nasabah')
            ->whereBetween('tanggal', [$start, $end])
            ->get();

        // Format untuk ditampilkan di tabel laporan
        $setorans = $setoranModels->map(function ($item) {
            return [
                'tanggal' => $item->tanggal,
                'jenis' => 'Setoran',
                'nasabah' => $item->nasabah,
                'jumlah' => $item->bagi_hasil_nasabah ?? 0, // hanya tampilkan bagi hasil nasabah
            ];
        });

        $penarikans = $penarikanModels->map(function ($item) {
            return [
                'tanggal' => $item->tanggal,
                'jenis' => 'Penarikan',
                'nasabah' => $item->nasabah,
                'jumlah' => $item->jumlah,
            ];
        });

        // Gabungkan semua transaksi & urutkan dari terbaru
        $transaksis = $setorans->merge($penarikans)->sortByDesc('tanggal');

        // Hitung total
        $totalSetoran = $setoranModels->sum('bagi_hasil_nasabah');
        $totalPenarikan = $penarikanModels->sum('jumlah');
        $saldoBersih = $totalSetoran - $totalPenarikan;
        $totalBagiHasilPengelola = $setoranModels->sum('bagi_hasil_pengelola');

        // Kirim ke view
        return view('laporan.index', compact(
            'transaksis',
            'totalSetoran',
            'totalPenarikan',
            'saldoBersih',
            'totalBagiHasilPengelola',
            'start',
            'end'
        ));
    }
}
