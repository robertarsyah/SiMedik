<x-app-layout>
    <x-slot name="header">Daftar Pasien Menunggu Pemeriksaan</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-50 text-blue-700 uppercase text-xs">
                            <th class="px-6 py-4 font-bold border-b text-center">No Antrian</th>
                            <th class="px-6 py-4 font-bold border-b">Nama Pasien</th>
                            <th class="px-6 py-4 font-bold border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($queues as $q)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-center font-black text-2xl text-blue-600">
                                    {{ $q->queue_number }}</td>
                                <td class="px-6 py-4 font-bold">{{ $q->patient->name }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('doctor.examine', $q->id) }}"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700">
                                        Mulai Periksa
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-400">Belum ada pasien yang
                                    dipanggil.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
