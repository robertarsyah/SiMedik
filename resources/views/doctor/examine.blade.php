<x-app-layout>
    <x-slot name="header">Pemeriksaan Pasien: {{ $queue->patient->name }}</x-slot>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="py-6" x-data="{ medicines: [{ id: '', qty: 1, note: '' }] }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border-l-4 border-red-500">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('doctor.store', $queue->id) }}" method="POST" id="formPemeriksaan">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div class="md:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
                            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2 text-lg">Hasil Pemeriksaan</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Keluhan</label>
                                    <textarea name="complaint" rows="3"
                                        class="w-full border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>{{ old('complaint') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Diagnosa</label>
                                    <textarea name="diagnosis" rows="3"
                                        class="w-full border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>{{ old('diagnosis') }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Tindakan/Saran</label>
                                    <textarea name="action" rows="2"
                                        class="w-full border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>{{ old('action') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg border border-gray-100 shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-4 border-b pb-2 text-lg">Resep Obat</h3>
                        <template x-for="(item, index) in medicines" :key="index">
                            <div class="p-3 bg-gray-50 rounded-lg mb-3 border border-gray-100">
                                <div class="mb-2">
                                    <select :name="`medicines[${index}][id]`"
                                        class="w-full text-xs border-gray-300 rounded-md">
                                        <option value="">-- Pilih Obat --</option>
                                        @foreach (\App\Models\Medicine::where('stock', '>', 0)->get() as $m)
                                            <option value="{{ $m->id }}">{{ $m->name }} (Stok:
                                                {{ $m->stock }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="number" :name="`medicines[${index}][qty]`" placeholder="Qty"
                                        class="text-xs border-gray-300 rounded-md">
                                    <input type="text" :name="`medicines[${index}][note]`" placeholder="Aturan pakai"
                                        class="text-xs border-gray-300 rounded-md">
                                </div>
                                <button type="button" @click="medicines.splice(index, 1)"
                                    class="text-[10px] text-red-500 mt-2 hover:underline">Hapus</button>
                            </div>
                        </template>

                        <button type="button" @click="medicines.push({ id: '', qty: 1, note: '' })"
                            class="w-full py-2 border-2 border-dashed border-gray-200 text-gray-600 rounded-lg text-xs font-bold hover:bg-pink-50 hover:text-pink-600 transition">
                            + Tambah Obat
                        </button>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('doctor.index') }}"
                        class="px-6 py-2 bg-gray-100 text-gray-700 hover:bg-gray-200 rounded-lg font-bold">Batal</a>
                    <button type="submit"
                        class="px-6 py-2 bg-pink-600 text-white rounded-lg font-bold hover:bg-pink-700 shadow-lg shadow-pink-200 transition active:scale-95">
                        Simpan & Selesai
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#db2777', // Warna Pink
            });
        </script>
    @endif
</x-app-layout>
