@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-4">Edit Penarikan</h1>

    {{-- Alert error --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Alert success --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('penarikan.update', $penarikan->id) }}">
        @csrf
        @method('PUT')

        {{-- Nama Nasabah (tidak bisa diubah) --}}
        <div class="mb-4">
            <label class="block font-semibold">Nama Nasabah</label>
            <input type="text" value="{{ $penarikan->nasabah->nama }}" disabled
                class="w-full border rounded px-3 py-2 bg-gray-100">
        </div>

        {{-- Tanggal --}}
        <div class="mb-4">
            <label for="tanggal" class="block font-semibold">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $penarikan->tanggal) }}"
                class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Jumlah --}}
        <div class="mb-4">
            <label for="jumlah" class="block font-semibold">Jumlah (Rp)</label>
            <input type="number" name="jumlah" value="{{ old('jumlah', $penarikan->jumlah) }}"
                class="w-full border rounded px-3 py-2" min="1" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
        <a href="{{ route('penarikan.index') }}" class="ml-3 text-gray-600 hover:underline">Kembali</a>
    </form>
</div>
@endsection
