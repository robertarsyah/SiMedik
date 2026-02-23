<x-app-layout>
    <x-slot name="header">
        Dashboard Admin (Resepsionis)
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-pink-500">
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-black text-gray-800">Halo, {{ auth()->user()->name }}! 👩‍💻</h3>
                        <p class="text-sm text-gray-500 mt-1">Pantau terus pergerakan antrian pasien hari ini
                            ({{ date('d M Y') }}).</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">

                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Total Antrian Hari Ini
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="p-4 bg-gray-50 rounded-full text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-4xl font-black text-gray-800">{{ $stats['total_antrian'] }}</h4>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-yellow-100">
                    <p class="text-[11px] font-bold text-yellow-600 uppercase tracking-wider mb-2">Sedang Menunggu</p>
                    <div class="flex items-center gap-4">
                        <div class="p-4 bg-yellow-50 rounded-full text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-4xl font-black text-gray-800">{{ $stats['menunggu'] }}</h4>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-blue-100">
                    <p class="text-[11px] font-bold text-blue-600 uppercase tracking-wider mb-2">Diperiksa Dokter</p>
                    <div class="flex items-center gap-4">
                        <div class="p-4 bg-blue-50 rounded-full text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M130 10V21M130 10C130 4.47715 125.523 0 120 0H10C4.47715 0 0 4.47715 0 10V21M130 10C130 15.5228 125.523 20 120 20H10C4.47715 20 0 15.5228 0 10M130 10V21M130 21C130 26.5228 125.523 31 120 31H10C4.47715 31 0 26.5228 0 21M0 10V21">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-4xl font-black text-gray-800">{{ $stats['diperiksa'] }}</h4>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-green-100">
                    <p class="text-[11px] font-bold text-green-600 uppercase tracking-wider mb-2">Selesai / Ke Kasir</p>
                    <div class="flex items-center gap-4">
                        <div class="p-4 bg-green-50 rounded-full text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-4xl font-black text-gray-800">{{ $stats['selesai'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
