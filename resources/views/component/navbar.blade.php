<nav class="fixed top-0 inset-x-0 bg-white shadow z-50">
    <!-- Container utama dengan padding horizontal besar -->
    <div class="max-w-7xl mx-auto px-6 lg:px-12 flex items-center justify-between h-16">

        <!-- LOGO -->
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/logo-TA.svg') }}" class="h-9" alt="Timedoor Academy">
        </a>

        <!-- DESKTOP MENU -->
        <div class="hidden lg:flex items-center gap-8">
            <!-- ABOUT -->
            <div class="relative group">
                <button class="nav-item">
                    About Us <i class="bi bi-chevron-down text-xs ml-1"></i>
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-200">
                    <a href="{{ url('/about') }}" class="block px-4 py-2 hover:bg-gray-100">Our Story</a>
                    <a href="{{ url('/about/team') }}" class="block px-4 py-2 hover:bg-gray-100">Our Team</a>
                    <a href="{{ url('/about/testimonials') }}" class="block px-4 py-2 hover:bg-gray-100">Testimonials</a>
                </div>
            </div>

            <!-- COURSES -->
            <div class="relative group">
                <button class="nav-item">
                    Our Courses <i class="bi bi-chevron-down text-xs ml-1"></i>
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-200">
                    <a href="{{ url('/courses/programming') }}" class="block px-4 py-2 hover:bg-gray-100">Programming</a>
                    <a href="{{ url('/courses/design') }}" class="block px-4 py-2 hover:bg-gray-100">Design</a>
                    <a href="{{ url('/courses/digital-marketing') }}" class="block px-4 py-2 hover:bg-gray-100">Digital Marketing</a>
                    <a href="{{ url('/courses/data-science') }}" class="block px-4 py-2 hover:bg-gray-100">Data Science</a>
                </div>
            </div>

            <a href="{{ url('/blog') }}" class="nav-item">Blog</a>

            <!-- PARTNERSHIP -->
            <div class="relative group">
                <button class="nav-item text-green-600 font-semibold">
                    Partnership <i class="bi bi-chevron-down text-xs ml-1"></i>
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-200">
                    <a href="{{ url('/partnership') }}" class="block px-4 py-2 hover:bg-gray-100">Our Partners</a>
                    <a href="{{ url('/partnership/activities') }}" class="block px-4 py-2 hover:bg-gray-100">Activities</a>
                    <a href="{{ url('/partnership/apply') }}" class="block px-4 py-2 hover:bg-gray-100">Become a Partner</a>
                </div>
            </div>

            <a href="{{ url('/contact') }}" class="nav-item">Contact</a>

            <!-- LANGUAGE -->
            <div class="relative group">
                <button class="flex items-center gap-2 px-3 py-1.5 hover:bg-gray-100 rounded">
                    <img src="https://flagcdn.com/w40/gb.png" class="w-6 h-4 rounded">
                    <span class="text-sm">EN</span>
                    <i class="bi bi-chevron-down text-xs"></i>
                </button>
                <div class="absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-200">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">English</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Indonesia</a>
                    <a href="{{ route('change.language','ja') }}" class="block px-4 py-2 hover:bg-gray-100">日本語</a>
                    <a href="{{ route('change.language','ar') }}" class="block px-4 py-2 hover:bg-gray-100">العربية</a>
                </div>
            </div>

            <!-- CTA -->
            <a href="{{ url('/book-trial') }}"
                class="bg-green-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-600 transition">
                Book Free Trial
            </a>
        </div>

        <div class="flex items-center gap-3 lg:hidden">
            <a href="{{ url('/book-trial') }}"
                class="flex text-center bg-green-500 text-white p-2 rounded-lg font-semibold text-sm">
                Book Free Trial
            </a>
            <!-- MOBILE BUTTON -->
            <button id="mobileToggle"
                class="lg:hidden p-2 rounded-md hover:bg-gray-100 transition">
                <svg class="w-7 h-7 text-gray-800" fill="none"
                    stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- OVERLAY -->
    <div id="menuOverlay"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm opacity-0 invisible transition-all duration-300 lg:hidden z-40">
    </div>

    <!-- MOBILE MENU (OFFCANVAS) -->
    <div id="mobileMenu"
        class="fixed top-0 right-0 h-full w-[80%] max-w-sm bg-white shadow-2xl
            translate-x-full opacity-0
            transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]
            lg:hidden z-50 p-6 overflow-y-auto">

        <!-- HEADER -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold">Menu</h2>
            <button id="closeMenu" class="text-2xl font-bold">&times;</button>
        </div>

        <ul id="menuItems" class="space-y-4 text-gray-700">

            <li>
                <!-- BUTTON DROPDOWN -->
                <button type="button"
                    class="flex items-center justify-between w-full py-2"
                    onclick="toggleDropdown('aboutDropdown', this)">

                    <span>Tentang Kami</span>

                    <svg class="w-4 h-4 transition-transform duration-300"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- SUBMENU -->
                <ul id="aboutDropdown"
                    class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out pl-4 space-y-3">
                    <li><a href="#" class="block text-gray-600">Kenapa Pilih Kami?</a></li>
                    <li><a href="#" class="block text-gray-600">Cabang Kami</a></li>
                    <li><a href="#" class="block text-gray-600">Karir</a></li>
                    <li><a href="#" class="block text-gray-600">FAQ</a></li>
                </ul>
            </li>

            <li>
                <!-- BUTTON DROPDOWN -->
                <button type="button"
                    class="flex items-center justify-between w-full py-2"
                    onclick="toggleDropdown('kelasDropdown', this)">
                    <span>Kelas</span>
                    <svg class="w-4 h-4 transition-transform duration-300"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- SUBMENU -->
                <ul id="kelasDropdown"
                    class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out pl-4 space-y-3">

                    <li><a href="#" class="block text-gray-600">Junior Coder</a></li>
                    <li><a href="#" class="block text-gray-600">Code Adventure</a></li>
                    <li><a href="#" class="block text-gray-600">Python Developer</a></li>
                    <li><a href="#" class="block text-gray-600">ioT Developer</a></li>
                    <li><a href="#" class="block text-gray-600">Software Developer</a></li>
                    <li><a href="#" class="block text-gray-600">AI Engineer</a></li>
                    <li><a href="#" class="block text-gray-600">Coder Profesional(online)</a></li>
                    <li><a href="#" class="block text-gray-600">Matematika, English, IPA</a></li>
                    <li><a href="#" class="block text-gray-600">Portofolio</a></li>

                </ul>
            </li>

            <li>
                <a href="{{ url('/partnership') }}"
                    class="block py-2 text-gray-600">
                    Blog
                </a>
            </li>

            <li>
                <!-- BUTTON DROPDOWN -->
                <button type="button"
                    class="flex items-center justify-between w-full py-2"
                    onclick="toggleDropdown('partnerDropdown', this)">

                    <span class="block py-2 text-green-600">Partnership</span>

                    <svg class="w-4 h-4 transition-transform duration-300"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- SUBMENU -->
                <ul id="partnerDropdown"
                    class="max-h-0 overflow-hidden transition-all duration-500 ease-in-out pl-4 space-y-3">
                    <li><a href="#" class="block text-gray-600">Franchise & Investasi</a></li>
                    <li><a href="#" class="block text-green-600">Kerjasama Sekolah</a></li>
                    <li><a href="#" class="block text-gray-600">Friend Referral</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ url('/contact') }}" class="block py-2">Hubungi Kami</a>
            </li>

            <li>
                <!-- BUTTON DROPDOWN -->
                <button type="button"
                    class="flex items-center justify-between w-full py-2"
                    onclick="toggleDropdown('languageDropdown', this)">

                    <div class="flex items-center gap-2">
                        <img src="https://flagcdn.com/w40/gb.png" class="w-5 h-5" alt="EN">
                        <span>EN</span>
                    </div>

                    <svg class="w-4 h-4 transition-transform duration-300"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 9l-7 7-7-7"/>
                    </svg>

                </button>
                <ul id="languageDropdown"
                    class="mobile-dropdown max-h-0 overflow-hidden transition-all duration-500 ease-in-out pl-4 space-y-3">

                    <li>
                        <a href="#" class="flex items-center gap-2 text-gray-600">
                            <img src="https://flagcdn.com/w40/id.png"alt="Indonesia"
                                class="w-6 h-auto rounded-sm object-cover">
                            ID
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center gap-2 text-gray-600">
                            <img src="https://flagcdn.com/w40/bd.png"alt="Bangladesh"
                                class="w-6 h-auto rounded-sm object-cover">
                            BD
                        </a>
                    </li>

                    <li>
                        <a href="#" class="flex items-center gap-2 text-gray-600">
                            <img src="https://flagcdn.com/w40/eg.png"alt="Egypt"
                                class="w-6 h-auto rounded-sm object-cover">
                            AR
                        </a>
                    </li>

                </ul>

            </li>
        </ul>
    </div>


</nav>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const openMenuBtn = document.getElementById('mobileToggle');
        const closeMenuBtn = document.getElementById('closeMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('menuOverlay');
        const menuItems = document.querySelectorAll('#menuItems li');

        openMenuBtn.addEventListener('click', function() {

            // slide + fade
            mobileMenu.classList.remove('translate-x-full', 'opacity-0');
            overlay.classList.remove('opacity-0', 'invisible');
            overlay.classList.add('opacity-100', 'visible');

            // lock scroll
            document.body.classList.add('overflow-hidden');

            // stagger animation
            menuItems.forEach((item, index) => {
                item.style.opacity = "0";
                item.style.transform = "translateX(20px)";
                setTimeout(() => {
                    item.style.transition = "all 0.4s ease";
                    item.style.opacity = "1";
                    item.style.transform = "translateX(0)";
                }, 100 * index);
            });
        });

        function closeMobileMenu() {
            mobileMenu.classList.add('translate-x-full', 'opacity-0');
            overlay.classList.add('opacity-0', 'invisible');
            overlay.classList.remove('opacity-100', 'visible');

            document.body.classList.remove('overflow-hidden');
        }

        closeMenuBtn.addEventListener('click', closeMobileMenu);
        overlay.addEventListener('click', closeMobileMenu);

    });

    function toggleDropdown(id, button) {

        const allDropdowns = document.querySelectorAll('[id$="Dropdown"]');
        const allIcons = document.querySelectorAll('button svg');

        const currentDropdown = document.getElementById(id);
        const currentIcon = button.querySelector("svg");

        const isOpen = currentDropdown.style.maxHeight;

        // Tutup semua dropdown dulu
        allDropdowns.forEach(drop => {
            drop.style.maxHeight = null;
        });

        allIcons.forEach(icon => {
            icon.classList.remove("rotate-180");
        });

        // Kalau sebelumnya belum terbuka → buka
        if (!isOpen) {
            currentDropdown.style.maxHeight = currentDropdown.scrollHeight + "px";
            currentIcon.classList.add("rotate-180");
        }
    }
</script>