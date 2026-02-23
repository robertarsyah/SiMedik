<x-guest-layout>
    <div class="text-center p-6">
        <h2 class="text-2xl font-black text-pink-600 uppercase">Email Terverifikasi!</h2>
        <p class="mt-4 text-gray-600">Halo {{ auth()->user()->name }}, akun kamu sudah aktif.</p>
        <p class="text-gray-500 italic">Harap tunggu atau hubungi <span class="font-bold">Super Admin</span> untuk pemberian akses (Role).</p>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="text-pink-600 font-bold hover:underline">Keluar</button>
        </form>
    </div>
</x-guest-layout>
