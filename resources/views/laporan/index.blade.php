@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Laporan Keuangan</h1>

    <!-- Filter Rentang Tanggal -->
    <form method="GET" class="mb-6 flex flex-col md:flex-row items-start md:items-end gap-4">
        <div>
            <label for="start" class="text-sm text-gray-700 font-semibold">Tanggal Awal</label>
            <input type="date" name="start" id="start" value="{{ e(request('start', now()->subMonth()->toDateString())) }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div>
            <label for="end" class="text-sm text-gray-700 font-semibold">Tanggal Akhir</label>
            <input type="date" name="end" id="end" value="{{ e(request('end', now()->toDateString())) }}" class="border rounded px-3 py-2 w-full">
        </div>
        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mt-6">Filter</button>
        </div>
    </form>

    <!-- Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded shadow">
            <p class="text-gray-600">Total Setoran</p>
            <p class="text-xl font-bold text-green-700">Rp {{ number_format($totalSetoran, 0, ',', '.') }}</p>
        </div>

        <div class="bg-red-100 border-l-4 border-red-500 p-4 rounded shadow">
            <p class="text-gray-600">Total Penarikan</p>
            <p class="text-xl font-bold text-red-600">Rp {{ number_format($totalPenarikan, 0, ',', '.') }}</p>
        </div>

        <div class="bg-blue-100 border-l-4 border-blue-500 p-4 rounded shadow">
            <p class="text-gray-600">Saldo Bersih</p>
            <p class="text-xl font-bold text-blue-700">Rp {{ number_format($saldoBersih, 0, ',', '.') }}</p>
        </div>

        <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded shadow">
        <p class="text-gray-600">Bagi Hasil Pengelola</p>
        <p class="text-xl font-bold text-yellow-700">Rp {{ number_format($totalBagiHasilPengelola, 0, ',', '.') }}</p>
    </div>
    </div>

    <!-- Tabel Transaksi -->
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Riwayat Transaksi</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200 rounded">
                <thead class="bg-green-100 text-green-800">
                    <tr>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Jenis</th>
                        <th class="px-4 py-2">Nama Nasabah</th>
                        <th class="px-4 py-2">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($transaksi['tanggal'])->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">
                                <span class="font-semibold {{ $transaksi['jenis'] === 'Setoran' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ e($transaksi['jenis']) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ optional($transaksi['nasabah'])->nama ?? '-' }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($transaksi['jumlah'], 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Tidak ada data transaksi dalam rentang ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
