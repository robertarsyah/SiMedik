<x-app-layout>
    <x-slot name="header">
        Daftar Antrian Hari Ini
    </x-slot>

    <div x-data="{ openModal: false }" class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-pink-500">

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Antrian Tanggal: {{ date('d M Y') }}</h3>
                        <p class="text-sm text-gray-500">Kelola urutan pemeriksaan pasien secara real-time.</p>
                    </div>
                    <button @click="openModal = true"
                        class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg text-sm flex items-center gap-2 shadow-sm transition-all active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Ambil Antrian
                    </button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm text-center md:text-left">
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Total Antrian</p>
                        <p class="text-2xl font-black text-gray-800">{{ $queues->count() }}</p>
                    </div>
                    <div
                        class="p-4 bg-yellow-50 border border-yellow-100 rounded-lg shadow-sm text-center md:text-left">
                        <p class="text-[10px] text-yellow-600 font-bold uppercase tracking-wider">Menunggu</p>
                        <p class="text-2xl font-black text-yellow-800">
                            {{ $queues->where('status', 'menunggu')->count() }}</p>
                    </div>
                    <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg shadow-sm text-center md:text-left">
                        <p class="text-[10px] text-blue-600 font-bold uppercase tracking-wider">Diperiksa</p>
                        <p class="text-2xl font-black text-blue-800">
                            {{ $queues->where('status', 'diperiksa')->count() }}</p>
                    </div>
                    <div class="p-4 bg-green-50 border border-green-100 rounded-lg shadow-sm text-center md:text-left">
                        <p class="text-[10px] text-green-600 font-bold uppercase tracking-wider">Selesai</p>
                        <p class="text-2xl font-black text-green-800">{{ $queues->where('status', 'selesai')->count() }}
                        </p>
                    </div>
                    <div class="p-4 bg-red-50 border border-red-100 rounded-lg shadow-sm text-center md:text-left">
                        <p class="text-[10px] text-red-600 font-bold uppercase tracking-wider">Lewat</p>
                        <p class="text-2xl font-black text-red-800">{{ $queues->where('status', 'lewat')->count() }}</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700 uppercase text-xs">
                                <th class="px-6 py-4 font-bold border-b text-center w-20">No</th>
                                <th class="px-6 py-4 font-bold border-b">Nama Pasien / NIK</th>
                                <th class="px-6 py-4 font-bold border-b text-center">Status</th>
                                <th class="px-6 py-4 font-bold border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($queues as $q)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-2xl font-black text-pink-600">{{ $q->queue_number }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800 text-base uppercase">{{ $q->patient->name }}
                                        </div>
                                        <div class="text-xs text-gray-500 font-mono">{{ $q->patient->nik }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $statusClasses = [
                                                'menunggu' => 'bg-yellow-100 text-yellow-700',
                                                'diperiksa' => 'bg-blue-100 text-blue-700',
                                                'selesai' => 'bg-green-100 text-green-700',
                                                'lewat' => 'bg-red-100 text-red-700',
                                            ];
                                        @endphp
                                        <span
                                            class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusClasses[$q->status] ?? 'bg-gray-100' }}">
                                            {{ $q->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($q->status == 'menunggu')
                                            <form action="{{ route('admin.queues.call', $q->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-pink-50 text-pink-600 px-4 py-1 rounded-full border border-pink-200 font-bold hover:bg-pink-600 hover:text-white transition-all text-xs">
                                                    Panggil Pasien
                                                </button>
                                            </form>
                                        @elseif($q->status == 'diperiksa')
                                            <span
                                                class="text-blue-600 italic font-medium flex items-center justify-center gap-1">
                                                <span class="relative flex h-2 w-2">
                                                    <span
                                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                                    <span
                                                        class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                                </span>
                                                Sedang Diperiksa
                                            </span>
                                        @else
                                            <span class="text-gray-400 italic">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center text-gray-400 italic bg-gray-50">
                                        Belum ada antrian untuk hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>

            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="openModal = false">
                    <div class="fixed inset-0 bg-gray-900 opacity-75"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-6 py-6">
                        <div class="flex justify-between items-center mb-6 border-b pb-3">
                            <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight">Ambil Nomor Antrian
                            </h3>
                            <button @click="openModal = false" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('admin.queues.store') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Cari & Pilih Pasien</label>
                                <select name="patient_id"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-pink-500 focus:ring-pink-500 py-3"
                                    required>
                                    <option value="">-- Nama atau NIK Pasien --</option>
                                    @foreach ($patients as $p)
                                        <option value="{{ $p->id }}">{{ $p->nik }} - {{ $p->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="mt-2 text-[11px] text-gray-400 italic font-medium">
                                    *Pastikan pasien sudah terdaftar di SIMEDIK sebelumnya.
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row-reverse gap-3 mt-8">
                                <button type="submit"
                                    class="w-full bg-pink-600 text-white font-black py-3 rounded-lg shadow-lg hover:bg-pink-700 transition-all active:scale-95">
                                    KONFIRMASI & AMBIL NOMOR
                                </button>
                                <button type="button" @click="openModal = false"
                                    class="w-full bg-gray-100 text-gray-600 font-bold py-3 rounded-lg hover:bg-gray-200 transition-all">
                                    BATAL
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
