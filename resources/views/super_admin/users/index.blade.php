<x-app-layout>
    <x-slot name="header">
        Kelola Pengguna
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-700">Daftar Pengguna Sistem</h3>
                    <a href="{{ route('superadmin.users.create') }}"
                        class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-sm text-sm">
                        + Tambah Pengguna
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-pink-50 text-pink-700 uppercase text-xs">
                                <th class="px-6 py-4 font-bold border-b">Nama</th>
                                <th class="px-6 py-4 font-bold border-b">Email</th>
                                <th class="px-6 py-4 font-bold border-b">Role</th>
                                <th class="px-6 py-4 font-bold border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm">
                            @forelse($users as $user)
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 rounded-full text-[10px] font-bold uppercase {{ $user->role == 'admin' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-3">
                                            <a href="{{ route('superadmin.users.edit', $user->id) }}"
                                                class="text-blue-500 hover:text-blue-700 font-bold">Edit</a>

                                            <form action="{{ route('superadmin.users.destroy', $user->id) }}"
                                                method="POST" id="delete-form-{{ $user->id }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete({{ $user->id }})"
                                                    class="text-red-500 hover:text-red-700 font-bold">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                                        Belum ada data pengguna.
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
