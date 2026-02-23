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
                                <th class="px-6 py-3 border-b">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center gap-1 hover:text-pink-600 transition">
                                        Nama Obat
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </a>
                                </th>
                                <th class="px-6 py-4 font-bold border-b">Satuan</th>
                                <th class="px-6 py-3 border-b text-center">
                                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'stock', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}"
                                        class="flex items-center justify-center gap-1 hover:text-pink-600 transition">
                                        Stok
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                        </svg>
                                    </a>
                                </th>
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
                    <div class="p-4 border-t border-gray-100">
                        @if ($medicines->hasPages())
                            {{ $medicines->links() }}
                        @else
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-500">
                                    Menampilkan <span class="font-bold">{{ $medicines->count() }}</span> data
                                </p>
                                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-gray-50 border border-gray-300 cursor-not-allowed rounded-l-md">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-bold text-pink-600 bg-white border border-gray-300 cursor-default">
                                        1
                                    </span>
                                    <span
                                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-300 bg-gray-50 border border-gray-300 cursor-not-allowed rounded-r-md">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
