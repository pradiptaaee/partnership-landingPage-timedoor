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