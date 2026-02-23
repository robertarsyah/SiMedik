<x-app-layout>
    <x-slot name="header">
        Riwayat Rekam Medis Pasien
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-pink-500">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Rekam Medis</h3>
                    <p class="text-sm text-gray-500">Seluruh riwayat pemeriksaan pasien yang telah selesai.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700 uppercase text-xs">
                                <th class="px-6 py-4 font-bold border-b">Tanggal & Waktu</th>
                                <th class="px-6 py-4 font-bold border-b">Nama Pasien</th>
                                <th class="px-6 py-4 font-bold border-b">Diagnosa</th>
                                <th class="px-6 py-4 font-bold border-b">Tindakan/Saran</th>
                                <th class="px-6 py-4 font-bold border-b text-center">Resep</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($history as $h)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-gray-500 font-mono text-xs">
                                        {{ $h->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800 uppercase">
                                        {{ $h->patient->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-gray-700">{{ $h->diagnosis }}</span>
                                    </td>
                                    <td class="px-6 py-4 italic text-gray-600">
                                        {{ $h->action }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($h->prescriptions && $h->prescriptions->count() > 0)
                                            <span
                                                class="bg-green-100 text-green-700 px-2 py-1 rounded text-[10px] font-bold uppercase">
                                                {{ $h->prescriptions->count() }} Obat
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-[10px] italic">Tanpa Resep</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center text-gray-400 italic bg-gray-50">
                                        Belum ada riwayat rekam medis tersimpan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
