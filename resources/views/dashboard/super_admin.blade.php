<x-app-layout>
    <x-slot name="header">
        Dashboard Super Admin
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-pink-600">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-black text-gray-800">Selamat datang kembali, {{ auth()->user()->name }}! 👋
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Ini adalah ringkasan sistem klinik/rumah sakit kita hari ini.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pegawai</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-1">{{ $stats['users'] }}</h4>
                        </div>
                        <div class="p-3 bg-pink-50 rounded-lg text-pink-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Master Obat</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-1">{{ $stats['medicines'] }}</h4>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pasien</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-1">{{ $stats['patients'] }}</h4>
                        </div>
                        <div class="p-3 bg-green-50 rounded-lg text-green-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Antrian Hari Ini</p>
                            <h4 class="text-3xl font-black text-gray-800 mt-1">{{ $stats['queues_today'] }}</h4>
                        </div>
                        <div class="p-3 bg-yellow-50 rounded-lg text-yellow-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if ($stats['medicines'] == 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-dashed border-gray-300">
                    <div class="p-8 text-center">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-600 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Data Obat Masih Kosong</h3>
                        <p class="text-sm text-gray-500 mb-5">Sistem belum memiliki data master obat. Silakan input obat
                            terlebih dahulu agar dokter bisa meresepkan obat ke pasien.</p>
                        <a href="{{ route('superadmin.medicines.index') }}"
                            class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-bold shadow-md hover:bg-blue-700 transition">
                            + Input Data Obat
                        </a>
                    </div>
                </div>
            @elseif($lowStockMedicines->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-red-100">
                    <div class="px-6 py-4 border-b border-gray-100 bg-red-50 flex justify-between items-center">
                        <h3 class="font-bold text-red-700 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            Peringatan Stok Obat Menipis (< 10) </h3>
                                <a href="{{ route('superadmin.medicines.index') }}"
                                    class="text-xs font-bold text-red-600 hover:underline">Kelola Obat &rarr;</a>
                    </div>
                    <div class="p-0">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 uppercase text-[10px] tracking-wider">
                                    <th class="px-6 py-3 font-bold border-b">Nama Obat</th>
                                    <th class="px-6 py-3 font-bold border-b text-center">Sisa Stok</th>
                                    <th class="px-6 py-3 font-bold border-b">Satuan</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach ($lowStockMedicines as $medicine)
                                    <tr class="border-b hover:bg-red-50 transition">
                                        <td class="px-6 py-3 font-bold text-gray-800">{{ $medicine->name }}</td>
                                        <td class="px-6 py-3 text-center">
                                            <span
                                                class="bg-red-100 text-red-700 font-bold px-2 py-1 rounded-full text-xs">
                                                {{ $medicine->stock }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3 text-gray-600">{{ $medicine->unit }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
