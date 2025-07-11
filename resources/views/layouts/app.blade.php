<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'Bank Sampah Desa Kalongan')</title>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
     <body class="font-sans antialiased bg-gradient-to-r from-green-100 to-blue-100">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            @include('layouts.navigation')

            <!-- Main Content -->
            <div class="flex-1 ml-64 p-8 relative overflow-hidden">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
