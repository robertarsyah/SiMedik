<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard Dokter') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                <div class="p-6 font-bold text-green-600">
                    Selamat datang, Dokter! Cek jadwal dan kelola rekam medis pasien di sini.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
