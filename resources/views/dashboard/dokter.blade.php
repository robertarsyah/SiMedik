<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Dokter') }}
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-blue-500">
                <div class="p-6">
                    <h3 class="text-xl font-black text-gray-800">Selamat bertugas, Dr {{ auth()->user()->name }}! 🩺
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Berikut adalah ringkasan dan daftar pasien yang menunggu
                        pemeriksaan Anda hari ini.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div
                    class="bg-white rounded-lg shadow-sm p-6 border border-yellow-100 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-[11px] font-bold text-yellow-600 uppercase tracking-wider mb-1">Antrian Saat Ini
                        </p>
                        <h4 class="text-3xl font-black text-gray-800">{{ $stats['menunggu'] }} <span
                                class="text-sm text-gray-400 font-normal">pasien</span></h4>
                    </div>
                    <div class="p-4 bg-yellow-50 rounded-full text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-white rounded-lg shadow-sm p-6 border border-green-100 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-[11px] font-bold text-green-600 uppercase tracking-wider mb-1">Selesai Hari Ini
                        </p>
                        <h4 class="text-3xl font-black text-gray-800">{{ $stats['selesai_hari_ini'] }} <span
                                class="text-sm text-gray-400 font-normal">pasien</span></h4>
                    </div>
                    <div class="p-4 bg-green-50 rounded-full text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-white rounded-lg shadow-sm p-6 border border-blue-100 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-[11px] font-bold text-blue-600 uppercase tracking-wider mb-1">Total Rekam Medis
                        </p>
                        <h4 class="text-3xl font-black text-gray-800">{{ $stats['total_pasien'] }} <span
                                class="text-sm text-gray-400 font-normal">data</span></h4>
                    </div>
                    <div class="p-4 bg-blue-50 rounded-full text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
