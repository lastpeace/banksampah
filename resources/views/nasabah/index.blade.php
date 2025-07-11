@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl text-green-700 font-bold mb-4">Data Nasabah</h1>

    <a href="{{ route('nasabah.create') }}"
        class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-green-700">
        + Tambah Nasabah
    </a>

    <table class="min-w-full bg-white">
        <thead class="bg-green-100">
            <tr>
                <th class="py-2 px-4 border-b text-left">No</th>
                <th class="py-2 px-4 border-b text-left">Nama</th>
                <th class="py-2 px-4 border-b text-left">Alamat</th>
                <th class="py-2 px-4 border-b text-left">No HP</th>
                <th class="py-2 px-4 border-b text-left">Saldo</th>
                <th class="py-2 px-4 border-b text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nasabahs as $nasabah)
            <tr>
                <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                <td class="py-2 px-4 border-b">{{ $nasabah->nama }}</td>
                <td class="py-2 px-4 border-b">{{ $nasabah->alamat }}</td>
                <td class="py-2 px-4 border-b">{{ $nasabah->no_hp }}</td>
                <td class="py-2 px-4 border-b">Rp {{ number_format($nasabah->saldo, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b flex space-x-2">
                    <a href="{{ route('nasabah.edit', $nasabah) }}"
                        class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('nasabah.destroy', $nasabah) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus?')">
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
