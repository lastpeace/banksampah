@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-4">Tambah Nasabah</h1>

    <form method="POST" action="{{ route('nasabah.store') }}">
        @csrf

        <div class="mb-4">
            <label for="nama" class="block font-semibold">Nama</label>
            <input type="text" id="nama" name="nama" required
                class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label for="no_induk" class="block font-semibold">No. Induk</label>
            <textarea id="no_induk" name="no_induk" required
                class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-green-300"></textarea>
        </div>

        <div class="mb-4">
            <label for="alamat" class="block font-semibold">Alamat</label>
            <textarea id="alamat" name="alamat" required
                class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-green-300"></textarea>
        </div>

        <div class="mb-4">
            <label for="no_hp" class="block font-semibold">No HP</label>
            <input type="text" id="no_hp" name="no_hp" required
                class="w-full border rounded px-3 py-2 mt-1 focus:ring focus:ring-green-300">
        </div>

        <button type="submit"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        <a href="{{ route('nasabah.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
