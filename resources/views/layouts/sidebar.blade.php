<aside class="w-64 bg-white border-r shadow-sm hidden md:flex flex-col h-screen">
    <div class="h-16 flex items-center justify-start px-12 border-b gap-3">
        <img src="{{ asset('images/logo-simedik.png') }}" alt="Logo" class="h-8 w-auto">

        <h1 class="text-2xl font-extrabold text-pink-600 tracking-wider">SIMEDIK</h1>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-4 py-3 text-pink-600 bg-pink-50 rounded-lg font-semibold transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
            Dashboard
        </a>

        @if (auth()->user()->role === 'super_admin')
            <div class="pt-4 pb-1 text-xs font-bold text-gray-400 uppercase">Master Data</div>
            <a href="{{ route('superadmin.users.index') }}"
                class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('superadmin.users.index') ? 'text-pink-600 bg-pink-50 font-bold' : 'text-gray-600 hover:text-pink-600 hover:bg-pink-50' }} rounded-lg transition-all">
                Kelola Pengguna
            </a>
            <a href="{{ route('superadmin.medicines.index') }}"
                class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('superadmin.medicines.*') ? 'text-pink-600 bg-pink-50 font-bold' : 'text-gray-600 hover:text-pink-600' }} rounded-lg transition-all">
                Data Obat
            </a>
        @endif

        @if (auth()->user()->role === 'admin')
            <div class="pt-4 pb-1 text-xs font-bold text-gray-400 uppercase">Pelayanan</div>
            <a href="{{ route('admin.patients.index') }}"
                class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('admin.patients.index') ? 'text-pink-600 bg-pink-50 font-bold' : 'text-gray-600 hover:text-pink-600 hover:bg-pink-50' }} rounded-lg transition-all">
                Pendaftaran Pasien
            </a>
            <a href="{{ route('admin.queues.index') }}"
                class="flex items-center gap-3 px-4 py-2 {{ request()->routeIs('admin.queues.index') ? 'text-pink-600 bg-pink-50 font-bold' : 'text-gray-600 hover:text-pink-600' }} rounded-lg">
                Antrian
            </a>
        @endif

        @if (auth()->user()->role === 'dokter')
            <div class="pt-4 pb-1 text-xs font-bold text-gray-400 uppercase">Medis</div>
            <a href="#"
                class="flex items-center gap-3 px-4 py-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-all">
                Jadwal Periksa
            </a>
            <a href="#"
                class="flex items-center gap-3 px-4 py-2 text-gray-600 hover:text-pink-600 hover:bg-pink-50 rounded-lg transition-all">
                Rekam Medis Pasien
            </a>
        @endif
    </nav>

    <div class="p-4 border-t text-sm text-gray-400 text-center">
        &copy; {{ date('Y') }} SIMEDIK
    </div>
</aside>
