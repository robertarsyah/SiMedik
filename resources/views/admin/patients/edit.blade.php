<x-app-layout>
    <x-slot name="header">Edit Data Pasien</x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form method="POST" action="{{ route('admin.patients.update', $patient->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-bold text-sm text-gray-700">NIK</label>
                            <input type="text" name="nik" value="{{ old('nik', $patient->nik) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                                required>
                        </div>
                        <div>
                            <label class="block font-bold text-sm text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $patient->name) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                                required>
                        </div>
                        <div>
                            <label class="block font-bold text-sm text-gray-700">Jenis Kelamin</label>
                            <select name="gender"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                <option value="L" {{ $patient->gender == 'L' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="P" {{ $patient->gender == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-sm text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="birth_date"
                                value="{{ old('birth_date', $patient->birth_date) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                                required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-bold text-sm text-gray-700">Nomor HP</label>
                            <input type="text" name="phone" value="{{ old('phone', $patient->phone) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                                required>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-bold text-sm text-gray-700">Alamat Lengkap</label>
                            <textarea name="address" rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500" required>{{ old('address', $patient->address) }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-8">
                        <a href="{{ route('admin.patients.index') }}"
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
