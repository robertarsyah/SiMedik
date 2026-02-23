<x-app-layout>
    <x-slot name="header">Riwayat Rekam Medis Pasien</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-pink-50 text-pink-700 uppercase text-xs">
                            <th class="px-6 py-4 font-bold border-b text-center w-32">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'queue_number', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}"
                                    class="flex items-center justify-center gap-1 hover:text-pink-600 transition">
                                    No Antrian
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                    </svg>
                                </a>
                            </th>
                            <th class="px-28 py-4 font-bold border-b text-center">Nama Pasien</th>
                            <th class="px-6 py-4 font-bold border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($records as $r)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-center font-black text-2xl text-pink-600">
                                    {{ $r->queue_number }}
                                </td>
                                <td class="px-6 py-4 text-center font-bold text-gray-800 uppercase">
                                    {{ $r->patient->name }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('doctor.show', $r->id) }}"
                                        class="bg-pink-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-pink-700 transition shadow-sm text-xs uppercase">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">Belum ada riwayat
                                    pemeriksaan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-6">
                    @if ($records->hasPages())
                        {{ $records->links() }}
                    @else
                        <div class="flex items-center justify-between border-t border-gray-100 pt-6">
                            <p class="text-sm text-gray-600">
                                Menampilkan <span class="font-bold text-pink-600">{{ $records->total() }}</span> data
                            </p>

                            <nav role="navigation" class="flex items-center justify-between">
                                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-l-md">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-bold text-pink-600 bg-pink-50 border border-pink-300">1</span>
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-300 bg-white border border-gray-300 rounded-r-md">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
