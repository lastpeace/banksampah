<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body class="bg-gradient-to-r from-green-100 to-blue-100 font-sans antialiased">
        <div class="min-h-screen flex items-center justify-center bg-cover bg-center relative" style="background-image: url('{{ asset('images/background-auth.png') }}')">
            <div class="bg-white/80 rounded-lg shadow-md w-full max-w-md p-6 backdrop-blur-md z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
