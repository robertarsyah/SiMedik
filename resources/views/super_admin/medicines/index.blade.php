<x-app-layout>
    <x-slot name="header">Kelola Data Obat</x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-700">Daftar Stok Obat</h3>
                    <a href="{{ route('superadmin.medicines.create') }}"
                        class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                        + Tambah Obat
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-pink-50 text-pink-700 uppercase text-xs">
                                <th class="px-6 py-4 font-bold border-b">Nama Obat</th>
                                <th class="px-6 py-4 font-bold border-b">Satuan</th>
                                <th class="px-6 py-4 font-bold border-b">Stok</th>
                                <th class="px-6 py-4 font-bold border-b">Harga</th>
                                <th class="px-6 py-4 font-bold border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @forelse($medicines as $m)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $m->name }}</td>
                                    <td class="px-6 py-4">{{ $m->unit }}</td>
                                    <td class="px-6 py-4">
                                        <span class="{{ $m->stock < 10 ? 'text-red-600 font-bold' : '' }}">
                                            {{ $m->stock }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">Rp {{ number_format($m->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center flex justify-center gap-3">
                                        <a href="{{ route('superadmin.medicines.edit', $m->id) }}"
                                            class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('superadmin.medicines.destroy', $m->id) }}"
                                            method="POST" id="delete-form-{{ $m->id }}">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $m->id }})"
                                                class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center italic text-gray-400">Belum ada data
                                        obat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
