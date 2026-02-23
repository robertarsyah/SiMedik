<x-app-layout>
    <x-slot name="header">
        Pendaftaran Pasien
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-pink-500">

                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Data Pasien Terdaftar</h3>
                        <p class="text-sm text-gray-500">Kelola informasi identitas pasien SIMEDIK.</p>
                    </div>
                    <a href="{{ route('admin.patients.create') }}"
                        class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-sm text-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Tambah Pasien Baru
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-pink-50 text-pink-700 uppercase text-xs">
                                <th class="px-6 py-4 font-bold border-b">NIK</th>
                                <th class="px-6 py-4 font-bold border-b">Nama Lengkap</th>
                                <th class="px-6 py-4 font-bold border-b text-center">L/P</th>
                                <th class="px-6 py-4 font-bold border-b text-center">No. HP</th>
                                <th class="px-6 py-4 font-bold border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @forelse($patients as $patient)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-mono text-pink-600">{{ $patient->nik }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $patient->name }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="px-2 py-1 rounded text-[10px] font-bold {{ $patient->gender == 'L' ? 'bg-blue-100 text-blue-600' : 'bg-pink-100 text-pink-600' }}">
                                            {{ $patient->gender }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">{{ $patient->phone }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.patients.edit', $patient->id) }}"
                                                class="p-1 text-blue-500 hover:bg-blue-50 rounded" title="Edit Data">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.patients.destroy', $patient->id) }}"
                                                method="POST" id="delete-form-{{ $patient->id }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $patient->id }})"
                                                    class="p-1 text-red-500 hover:bg-red-50 rounded"
                                                    title="Hapus Pasien">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic bg-gray-50">
                                        Belum ada data pasien. Klik "Tambah Pasien Baru" untuk memulai.
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
