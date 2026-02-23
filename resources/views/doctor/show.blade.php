<x-app-layout>
    <x-slot name="header">Detail Rekam Medis: {{ $queue->patient->name }}</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 border border-gray-100">

                <div class="flex justify-between items-start border-b pb-6 mb-6">
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 uppercase">{{ $queue->patient->name }}</h2>
                        <p class="text-xs text-gray-400 mt-2 italic">
                            {{ $queue->medicalRecord?->created_at->format('H:i') ?? '--:--' }} WIB
                        </p>
                    </div>
                    <div class="text-right">
                        <span
                            class="px-4 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-bold uppercase shadow-sm">
                            Selesai Diperiksa
                        </span>
                        <p class="text-xs text-gray-400 mt-2 italic">
                            {{ $queue->medicalRecord?->created_at->format('d F Y') ?? '--' }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 mb-8">
                    <div>
                        <h4 class="text-xs font-black text-pink-600 uppercase tracking-widest mb-2">Keluhan</h4>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-100">
                            {{ $queue->medicalRecord->complaint ?? 'Data keluhan tidak ditemukan' }}
                        </p>
                    </div>
                    <div>
                        <h4 class="text-xs font-black text-pink-600 uppercase tracking-widest mb-2">Diagnosa Dokter</h4>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-100">
                            {{ $queue->medicalRecord->diagnosis ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <h4 class="text-xs font-black text-pink-600 uppercase tracking-widest mb-2">Tindakan / Saran
                        </h4>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-100">
                            {{ $queue->medicalRecord->action ?? '-' }}
                        </p>
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h4 class="text-xs font-black text-gray-800 uppercase tracking-widest mb-4">Resep Obat</h4>
                    <div class="space-y-3">
                        @if ($queue->medicalRecord && $queue->medicalRecord->prescriptions->count() > 0)
                            @foreach ($queue->medicalRecord->prescriptions as $p)
                                <div
                                    class="flex justify-between items-center p-4 bg-pink-50/50 rounded-xl border border-pink-100">
                                    <div>
                                        <p class="font-bold text-gray-800 uppercase text-sm">{{ $p->medicine->name }}
                                        </p>
                                        <p class="text-xs text-pink-600 font-medium italic">{{ $p->instruction }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-gray-400 uppercase font-bold">Jumlah</p>
                                        <p class="font-black text-gray-800">{{ $p->quantity }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-4 bg-gray-50 rounded-lg border border-dashed border-gray-200 text-center">
                                <p class="text-sm text-gray-400 italic">Tidak ada resep obat untuk pasien ini.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-10 border-t pt-6 flex justify-between items-center">
                    <a href="{{ route('doctor.history') }}"
                        class="text-sm font-bold text-gray-500 hover:text-gray-800 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Riwayat
                    </a>
                    <button onclick="window.print()"
                        class="bg-gray-100 text-gray-600 px-6 py-2 rounded-lg font-bold hover:bg-gray-200 text-xs transition">
                        CETAK REKAM MEDIS
                    </button>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
