@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-green-700 mb-4">Data Penarikan Uang</h1>

    <a href="{{ route('penarikan.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-green-700">
        + Tambah Penarikan
    </a>

    <table class="min-w-full bg-white">
        <thead class="bg-green-100">
            <tr>
                <th class="py-2 px-4 border-b text-left">#</th>
                <th class="py-2 px-4 border-b text-left">Tanggal</th>
                <th class="py-2 px-4 border-b text-left">Nasabah</th>
                <th class="py-2 px-4 border-b text-left">Jumlah</th>
                <th class="py-2 px-4 border-b text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penarikans as $penarikan)
            <tr>
                <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                <td class="py-2 px-4 border-b">{{ $penarikan->tanggal }}</td>
                <td class="py-2 px-4 border-b">{{ $penarikan->nasabah->nama ?? '-' }}</td>
                <td class="py-2 px-4 border-b">Rp {{ number_format($penarikan->jumlah, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('penarikan.edit', $penarikan) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('penarikan.destroy', $penarikan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
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
