@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-4">Tambah Penarikan</h1>

    {{-- Alert error jika saldo tidak cukup --}}
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

    <form method="POST" action="{{ route('penarikan.store') }}">
        @csrf

        <div class="mb-4">
            <label for="nasabah_id" class="block font-semibold">Nama Nasabah</label>
            <select name="nasabah_id" id="nasabah_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Nasabah --</option>
                @foreach ($nasabahs as $nasabah)
                    <option value="{{ $nasabah->id }}" {{ old('nasabah_id') == $nasabah->id ? 'selected' : '' }}>
                        {{ $nasabah->nama }} (Saldo: Rp{{ number_format($nasabah->saldo, 0, ',', '.') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="tanggal" class="block font-semibold">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="jumlah" class="block font-semibold">Jumlah (Rp)</label>
            <input type="number" name="jumlah" value="{{ old('jumlah') }}" class="w-full border rounded px-3 py-2" min="1" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
    </form>
</div>
@endsection
