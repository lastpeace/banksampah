@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-4">Detail Setoran</h1>

    <p><strong>Nasabah:</strong> {{ $setoran->nasabah->nama ?? '-' }}</p>
    <p><strong>Tanggal:</strong> {{ $setoran->tanggal }}</p>
    <p><strong>Jenis Sampah:</strong> {{ $setoran->jenis }}</p>
    <p><strong>Berat:</strong> {{ $setoran->berat }} Kg</p>
    <p><strong>Total:</strong> Rp {{ number_format($setoran->total, 0, ',', '.') }}</p>

    <a href="{{ route('setoran.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">← Kembali</a>
</div>
@endsection
