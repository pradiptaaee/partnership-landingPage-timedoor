<section>
    <nav class="fixed navbar-custom top-0 w-full bg-white z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4 lg:px-8 h-16">

            <!-- Logo -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/logo-TA.svg') }}" alt="Timedoor Academy" class="h-10">
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
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-2">

                <!-- About -->
                <div class="relative dropdown-container">
                    <button
                        class="flex nav-link items-center font-medium hover:text-emerald-600 dropdown-button focus:outline-none">
                        {{ __('Menu About') }}
                        <svg class="w-4 h-4 ml-1 transition-transform duration-200 arrow" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute dropdown-menu hidden bg-white shadow-lg rounded-md mt-2 w-48 z-50">
                        <a href="{{ url('/about') }}" class="block px-4 py-2 hover:bg-gray-100">Our Story</a>
                        <a href="{{ url('/about/team') }}" class="block px-4 py-2 hover:bg-gray-100">Our Team</a>
                        <a href="{{ url('/about/testimonials') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Testimonials</a>
                    </div>
                </div>

                <div class="relative dropdown-container">
                    <button
                        class="flex items-center nav-link font-medium hover:text-emerald-600 dropdown-button focus:outline-none">
                        {{ __('Footer Course') }}
                        <svg class="w-4 h-4 ml-1 transition-transform duration-200 arrow" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute dropdown-menu hidden bg-white shadow-lg rounded-md mt-2 w-56 z-50">
                        <a href="{{ url('/courses/programming') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Programming</a>
                        <a href="{{ url('/courses/design') }}" class="block px-4 py-2 hover:bg-gray-100">Design</a>
                        <a href="{{ url('/courses/digital-marketing') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Digital Marketing</a>
                    </div>
                </div>

                <!-- Blog -->
                <a href="{{ url('/blog') }}" class="font-medium nav-link hover:text-emerald-600">
                    {{ __('Menu Blog') }}
                </a>

                <!-- Partnership -->
                <div class="relative dropdown-container">
                    <button
                        class="flex items-center nav-link font-medium hover:text-emerald-600 dropdown-button focus:outline-none">
                        {{ __('Footer Partnership') }}
                        <svg class="w-4 h-4 ml-1 transition-transform duration-200 arrow" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute dropdown-menu hidden bg-white shadow-lg rounded-md mt-2 w-48 z-50">
                        <a href="{{ url('/partnership') }}" class="block px-4 py-2 hover:bg-gray-100">Our Partners</a>
                        <a href="{{ url('/partnership/activities') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Activities</a>
                    </div>
                </div>

                <div class="flex items-center gap-3 xl:gap-7">
                    <div class="relative inline-block">
                        <!-- Dropdown Button -->
                        <button id="languageButton"
                            class="flex items-center gap-1 sm:gap-2 hover:opacity-80 transition-opacity">
                            <!-- Flag Circle -->
                            <div id="currentFlag"
                                class="flag-container w-6 h-6 sm:w-8 sm:h-8 rounded-full shadow-md overflow-hidden flex items-center justify-center">
                                @if ($currentLangData['type'] === 'img')
                                    <img class="h-full" src="{{ $currentLangData['flag'] }}"
                                        alt="{{ $currentLangData['code'] }} FLAG">
                                @elseif($currentLangData['flag'] === 'bd')
                                    <svg width="2000" height="2000" viewBox="0 0 2000 2000"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <clipPath id="circleBDCurrent">
                                                <circle cx="1000" cy="1000" r="1000" />
                                            </clipPath>
                                        </defs>
                                        <g clip-path="url(#circleBDCurrent)">
                                            <rect width="2000" height="2000" fill="#006A4E" />
                                            <circle cx="900" cy="1000" r="450" fill="#F42A41" />
                                        </g>
                                    </svg>
                                @elseif($currentLangData['flag'] === 'jp')
                                    <svg width="2000" height="2000" viewBox="0 0 2000 2000"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <clipPath id="circleJPCurrent">
                                                <circle cx="1000" cy="1000" r="1000" />
                                            </clipPath>
                                        </defs>
                                        <g clip-path="url(#circleJPCurrent)">
                                            <rect width="2000" height="2000" fill="white" />
                                            <circle cx="1000" cy="1000" r="600" fill="#BC002D" />
                                        </g>
                                    </svg>
                                @endif
                            </div>
                            <!-- Language Code -->
                            <span id="currentLang"
                                class="font-bold text-gray-500 text-sm sm:text-base transition-all duration-150">{{ $currentLangData['code'] }}</span>
                            <!-- Dropdown Arrow -->
                            <svg id="dropdownArrow"
                                class="w-3 h-3 sm:w-4 sm:h-4 text-gray-400 transition-transform duration-200 "
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu - Terpusat di tengah tombol -->
                        <div id="dropdownMenu"
                            class="hidden absolute top-full mt-2 sm:mt-3 left-1/2 -translate-x-1/2 bg-white rounded-xl sm:rounded-2xl shadow-xl overflow-hidden min-w-[130px] sm:min-w-[150px] z-50">
                            <!-- Indonesia -->
                            <button data-lang="ID"
                                class="lang-option w-full flex items-center justify-center gap-2 sm:gap-3 px-3 py-2 sm:px-4 sm:py-3 hover:bg-gray-50 transition-colors">
                                <div
                                    class="flag-container w-6 h-6 sm:w-8 sm:h-8 rounded-full shadow-md overflow-hidden flex items-center justify-center">
                                    <img class="h-full" src="images/idFlag.png" alt="ID FLAG">

                                </div>
                                <span id="langOption" class="font-bold text-gray-600 text-sm sm:text-base">ID</span>
                            </button>

                            <!-- English Option -->
                            <button data-lang="EN"
                                class="lang-option w-full flex items-center justify-center gap-2 sm:gap-3 px-3 py-2 sm:px-4 sm:py-3 hover:bg-gray-50 transition-colors">
                                <div
                                    class="flag-container w-6 h-6 sm:w-8 sm:h-8 rounded-full shadow-md overflow-hidden flex items-center justify-center">
                                    <img class="h-full" src="images/enFlag.png" alt="EN FLAG">
                                </div>
                                <span id="langOption" class="font-bold text-gray-600 text-sm sm:text-base">EN</span>
                            </button>

                            <!-- Bangladesh Option -->
                            <button data-lang="BD"
                                class="lang-option w-full flex items-center justify-center gap-2 sm:gap-3 px-3 py-2 sm:px-4 sm:py-3 hover:bg-gray-50 transition-colors">
                                <div
                                    class="flag-container w-6 h-6 sm:w-8 sm:h-8 rounded-full shadow-md overflow-hidden flex items-center justify-center">
                                    <svg width="2000" height="2000" viewBox="0 0 2000 2000"
                                        xmlns="http://www.w3.org/2000/svg">

                                        <defs>
                                            <clipPath id="circleBD">
                                                <circle cx="1000" cy="1000" r="1000" />
                                            </clipPath>
                                        </defs>

                                        <g clip-path="url(#circleBD)">
                                            <!-- Latar hijau -->
                                            <rect width="2000" height="2000" fill="#006A4E" />

                                            <!-- Lingkaran merah (sedikit ke kiri) -->
                                            <circle cx="900" cy="1000" r="450" fill="#F42A41" />
                                        </g>
                                    </svg>

                                </div>
                                <span id="langOption" class="font-bold text-gray-600 text-sm sm:text-base">BD</span>
                            </button>

                            <!-- Arabic Option -->
                            <button data-lang="AR"
                                class="lang-option w-full flex items-center justify-center gap-2 sm:gap-3 px-3 py-2 sm:px-4 sm:py-3 hover:bg-gray-50 transition-colors">
                                <div
                                    class="flag-container w-6 h-6 sm:w-8 sm:h-8 rounded-full shadow-md overflow-hidden flex items-center justify-center">
                                    <img class="h-full" src="images/arFlag.png" alt="AR FLAG">

                                </div>
                                <span id="langOption" class="font-bold text-gray-600 text-sm sm:text-base">AR</span>
                            </button>

                            <!-- Philippines Option -->
                            <button data-lang="PH"
                                class="lang-option w-full flex items-center justify-center gap-2 sm:gap-3 px-3 py-2 sm:px-4 sm:py-3 hover:bg-gray-50 transition-colors">
                                <div
                                    class="flag-container w-6 h-6 sm:w-8 sm:h-8 rounded-full shadow-md overflow-hidden flex items-center justify-center">
                                    <img class="h-full" src="images/phFlag.png" alt="PH FLAG">
                                </div>
                                <span id="langOption" class="font-bold text-gray-600 text-sm sm:text-base">PH</span>
                            </button>

                            <!-- Japan Option -->
                            <button data-lang="JP"
                                class="lang-option w-full flex items-center justify-center gap-2 sm:gap-3 px-3 py-2 sm:px-4 sm:py-3 hover:bg-gray-50 transition-colors">
                                <div
                                    class="flag-container w-6 h-6 sm:w-8 sm:h-8 rounded-full shadow-md overflow-hidden flex items-center justify-center">
                                    <svg width="2000" height="2000" viewBox="0 0 2000 2000"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <defs>
                                            <clipPath id="circleJP">
                                                <circle cx="1000" cy="1000" r="1000" />
                                            </clipPath>
                                        </defs>

                                        <g clip-path="url(#circleJP)">
                                            <rect width="2000" height="2000" fill="white" />
                                            <circle cx="1000" cy="1000" r="600" fill="#BC002D" />
                                        </g>
                                    </svg>

                                </div>
                                <span id="langOption" class="font-bold text-gray-600 text-sm sm:text-base">JP</span>
                            </button>

                            <!-- Malaysia Option -->
                            <button data-lang="MY"
                                class="lang-option w-full flex items-center justify-center gap-2 sm:gap-3 px-3 py-2 sm:px-4 sm:py-3 hover:bg-gray-50 transition-colors">
                                <div
                                    class="flag-container w-6 h-6 sm:w-8 sm:h-8 rounded-full shadow-md overflow-hidden flex items-center justify-center">
                                    <img class="w-full h-full" src="images/myFlag.png" alt="MY FLAG">
                                </div>
                                <span id="langOption" class="font-bold text-gray-600 text-sm sm:text-base">MY</span>
                            </button>
                        </div>
                    </div>

                    <a href="{{ route('trial.index') }}" id="trialButton"
                        class="bg-[#10AF13] text-white shadow-[0_7px_0_#0E8E10] hover:shadow-[0_5px_0_#0E8E10] active:shadow-[0_2px_0_#0E8E10] font-bold py-2.5 px-4 rounded-xl uppercase text-[10px] sm:text-sm transition-all duration-150 hover:translate-y-[5px] active:translate-y-[7px]">
                        {{ __('Book a Free Trial') }}
                    </a>
                </div>

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
