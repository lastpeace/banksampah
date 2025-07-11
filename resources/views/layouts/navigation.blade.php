<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
   <div class="w-64 min-h-screen bg-gradient-to-b from-green-600 via-green-500 to-green-700 text-white flex flex-col items-center py-8 shadow-lg">

    <!-- Logo atau Nama -->
    <h1 class="text-2xl font-extrabold mb-6 tracking-wide drop-shadow">Bank Sampah</h1>

    <!-- Avatar & Nama User -->
    <div class="w-20 h-20 rounded-full bg-white text-green-700 flex items-center justify-center text-3xl font-bold shadow-md mb-2">
        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
    </div>
    <p class="text-sm italic text-white drop-shadow mb-6">{{ Auth::user()->name ?? 'User' }}</p>

    <!-- Menu Navigasi -->
    <nav class="w-full px-6 space-y-3">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 px-4 py-2 rounded-md hover:bg-white/20 transition">
            <i class="fas fa-home"></i><span>Home</span>
        </a>
        <a href="{{ route('nasabah.index') }}" class="flex items-center space-x-2 px-4 py-2 rounded-md hover:bg-white/20 transition">
            <i class="fas fa-users"></i><span>Data Nasabah</span>
        </a>
        <a href="{{ route('setoran.index') }}" class="flex items-center space-x-2 px-4 py-2 rounded-md hover:bg-white/20 transition">
            <i class="fas fa-recycle"></i><span>Setoran Sampah</span>
        </a>
        <a href="{{ route('penarikan.index') }}" class="flex items-center space-x-2 px-4 py-2 rounded-md hover:bg-white/20 transition">
            <i class="fas fa-money-bill-wave"></i><span>Penarikan Uang</span>
        </a>
        <a href="{{ route('laporan.index') }}" class="flex items-center space-x-2 px-4 py-2 rounded-md hover:bg-white/20 transition">
            <i class="fas fa-file-invoice-dollar"></i><span>Laporan Keuangan</span>
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="flex items-center space-x-2 text-red-300 hover:text-white px-4 py-2 rounded-md hover:bg-red-600 w-full transition">
                <i class="fas fa-sign-out-alt"></i><span>Keluar</span>
            </button>
        </form>
    </nav>
</div>


</nav>
