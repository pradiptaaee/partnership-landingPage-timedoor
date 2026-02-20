<section>
    <nav class="fixed navbar-custom top-0 w-full bg-white z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4 lg:px-8 h-16">

            <!-- Logo -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo-TA.svg') }}" 
                     alt="Timedoor Academy" 
                     class="h-10">
            </a>

            <!-- Right Side -->
            <div class="flex items-center gap-2">

                <!-- Mobile Trial Button -->
                <a href="{{ url('/book-trial') }}"
                   class="lg:hidden sm:block bg-[#10AF13] text-white text-xs sm:text-sm font-medium py-2.5 px-4 rounded-xl uppercase shadow-[0_7px_0_#0E8E10] transition-all duration-150 hover:translate-y-[5px] hover:shadow-[0_5px_0_#0E8E10] active:translate-y-[7px] active:shadow-[0_2px_0_#0E8E10]">
                    FREE TRIAL
                </a>

                <!-- Mobile Toggle -->
                <button id="menuBtn" class="lg:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" 
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-2">

                <!-- About -->
                <div class="relative group">
                    <button class="flex nav-link items-center font-medium hover:text-emerald-600">
                        {{ __('Menu About') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute dropdown-menu hidden group-hover:block bg-white shadow-lg rounded-md mt-2 w-48">
                        <a href="{{ url('/about') }}" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Our Story</a>
                        <a href="{{ url('/about/team') }}" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Our Team</a>
                        <a href="{{ url('/about/testimonials') }}" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Testimonials</a>
                    </div>
                </div>

                <!-- Courses -->
                <div class="relative group">
                    <button class="flex items-center nav-link font-medium hover:text-emerald-600">
                        {{ __('Footer Course') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute dropdown-menu hidden group-hover:block bg-white shadow-lg rounded-md mt-2 w-56">
                        <a href="{{ url('/courses/programming') }}" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Programming</a>
                        <a href="{{ url('/courses/design') }}" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Design</a>
                        <a href="{{ url('/courses/digital-marketing') }}" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Digital Marketing</a>
                    </div>
                </div>

                <!-- Blog -->
                <a href="{{ url('/blog') }}" 
                   class="font-medium nav-link hover:text-emerald-600">
                    {{ __('Menu Blog') }}
                </a>

                <!-- Partnership -->
                <div class="relative group">
                    <button class="flex items-center nav-link font-medium hover:text-emerald-600">
                        {{ __('Footer Partnership') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute dropdown-menu hidden group-hover:block bg-white shadow-lg rounded-md mt-2 w-48">
                        <a href="{{ url('/partnership') }}" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Our Partners</a>
                        <a href="{{ url('/partnership/activities') }}" class="dropdown-item block px-4 py-2 hover:bg-gray-100">Activities</a>
                    </div>
                </div>

                <!-- Language -->
                <div class="relative group">
                    <button class="nav-link flex items-center gap-2 font-medium">
                        <img src="https://flagcdn.com/w40/gb.png" 
                             alt="EN" 
                             class="w-5">
                        EN
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-md mt-2 w-40">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Indonesia</a>
                    </div>
                </div>

                <!-- Desktop Trial Button -->
                <a href="{{ url('/book-trial') }}"
                   class="hidden sm:block bg-[#10AF13] text-white text-xs sm:text-sm font-medium py-2.5 px-4 rounded-xl uppercase shadow-[0_7px_0_#0E8E10] transition-all duration-150 hover:translate-y-[5px] hover:shadow-[0_5px_0_#0E8E10] active:translate-y-[7px] active:shadow-[0_2px_0_#0E8E10]">
                    Book Free Trial
                </a>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden lg:hidden bg-white shadow-md">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ url('/about') }}" class="block">Our Story</a>
                <a href="{{ url('/courses/programming') }}" class="block">Programming</a>
                <a href="{{ url('/blog') }}" class="block">Blog</a>
                <a href="{{ url('/partnership') }}" class="block">Partnership</a>
            </div>
        </div>
    </nav>
</section>

<script>
    
</script>
