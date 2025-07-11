<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
   <aside class="w-64 bg-white/60 backdrop-blur-md p-6 h-screen fixed top-0 left-0 flex flex-col justify-between">
    <div>
        <h2 class="text-2xl font-bold text-green-700 mb-6">Bank Sampah</h2>
         <div class="flex flex-col items-center text-center space-y-2">
        <!-- Avatar -->
        <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center text-white text-xl font-bold">
            {{ strtoupper(Auth::user()->name[0]) ?? 'U' }}
        </div>

        <!-- Nama Pengguna -->
        <div>   
            <p class="text-lg font-semibold text-green-800">
                {{ Auth::user()->name ?? 'User' }}
            </p>
        </div>
    </div>

            <nav class="space-y-4">
            <a href="{{ route('dashboard') }}" class="flex items-center text-green-800 hover:font-bold">
                <i class="fas fa-home w-5 mr-2"></i> Home
            </a>
            <a href="{{ route('nasabah.index') }}" class="flex items-center text-green-800 hover:font-bold">
                <i class="fas fa-users w-5 mr-2"></i> Data Nasabah
            </a>
            <a href="{{ route('setoran.index') }}" class="flex items-center text-green-800 hover:font-bold">
                <i class="fas fa-recycle w-5 mr-2"></i> Setoran Sampah
            </a>
            <a href="{{ route('penarikan.index') }}" class="flex items-center text-green-800 hover:font-bold">
                <i class="fas fa-money-bill-wave w-5 mr-2"></i> Penarikan Uang
            </a>
            <a href="{{ route('laporan.index') }}" class="flex items-center text-green-800 hover:font-bold">
                <i class="fas fa-file-invoice-dollar w-5 mr-2"></i> Laporan Keuangan
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center text-red-500 hover:font-bold">
                    <i class="fas fa-sign-out-alt w-5 mr-2"></i> Keluar
                </button>
            </form>
        </nav>

    </div>
</aside>

</nav>
