@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl px-4 py-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">💼 Penarikan Saldo Pengelola</h2>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 text-red-800 border border-red-300 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Saldo --}}
    <div class="bg-white shadow-sm rounded-lg p-4 mb-6 border">
        <p class="text-lg font-semibold text-gray-700">💰 Saldo Tersedia: 
            <span class="text-blue-600">Rp {{ number_format($saldoPengelola, 0, ',', '.') }}</span>
        </p>
    </div>

    {{-- Form Penarikan --}}
    <form method="POST" action="{{ route('pengelola.store') }}" class="bg-white shadow-md rounded-lg p-6 mb-8 border space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Penarikan</label>
                <input type="number" name="jumlah" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Rp" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <input type="text" name="keterangan" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Opsional">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow transition">Tarik</button>
            </div>
        </div>
    </form>

    {{-- Riwayat Penarikan --}}
    <div class="bg-white shadow rounded-lg border">
        <div class="p-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">📄 Riwayat Penarikan</h3>
        </div>
        <div class="overflow-x-auto">
            <!-- Tambahkan kolom aksi pada tabel -->
<table class="min-w-full text-sm text-left">
    <thead class="bg-gray-100 border-b text-gray-700">
        <tr>
            <th class="px-6 py-3">Tanggal</th>
            <th class="px-6 py-3">Jumlah</th>
            <th class="px-6 py-3">Keterangan</th>
            <th class="px-6 py-3 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 text-gray-800">
        @forelse ($penarikans as $penarikan)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-3">{{ $penarikan->tanggal }}</td>
                <td class="px-6 py-3">Rp {{ number_format($penarikan->jumlah, 0, ',', '.') }}</td>
                <td class="px-6 py-3">{{ $penarikan->keterangan ?? '-' }}</td>
                <td class="px-6 py-3 text-center">
                    <form action="{{ route('pengelola.destroy', $penarikan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">Belum ada penarikan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

        </div>
    </div>
</div>
@endsection
