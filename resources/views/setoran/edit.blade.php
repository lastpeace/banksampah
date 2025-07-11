@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-4">Edit Setoran Sampah</h1>

    <form method="POST" action="{{ route('setoran.update', $setoran) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nasabah_id" class="block font-semibold">Nama Nasabah</label>
            <select name="nasabah_id" id="nasabah_id" class="w-full border rounded px-3 py-2">
                @foreach ($nasabahs as $nasabah)
                    <option value="{{ $nasabah->id }}" {{ $nasabah->id == $setoran->nasabah_id ? 'selected' : '' }}>
                        {{ $nasabah->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="tanggal" class="block font-semibold">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ $setoran->tanggal }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="jenis" class="block font-semibold">Jenis Sampah</label>
            <input type="text" name="jenis" id="jenis" value="{{ $setoran->jenis }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="berat" class="block font-semibold">Berat (Kg)</label>
            <input type="number" name="berat" id="berat" step="0.01" value="{{ $setoran->berat }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="total" class="block font-semibold">Total (Rp)</label>
            <input type="number" name="total" id="total" value="{{ $setoran->total }}" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        <a href="{{ route('setoran.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection
