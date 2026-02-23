<x-app-layout>
    <x-slot name="header">Edit Data Obat</x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form method="POST" action="{{ route('superadmin.medicines.update', $medicine->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-bold text-sm text-gray-700">Nama Obat</label>
                        <input type="text" name="name" value="{{ old('name', $medicine->name) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                            required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block font-bold text-sm text-gray-700">Satuan</label>
                            <select name="unit"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                @foreach (['Tablet', 'Kapsul', 'Sirup/Botol', 'Salep/Tube', 'Pcs'] as $u)
                                    <option value="{{ $u }}" {{ $medicine->unit == $u ? 'selected' : '' }}>
                                        {{ $u }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block font-bold text-sm text-gray-700">Stok</label>
                            <input type="number" name="stock" value="{{ old('stock', $medicine->stock) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                                required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold text-sm text-gray-700">Harga Jual (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $medicine->price) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                            required>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('superadmin.medicines.index') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">Batal</a>
                        <button type="submit"
                            class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 shadow-sm transition font-bold">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
