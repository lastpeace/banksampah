<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="relative min-h-[calc(100vh-4rem)] flex items-center justify-center">
    <!-- Background -->
    {{-- <img src="{{ asset('images/background.png') }}" alt="Background"
         class="absolute inset-0 w-full h-full object-cover opacity-40"> --}}

    <!-- Teks Selamat Datang -->
    <div class="relative z-10 text-center bg-white/60 backdrop-blur-md p-8 rounded-lg shadow-lg max-w-xl">
        <h1 class="text-4xl font-bold text-green-900">Selamat Datang,</h1>
        <p class="text-lg text-green-800 mt-2">di Pencatatan Keuangan <span class="font-semibold">Bank Sampah Desa Kalongan</span>.</p>
    </div>
</div>
@endsection
