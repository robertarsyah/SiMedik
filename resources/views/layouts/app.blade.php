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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
</body>

</html>
