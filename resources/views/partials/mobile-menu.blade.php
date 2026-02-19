<div id="mobileMenu"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm z-50 hidden">

    {{-- PANEL --}}
    <div id="mobilePanel"
        class="absolute right-0 top-0 h-full w-[85%] max-w-sm bg-white p-8 flex flex-col transform translate-x-full transition-transform duration-300 ease-in-out">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-10">
            <img src="{{ asset('logo.png') }}" class="h-9 w-auto object-contain">
            <button id="closeMenu" class="text-2xl text-gray-700">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        {{-- MENU --}}
        <nav class="flex flex-col gap-7 text-lg font-medium text-gray-700">

            <a href="#"
                class="transition hover:text-green-600 {{ request()->is('about') ? 'text-green-600 font-semibold' : '' }}">
                Tentang Kami
            </a>

            <a href="#"
                class="transition hover:text-green-600 {{ request()->is('kelas') ? 'text-green-600 font-semibold' : '' }}">
                Kelas
            </a>

            <a href="#"
                class="transition hover:text-green-600 {{ request()->is('blog') ? 'text-green-600 font-semibold' : '' }}">
                Blog
            </a>

            <a href="{{ url('/partnership') }}"
                class="transition hover:text-green-600 {{ request()->is('partnership') ? 'text-green-600 font-semibold' : '' }}">
                Partnership
            </a>

            <a href="#"
                class="transition hover:text-green-600">
                Hubungi Kami
            </a>

            
        </nav>

        {{-- CTA --}}
        <div class="mt-auto pt-10">
            <a href="#"
                class="block text-center py-3 rounded-full bg-green-500 text-white font-semibold shadow-md hover:bg-green-600 transition">
                FREE TRIAL
            </a>
        </div>

    </div>
</div>