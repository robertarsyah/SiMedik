<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 | Akses Ditolak</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
    </style>
</head>

<body
    class="antialiased bg-pink-50 text-gray-900 flex items-center justify-center min-h-screen relative selection:bg-pink-500 selection:text-white">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-center sm:text-left">

        <div class="flex items-center justify-center sm:justify-center ">
            <div class="px-4 text-2xl text-gray-500 border-r border-gray-400 tracking-wider">
                403
            </div>
            <div class="ml-4 text-xl text-gray-500 uppercase tracking-wider">
                Akses Ditolak
            </div>
        </div>

        <p class="mt-6 mb-6 text-gray-600 sm:ml-4">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk melihat halaman ini.' }}
        </p>

        <div class="mt-6 flex justify-center sm:justify-center sm:ml-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="inline-block bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded-md transition duration-300">
                    Keluar & Kembali ke Awal
                </button>
            </form>
        </div>

    </div>
</body>

</html>
