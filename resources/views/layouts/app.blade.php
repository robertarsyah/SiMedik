<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen overflow-hidden">

        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col overflow-y-auto">

            @include('layouts.navigation')

            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Popup Sukses Login
            @if (session('login_success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Masuk!',
                    text: 'Selamat datang kembali di SIMEDIK.',
                    confirmButtonColor: '#db2777',
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            // Popup Sukses Verifikasi Email
            @if (session('verified_success') || request()->query('verified') == 1)
                Swal.fire({
                    icon: 'success',
                    title: 'Verifikasi Berhasil!',
                    text: 'Email Anda telah berhasil diverifikasi. Selamat datang di SIMEDIK!',
                    confirmButtonColor: '#db2777',
                }).then(() => {
                    window.history.replaceState(null, '', window.location.pathname);
                });
            @endif
        });
    </script>

    <script>
        // Popup Sukses dari Controller
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#db2777',
                timer: 2500
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Opps!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#db2777',
            });
        @endif

        // Fungsi Konfirmasi Hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data pengguna akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#db2777',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</body>

</html>
