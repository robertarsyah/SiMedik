<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMEDIK</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-pink-50 font-sans text-gray-900">
    <div class="min-h-screen flex flex-col">

        <nav class="bg-white shadow-sm py-4 px-6 md:px-12 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-simedik.png') }}" alt="Logo SIMEDIK" class="h-10 w-10">
                <span class="text-2xl font-bold text-pink-600 tracking-tight">SIMEDIK</span>
            </div>

            <div>
                @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="font-semibold text-white bg-pink-500 hover:bg-pink-600 px-4 py-2 rounded-md transition shadow-sm">Ke
                                Dashboard</a>
                        @else
                            <div class="flex items-center gap-4">
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-gray-600 hover:text-pink-600 transition">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="font-semibold text-white bg-pink-500 hover:bg-pink-600 px-4 py-2 rounded-md transition shadow-sm">Register</a>
                                @endif
                            </div>
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <main class="flex-1 flex flex-col justify-center items-center text-center px-6 md:px-12">
            <img src="{{ asset('images/logo-simedik.png') }}" alt="Logo SIMEDIK Besar"
                class="h-40 w-40 mb-6 drop-shadow-xl">

            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
                Sistem Manajemen Digital <span class="text-pink-600">Klinik</span>
            </h1>

            <p class="text-lg text-gray-600 mb-8 max-w-2xl leading-relaxed">
                Kelola data pasien, jadwal dokter, dan rekam medis dengan lebih mudah, cepat, dan terintegrasi dalam
                satu platform internal klinik.
            </p>

            <div class="flex gap-4">
                <a href="{{ route('login') }}"
                    class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-8 rounded-full shadow-lg shadow-pink-500/30 transition duration-300 transform hover:-translate-y-1">
                    Masuk ke Sistem
                </a>
            </div>
        </main>

        <footer class="bg-white text-center py-5 text-sm text-gray-500 border-t border-gray-200">
            &copy; {{ date('Y') }} SIMEDIK. All rights reserved.
        </footer>

    </div>
</body>

</html>
