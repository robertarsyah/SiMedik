<nav x-data="{ open: false }"
    class="bg-white border-b border-gray-100 h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8">

    <div class="flex items-center ml-2"> @isset($header)
            <div class="font-bold text-xl text-gray-800 leading-tight">
                {{ $header }}
            </div>
        @endisset
    </div>

    <div class="flex items-center">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="flex items-center gap-3 text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <div class="text-right hidden sm:block">
                        <div class="text-gray-800 font-bold">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-pink-600 uppercase tracking-widest">
                            {{ str_replace('_', ' ', Auth::user()->role) }}</div>
                    </div>

                    <div
                        class="w-9 h-9 rounded-full bg-pink-100 text-pink-600 flex items-center justify-center font-bold border border-pink-200">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">Profil Saya</x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-600">
                        Keluar
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>
