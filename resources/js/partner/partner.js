document.addEventListener("DOMContentLoaded", () => {

    const currentPath = window.location.pathname;

    document.querySelectorAll("[data-nav]").forEach(link => {

        const navPath = link.dataset.nav;

        // exact match
        if (currentPath === navPath) {
            link.classList.add("text-emerald-600");
        }

        // prefix match (important for nested)
        if (currentPath.startsWith(navPath) && navPath !== "/") {
            link.classList.add("text-emerald-600");
        }
    });

    document.querySelectorAll("[data-dropdown]").forEach(drop => {

        const dropPath = drop.dataset.dropdown;

        if (currentPath.startsWith(dropPath)) {
            drop.classList.add("text-emerald-600");
        }
    });

});
document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById('mobileToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const hamburgerIcon = document.getElementById('hamburgerIcon');
    const closeIcon = document.getElementById('closeIcon');
    const menuItems = document.querySelectorAll('#menuItems > li');

    if (menuBtn) {
        menuBtn.onclick = function (e) {
            e.preventDefault();

            // Cek apakah menu sedang terbuka
            const isMenuOpen = !mobileMenu.classList.contains('translate-x-full');

            if (isMenuOpen) {
                mobileMenu.classList.add('translate-x-full', 'opacity-0');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                document.body.style.overflow = '';
            } else {
                mobileMenu.classList.remove('translate-x-full', 'opacity-0');
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                document.body.style.overflow = 'hidden';

                menuItems.forEach((item, index) => {
                    item.style.opacity = "0";
                    item.style.transform = "translateX(20px)";
                    setTimeout(() => {
                        item.style.transition = "all 0.4s ease";
                        item.style.opacity = "1";
                        item.style.transform = "translateX(0)";
                    }, 80 * (index + 1));
                });
            }
        };
    }
});

function toggleDropdown(id, button) {
    const currentDropdown = document.getElementById(id);
    const currentIcon = button.querySelector("svg");

    if (!currentDropdown) return;

    const isOpen = currentDropdown.style.maxHeight && currentDropdown.style.maxHeight !== "0px";

    document.querySelectorAll('[id$="Dropdown"]').forEach(drop => {
        if (drop.id !== id) {
            drop.style.maxHeight = null;
            const prevBtn = drop.previousElementSibling;
            if (prevBtn) {
                const icon = prevBtn.querySelector("svg");
                if (icon) icon.classList.remove("rotate-180");
            }
        }
    });

    // Toggle klik
    if (isOpen) {
        currentDropdown.style.maxHeight = "0px";
        if (currentIcon) currentIcon.classList.remove("rotate-180");
    } else {
        currentDropdown.style.maxHeight = currentDropdown.scrollHeight + "px";
        if (currentIcon) currentIcon.classList.add("rotate-180");
    }
}

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