<x-guest-layout>
    {{-- Tab Masuk / Daftar --}}
    <div class="flex justify-between mb-6 bg-gray-100 rounded-lg p-1">
        <a href="{{ route('register') }}" class="w-1/2 text-center py-2 font-bold bg-teal-700 text-white rounded-md">DAFTAR</a>
        <a href="{{ route('login') }}" class="w-1/2 text-center py-2 text-gray-500">MASUK</a>
    </div>

    {{-- Form Register --}}
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Username (name field) --}}
        <div>
            <input id="name" name="name" type="text" placeholder="Masukkan username" value="{{ old('name') }}" required
                class="w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 shadow-sm" />
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <input id="email" name="email" type="email" placeholder="Masukkan email" value="{{ old('email') }}" required
                class="w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 shadow-sm" />
            @error('email')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <input id="password" name="password" type="password" placeholder="Buat kata sandi" required
                class="w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 shadow-sm" />
            @error('password')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
            <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Konfirmasi kata sandi" required
                class="w-full rounded-md border-gray-300 focus:border-teal-500 focus:ring focus:ring-teal-200 shadow-sm" />
            @error('password_confirmation')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit"
                class="w-full bg-teal-700 text-white py-2 rounded-md font-semibold hover:bg-teal-800">
                DAFTAR
            </button>
        </div>
    </form>
</x-guest-layout>
