@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-semibold text-green-700 mb-4">Edit Setoran</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('setoran.update', $setoran->id) }}" method="POST" id="setoranForm">
        @csrf
        @method('PUT')

        <!-- Pilih Nasabah -->
        <div class="mb-4">
            <label for="nasabah_id" class="block font-semibold">Nasabah</label>
            <select name="nasabah_id" id="nasabah_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Pilih Nasabah --</option>
                @foreach ($nasabahs as $nasabah)
                    <option value="{{ $nasabah->id }}" {{ $nasabah->id == $setoran->nasabah_id ? 'selected' : '' }}>
                        {{ $nasabah->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label for="tanggal" class="block font-semibold">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="w-full border rounded px-3 py-2" value="{{ $setoran->tanggal }}" required>
        </div>

        <!-- Jenis Sampah -->
        <div class="mb-4">
            <label for="jenis_sampah" class="block font-semibold">Jenis Sampah</label>
            <input type="text" name="jenis_sampah" id="jenis_sampah" class="w-full border rounded px-3 py-2" value="{{ $setoran->jenis_sampah }}" required>
        </div>

        <!-- Berat -->
        <div class="mb-4">
            <label for="berat" class="block font-semibold">Berat (kg)</label>
            <input type="number" name="berat" id="berat" class="w-full border rounded px-3 py-2" step="0.1" min="0" value="{{ $setoran->berat }}" required>
        </div>

        <!-- Harga per Kg -->
        <div class="mb-4">
            <label for="harga_per_kg" class="block font-semibold">Harga per Kg (Rp)</label>
            <input type="number" name="harga_per_kg" id="harga_per_kg" class="w-full border rounded px-3 py-2" step="100" min="0" value="{{ $setoran->harga_per_kg }}" required>
        </div>

        <!-- Total -->
        <div class="mb-4">
            <label for="total" class="block font-semibold">Total (Rp)</label>
            <input type="number" name="total" id="total" class="w-full border rounded px-3 py-2" value="{{ $setoran->total }}" readonly required>
        </div>

        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded font-semibold w-full">
            Update Setoran
        </button>
    </form>
</div>

<!-- Script untuk hitung total otomatis -->
<script>
    const beratInput = document.getElementById('berat');
    const hargaInput = document.getElementById('harga_per_kg');
    const totalInput = document.getElementById('total');

    function hitungTotal() {
        const berat = parseFloat(beratInput.value) || 0;
        const harga = parseFloat(hargaInput.value) || 0;
        totalInput.value = berat * harga;
    }

    beratInput.addEventListener('input', hitungTotal);
    hargaInput.addEventListener('input', hitungTotal);
</script>
@endsection
