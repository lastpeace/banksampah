@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <h1 class="text-2xl font-bold text-green-700 mb-4">Detail Nasabah</h1>

    <p><strong>Nama:</strong> {{ $nasabah->nama }}</p>
    <p><strong>Alamat:</strong> {{ $nasabah->alamat }}</p>
    <p><strong>No HP:</strong> {{ $nasabah->no_hp }}</p>
    <p><strong>Saldo:</strong> Rp {{ number_format($nasabah->saldo, 0, ',', '.') }}</p>

    <a href="{{ route('nasabah.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">← Kembali</a>
</div>
@endsection
