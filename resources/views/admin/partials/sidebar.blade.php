<aside id="sidebar-admin" class="w-64 shadow-xl flex flex-col border-r bg-[#131325] text-gray-100 fixed h-screen">

    {{-- Header Sidebar --}}
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                <i class="bi bi-lightning-charge-fill text-white text-xl"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-white">Admin Panel</h2>
                <p class="text-xs text-gray-400">Timedoor</p>
            </div>
        </div>
    </div>

    {{-- Navigasi --}}
    <nav class="flex-1 overflow-y-auto py-4 scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-transparent">
        <ul class="flex flex-col px-3 space-y-1">

            {{-- Dashboard --}}
            <li>
                <a href="#"
                   class="sidebar-link flex items-center p-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-200 group">
                    <i class="bi bi-grid-fill text-lg mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>

            {{-- Section Title --}}
            <li class="mt-6 mb-2">
                <span class="block text-xs uppercase font-semibold text-gray-500 px-3 tracking-wider">
                    Partnership
                </span>
            </li>

            {{-- Partners --}}
            <li>
                <a href="{{ route('admin.partners.index') }}"
                   class="sidebar-link flex items-center p-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.partners.*') ? 'active-sidebar-link' : '' }}">
                    <i class="bi bi-lightning-charge-fill text-lg mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Partners</span>
                </a>
            </li>

            {{-- Activity Partner --}}
            <li>
                <a href="{{ route('admin.activity.index') }}"
                   class="sidebar-link flex items-center p-3 rounded-lg text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-200 group {{ request()->routeIs('admin.activity.*') ? 'active-sidebar-link' : '' }}">
                    <i class="bi bi-box text-lg mr-3 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">Activity Partner</span>
                </a>
            </li>

             {{-- Tambahkan class 'group' di sini. Ini kuncinya. --}}
<li class="nav-item group relative">
    
    @php
        // Cek apakah sedang aktif di salah satu sub-menu
        $isLandingPageActive = request()->routeIs('admin.banners.*') || 
                               request()->routeIs('admin.testimonials.*') || 
                               request()->routeIs('admin.student-projects.*');
    @endphp

    {{-- 1. Tombol Utama (Parent) --}}
    {{-- Href dibuat # agar tidak reload saat cuma mau hover --}}
    <a href="#" 
       class="w-full flex items-center justify-between p-3 rounded-lg transition-all duration-200 
              {{ $isLandingPageActive ? 'bg-gray-800 text-white' : 'text-gray-300 group-hover:bg-gray-800 group-hover:text-white' }}">
        
        <div class="flex items-center">
            <i class="bi bi-window-fullscreen text-lg mr-3"></i>
            <span class="font-medium">Landing Page</span>
        </div>
        
        {{-- Ikon Panah (Otomatis berputar saat di-hover berkat group-hover) --}}
        <i class="bi bi-chevron-down text-xs transition-transform duration-300 group-hover:rotate-180"></i>
    </a>

    {{-- 2. Daftar Sub-Menu (Children) --}}
    {{-- Logic: hidden (sembunyi), tapi group-hover:block (muncul saat induk di-hover) --}}
    <ul class="hidden group-hover:block mt-1 space-y-1 pl-4 border-l border-gray-700 ml-4 animate-fade-in-down">
        
        {{-- A. Menu Banner --}}
        <li>
            <a href="{{ route('admin.banners.index') }}" 
               class="block px-3 py-2 rounded-lg text-sm transition-colors 
                      {{ request()->routeIs('admin.banners.*') ? 'text-green-400 font-bold bg-gray-800' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                Banner Slider
            </a>
        </li>

        {{-- B. Menu Testimonials --}}
        <li>
            <a href="{{ Route::has('admin.testimonials.index') ? route('admin.testimonials.index') : '#' }}" 
               class="block px-3 py-2 rounded-lg text-sm transition-colors 
                      {{ request()->routeIs('admin.testimonials.*') ? 'text-green-400 font-bold bg-gray-800' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                Testimonials
            </a>
        </li>

        {{-- C. Menu Student Projects --}}
        <li>
            <a href="{{ Route::has('admin.student-projects.index') ? route('admin.student-projects.index') : '#' }}" 
               class="block px-3 py-2 rounded-lg text-sm transition-colors 
                      {{ request()->routeIs('admin.student-projects.*') ? 'text-green-400 font-bold bg-gray-800' : 'text-gray-400 hover:text-white hover:bg-gray-700' }}">
                Student Projects
            </a>
        </li>

    </ul>
</li>

        </ul>
    </nav>

    {{-- User Profile & Logout --}}
    <div class="border-t border-gray-700">
        {{-- User Info (Optional) --}}
        <div class="p-4 border-b border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold text-sm">A</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">Admin User</p>
                    <p class="text-xs text-gray-400 truncate">admin@timedoor.net</p>
                </div>
            </div>
        </div>
        
        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="p-3">
            @csrf
            <button type="submit"
                class="flex items-center w-full p-3 rounded-lg text-gray-300 hover:bg-red-900/30 hover:text-red-400 transition-all duration-200 group">
                <i class="bi bi-box-arrow-right text-lg mr-3 group-hover:translate-x-1 transition-transform"></i>
                <span class="font-medium">Log out</span>
            </button>
        </form>
    </div>
</aside>