@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-green-700 mb-4">Data Setoran Sampah</h1>

    <a href="{{ route('setoran.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-green-700">
        + Tambah Setoran
    </a>

    <table class="min-w-full bg-white">
        <thead class="bg-green-100">
            <tr>
                <th class="py-2 px-4 border-b text-left">No</th>
                <th class="py-2 px-4 border-b text-left">Tanggal</th>
                <th class="py-2 px-4 border-b text-left">Nasabah</th>
                <th class="py-2 px-4 border-b text-left">Jenis Sampah</th>
                <th class="py-2 px-4 border-b text-left">Berat (Kg)</th>
                <th class="py-2 px-4 border-b text-left">Total</th>
                <th class="py-2 px-4 border-b text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($setorans as $setoran)
            <tr>
                <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                <td class="py-2 px-4 border-b">{{ $setoran->tanggal }}</td>
                <td class="py-2 px-4 border-b">{{ $setoran->nasabah->nama ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ $setoran->jenis_sampah }}</td>
                <td class="py-2 px-4 border-b">{{ $setoran->berat }}</td>
                <td class="py-2 px-4 border-b">Rp {{ number_format($setoran->total, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b space-x-2">
                    <a href="{{ route('setoran.edit', $setoran) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('setoran.destroy', $setoran) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
