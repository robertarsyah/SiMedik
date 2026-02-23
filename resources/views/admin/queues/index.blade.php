<x-app-layout>
    <x-slot name="header">Daftar Antrian Hari Ini</x-slot>

    <div x-data="{ openModal: false }" class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">

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

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm text-center md:text-left">
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Total Antrian</p>
                        <p class="text-2xl font-black text-gray-800">{{ $allQueues->count() }}</p>
                    </div>

                    <div
                        class="p-4 bg-yellow-50 border border-yellow-100 rounded-lg shadow-sm text-center md:text-left">
                        <p class="text-[10px] text-yellow-600 font-bold uppercase tracking-wider">Menunggu</p>
                        <p class="text-2xl font-black text-yellow-800">
                            {{ $allQueues->where('status', 'menunggu')->count() }}
                        </p>
                    </div>

                    <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg shadow-sm text-center md:text-left">
                        <p class="text-[10px] text-blue-600 font-bold uppercase tracking-wider">Diperiksa</p>
                        <p class="text-2xl font-black text-blue-800">
                            {{ $allQueues->where('status', 'diperiksa')->count() }}
                        </p>
                    </div>

                    <div class="p-4 bg-green-50 border border-green-100 rounded-lg shadow-sm text-center md:text-left">
                        <p class="text-[10px] text-green-600 font-bold uppercase tracking-wider">Selesai</p>
                        <p class="text-2xl font-black text-green-800">
                            {{ $allQueues->where('status', 'selesai')->count() }}
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-pink-50 text-pink-700 uppercase text-xs">
                                <th class="px-6 py-4 font-bold border-b text-center w-20">No</th>
                                <th class="px-6 py-4 font-bold border-b">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center gap-1 hover:text-pink-600 transition">
                                        Nama Pasien / NIK
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </a>
                                </th>
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
                                        <div class="font-bold text-gray-800 uppercase">{{ $q->patient->name }}</div>
                                        <div class="text-xs text-gray-500 font-mono">{{ $q->patient->nik }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-pink-100 text-pink-700">
                                            {{ $q->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($q->status == 'menunggu')
                                            <form action="{{ route('admin.queues.call', $q->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit"
                                                    class="bg-pink-50 text-pink-600 px-4 py-1 rounded-full border border-pink-200 font-bold hover:bg-pink-600 hover:text-white transition-all text-xs">
                                                    Panggil Pasien
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-10 text-center text-gray-400 bg-gray-50 italic uppercase font-bold tracking-widest">
                                        Belum ada antrian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    @if ($queues->hasPages())
                        {{ $queues->links() }}
                    @else
                        <div class="flex items-center justify-between border-t border-gray-100 pt-6">
                            <p class="text-sm text-gray-600">
                                Menampilkan <span class="font-bold text-pink-600">{{ $queues->total() }}</span> data
                            </p>

                            <nav role="navigation" class="flex items-center justify-between">
                                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                    <span aria-disabled="true">
                                        <span
                                            class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-l-md cursor-default">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>

                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-bold text-pink-600 bg-pink-50 border border-pink-300 italic">1</span>
                                    </span>

                                    <span aria-disabled="true">
                                        <span
                                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-r-md cursor-default">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </span>
                                </span>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 text-center">
                <div class="fixed inset-0 bg-gray-900 opacity-75" @click="openModal = false"></div>
                <div
                    class="inline-block bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full z-50">
                    <div class="bg-white px-6 py-6">
                        <div class="flex justify-between items-center mb-6 border-b pb-3">
                            <h3 class="text-xl font-black text-gray-800 uppercase">Ambil Nomor Antrian</h3>
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
                                        <option value="{{ $p->id }}">{{ $p->nik }} -
                                            {{ $p->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex gap-3">
                                <button type="submit"
                                    class="w-full bg-pink-600 text-white font-black py-3 rounded-lg hover:bg-pink-700 transition-all">KONFIRMASI</button>
                                <button type="button" @click="openModal = false"
                                    class="w-full bg-gray-100 text-gray-600 font-bold py-3 rounded-lg">BATAL</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
