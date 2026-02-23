<x-app-layout>
    <x-slot name="header">Edit Pengguna</x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <form method="POST" action="{{ route('superadmin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-bold text-sm text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold text-sm text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold text-sm text-gray-700">Role / Jabatan</label>
                        <select name="role"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin Klinik</option>
                            <option value="dokter" {{ $user->role == 'dokter' ? 'selected' : '' }}>Dokter</option>
                        </select>
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 rounded-md border border-gray-200">
                        <p class="text-xs text-gray-500 mb-4">*Kosongkan password jika tidak ingin menggantinya.</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-sm text-gray-700">Password Baru</label>
                                <input type="password" name="password"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            </div>
                            <div>
                                <label class="block font-bold text-sm text-gray-700">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('superadmin.users.index') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">Batal</a>
                        <button type="submit"
                            class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 shadow-sm transition">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
