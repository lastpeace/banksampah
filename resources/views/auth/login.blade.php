<x-guest-layout>
    <div class="flex justify-between mb-6 bg-gray-100 rounded-lg p-1">
        <a href="{{ route('register') }}" class="w-1/2 text-center py-2 text-gray-500">DAFTAR</a>
        <a href="{{ route('login') }}" class="w-1/2 text-center py-2 font-bold bg-teal-700 text-white rounded-md">MASUK</a>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <input id="email" name="email" type="email" placeholder="Masukkan email" required autofocus
            class="w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 shadow-sm" />

        <!-- Password -->
        <input id="password" name="password" type="password" placeholder="Masukkan kata sandi" required
            class="w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 shadow-sm" />

        <!-- Remember Me (optional) -->
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-teal-600 shadow-sm focus:ring-teal-500">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-sm text-teal-600 hover:underline">Lupa sandi?</a>
        </div>

        <button type="submit"
            class="w-full bg-teal-700 text-white py-2 rounded-md font-semibold hover:bg-teal-800">
            MASUK
        </button>
    </form>
</x-guest-layout>
