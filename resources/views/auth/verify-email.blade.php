<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda. Jika tidak menerima email, klik tombol di bawah untuk mengirim ulang.') }}
    </div>

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-primary-button>
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="underline text-sm text-gray-600 hover:text-pink-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('registered_success'))
            Swal.fire({
                icon: 'info',
                title: 'Pendaftaran Berhasil!',
                text: 'Silakan periksa kotak masuk email Anda untuk melakukan verifikasi.',
                confirmButtonColor: '#db2777',
            });
            {{ session()->forget('registered_success') }}
        @endif
    });
</script>
