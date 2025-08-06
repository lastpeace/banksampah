@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 shadow rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-green-700">Daftar Setoran</h2>
        <a href="{{ route('setoran.create') }}" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">+ Tambah Setoran</a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-auto">
        <table class="w-full table-auto border-collapse border border-gray-300 text-sm">
            <thead class="bg-green-100 text-left">
                <tr>
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">Tanggal</th>
                    <th class="border px-3 py-2">Nasabah</th>
                    <th class="border px-3 py-2">Jenis Sampah</th>
                    <th class="border px-3 py-2">Item</th>
                    <th class="border px-3 py-2 text-right">Berat (kg)</th>
                    <th class="border px-3 py-2 text-right">Harga/Kg (Rp)</th>
                    <th class="border px-3 py-2 text-right">Total (Rp)</th>
                    <th class="border px-3 py-2 text-right">Nasabah (Rp)</th>
                    <th class="border px-3 py-2 text-right">Pengelola (Rp)</th>
                    <th class="border px-3 py-2 text-center">Persentase (%)</th>
                    <th class="border px-3 py-2 text-center">Poin</th>
                    <th class="border px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($setorans as $index => $setoran)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2">{{ $index + 1 }}</td>
                        <td class="border px-3 py-2">{{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</td>
                        <td class="border px-3 py-2">{{ $setoran->nasabah->nama }}</td>
                        <td class="border px-3 py-2">{{ $setoran->jenis_sampah }}</td>
                        <td class="border px-3 py-2">{{ $setoran->item_sampah }}</td>
                        <td class="border px-3 py-2 text-right">{{ number_format($setoran->berat, 2) }}</td>
                        <td class="border px-3 py-2 text-right">{{ number_format($setoran->harga_per_kg) }}</td>
                        <td class="border px-3 py-2 text-right">{{ number_format($setoran->total) }}</td>
                        <td class="border px-3 py-2 text-right text-green-700 font-semibold">{{ number_format($setoran->bagi_hasil_nasabah) }}</td>
                        <td class="border px-3 py-2 text-right text-blue-700">{{ number_format($setoran->bagi_hasil_pengelola) }}</td>
                        <td class="border px-3 py-2 text-center">{{ $setoran->persentase_nasabah }}%</td>
                        <td class="border px-3 py-2 text-center">{{ $setoran->poin }}</td>
                        <td class="border px-3 py-2 text-center">
                            <a href="{{ route('setoran.edit', $setoran->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            |
                            <form action="{{ route('setoran.destroy', $setoran->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="text-center py-4 text-gray-500">Belum ada data setoran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
