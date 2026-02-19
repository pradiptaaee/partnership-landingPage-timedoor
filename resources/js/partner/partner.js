document.addEventListener('DOMContentLoaded', function () {

    // 1. LOGIKA NAVBAR SCROLL (Shadow effect)
    const navbar = document.querySelector('.navbar-custom');
    window.addEventListener('scroll', function () {
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.12)';
            } else {
                navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.00)';
            }
        }
    });

    // 2. LOGIKA MOBILE MENU TOGGLE
    const btn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    if (btn && mobileMenu) {
        btn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // 3. LOGIKA DROPDOWN (BAHASA & NAVIGASI UMUM)
    const langButton = document.getElementById('languageButton');
    const langMenu = document.getElementById('dropdownMenu');
    const langArrow = document.getElementById('dropdownArrow');
    const backdrop = document.getElementById('dropdownBackdrop');
    const currentLang = document.getElementById('currentLang');
    const langOptions = document.querySelectorAll('.lang-option');
    const navDropdowns = document.querySelectorAll('.dropdown-container');

    // Mapping Locale Laravel
    const langCodeMapping = {
        'EN': 'en', 'ID': 'id', 'BD': 'bn', 'AR': 'ar',
        'PH': 'fil', 'JP': 'ja', 'MY': 'ms'
    };

    // Fungsi Sembunyikan Opsi Aktif (Khusus Bahasa)
    function hideActiveLangOption() {
        if (currentLang) {
            const activeLangText = currentLang.textContent.trim();
            langOptions.forEach(option => {
                const lang = option.getAttribute('data-lang');
                option.classList.toggle('hidden', lang === activeLangText);
            });
        }
    }

    // Fungsi Tutup Semua Dropdown
    function closeAllDropdowns(exceptMe = null) {
        // Tutup Dropdown Bahasa
        if (langMenu && langMenu !== exceptMe) {
            langMenu.classList.add('hidden');
            if (langArrow) langArrow.classList.remove('rotate-180');
        }

        // Tutup Dropdown Navigasi
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            if (menu !== exceptMe) {
                menu.classList.add('hidden');
                const parent = menu.closest('.dropdown-container');
                const arrow = parent ? parent.querySelector('.arrow') : null;
                if (arrow) arrow.classList.remove('rotate-180');
            }
        });

        // Sembunyikan Backdrop
        if (backdrop) backdrop.classList.add('hidden');
    }

    // Event Klik Dropdown Bahasa
    if (langButton && langMenu) {
        langButton.addEventListener('click', function (e) {
            e.stopPropagation();
            const isHidden = langMenu.classList.contains('hidden');
            closeAllDropdowns(); // Bersihkan yang lain dulu

            if (isHidden) {
                langMenu.classList.remove('hidden');
                if (langArrow) langArrow.classList.add('rotate-180');
                if (backdrop) backdrop.classList.remove('hidden');
                hideActiveLangOption();
            }
        });
    }

    // Event Klik Dropdown Navigasi (About, Courses, dll)
    navDropdowns.forEach(dropdown => {
        const btnNav = dropdown.querySelector('.dropdown-button');
        const menuNav = dropdown.querySelector('.dropdown-menu');
        const arrowNav = dropdown.querySelector('.arrow');

        if (btnNav && menuNav) {
            btnNav.addEventListener('click', function (e) {
                e.stopPropagation();
                const isHidden = menuNav.classList.contains('hidden');
                closeAllDropdowns(); // Bersihkan yang lain dulu

                if (isHidden) {
                    menuNav.classList.remove('hidden');
                    if (arrowNav) arrowNav.classList.add('rotate-180');
                    if (backdrop) backdrop.classList.remove('hidden');
                }
            });
        }
    });

    // Event Pilih Bahasa (Redirect)
    langOptions.forEach(option => {
        option.addEventListener('click', function () {
            const langCode = this.getAttribute('data-lang');
            const locale = langCodeMapping[langCode];
            if (locale) window.location.href = `/lang/${locale}`;
        });
    });

    // Event Klik Luar untuk Tutup Semuanya
    document.addEventListener('click', function () {
        closeAllDropdowns();
    });

    // Inisialisasi awal
    hideActiveLangOption();
});


document.getElementById("loadMoreLink").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("moreWorkshops").classList.remove("d-none");
    this.style.display = "none";
});

// load more 2
document.getElementById("loadMore").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("Workshops").classList.remove("d-none");
    this.style.display = "none";
});