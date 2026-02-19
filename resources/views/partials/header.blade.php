<header class="fixed top-0 inset-x-0 bg-white z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

        {{-- LOGO --}}
        <a href="/" class="flex items-center gap-2">
            <img src="{{ asset('logo.png') }}" alt="Timedoor" class="h-9 w-auto object-contain">
        </a>

        {{-- DESKTOP MENU --}}
        <nav class="hidden md:flex items-center gap-10 text-[15px] font-medium text-gray-700">

            <a href="#"
                class="transition duration-200 hover:text-green-600 {{ request()->is('about') ? 'text-green-600 font-semibold' : '' }}">
                Tentang Kami
            </a>

            <a href="#"
                class="transition duration-200 hover:text-green-600 {{ request()->is('kelas') ? 'text-green-600 font-semibold' : '' }}">
                Kelas
            </a>

            <a href="#"
                class="transition duration-200 hover:text-green-600 {{ request()->is('blog') ? 'text-green-600 font-semibold' : '' }}">
                Blog
            </a>

            <a href="{{ url('/partnership') }}"
                class="transition duration-200 hover:text-green-600 {{ request()->is('partnership') ? 'text-green-600 font-semibold' : '' }}">
                Partnership
            </a>

            {{-- CTA BUTTON --}}
            <a href="#"
                class="ml-4 px-7 py-2.5 rounded-full bg-green-500 text-white font-semibold shadow-md hover:bg-green-600 hover:shadow-lg transition duration-300">
                COBA GRATIS
            </a>
        </nav>

        {{-- MOBILE ACTION --}}
        <div class="flex items-center gap-4 md:hidden">

            <a href="#"
                class="px-5 py-2 text-sm rounded-full bg-green-500 text-white font-semibold shadow-md">
                COBA GRATIS
            </a>

            <button id="openMenu" class="text-3xl text-gray-700">
                <i class="bi bi-list"></i>
            </button>

        </div>

    </div>
</header>