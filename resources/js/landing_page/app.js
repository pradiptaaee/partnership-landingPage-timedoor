// DROPDOWN
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('languageButton');
    const menu = document.getElementById('dropdownMenu');
    const arrow = document.getElementById('dropdownArrow');
    const backdrop = document.getElementById('dropdownBackdrop');
    const currentFlag = document.getElementById('currentFlag');
    const currentLang = document.getElementById('currentLang');

    if (!button || !menu || !arrow || !backdrop || !currentFlag || !currentLang) return;

    const langOptions = menu.querySelectorAll('.lang-option');

    // Sembunyikan opsi yang sedang aktif di dropdown
    function hideActiveOption() {
        const activeLang = currentLang.textContent;

        langOptions.forEach(option => {
            const lang = option.getAttribute('data-lang');
            if (lang === activeLang) {
                option.classList.add('hidden');
            } else {
                option.classList.remove('hidden');
            }
        });
    }

    // Buka dropdown
    button.addEventListener('click', function (e) {
        e.stopPropagation();
        menu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
        backdrop.classList.toggle('hidden');

        // Update visibility saat dropdown dibuka
        if (!menu.classList.contains('hidden')) {
            hideActiveOption();
        }
    });

    // Tutup saat klik luar
    document.addEventListener('click', function (e) {
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
            backdrop.classList.add('hidden');
        }
    });

    // Mapping dari kode negara ke kode locale Laravel
    const langCodeMapping = {
        'EN': 'en',
        'ID': 'id',
        'BD': 'bn',
        'AR': 'ar',
        'PH': 'fil',
        'JP': 'ja',
        'MY': 'ms'
    };

    // Pilih bahasa
    langOptions.forEach(option => {
        option.addEventListener('click', function () {
            const langCode = this.getAttribute('data-lang');
            const locale = langCodeMapping[langCode];

            // Redirect ke route perubahan bahasa
            if (locale) {
                window.location.href = `/lang/${locale}`;
            }
        });
    });

    // Saat load halaman, sembunyikan opsi default (ID)
    hideActiveOption();
});

// NAV
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('mainNavbar');
    const greenSections = document.querySelectorAll('.bg-green-trigger');
    const logoBlack = document.getElementById('logo-black');
    const logoWhite = document.getElementById('logo-white');
    const trialButton = document.getElementById('trialButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const currentLang = document.getElementById('currentLang');
    const dropdownArrow = document.getElementById('dropdownArrow');

    // ✅ CEK DULU ADA ATAU TIDAK
    if (!navbar) return;

    function updateNavbarBackground() {
        let shouldBeGreen = false;
        const navbarHeight = navbar.offsetHeight || 100;

        greenSections.forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top < navbarHeight && rect.bottom > 0) {
                shouldBeGreen = true;
            }
        });

        if (shouldBeGreen) {
            navbar.classList.remove('bg-white');
            navbar.classList.add('bg-[#10AF13]');

            if (logoBlack && logoWhite) {
                logoBlack.classList.add('hidden');
                logoWhite.classList.remove('hidden');
            }

            if (trialButton) {
                trialButton.classList.remove('bg-[#10AF13]', 'text-white');
                trialButton.classList.add('bg-white', 'text-[#00C220]');
            }

            if (dropdownMenu) {
                dropdownMenu.classList.remove('bg-white');
                dropdownMenu.classList.add('bg-[#10AF13]');

                const langOptions = dropdownMenu.querySelectorAll('.lang-option span');
                langOptions.forEach(span => {
                    span.classList.remove('text-gray-600');
                    span.classList.add('text-white');
                });

                const langButtons = dropdownMenu.querySelectorAll('.lang-option');
                langButtons.forEach(button => {
                    button.classList.remove('hover:bg-gray-50');
                    button.classList.add('hover:bg-[#0E8E10]');
                });
            }

            if (currentLang) {
                currentLang.classList.remove('text-gray-500');
                currentLang.classList.add('text-white');
            }

            if (dropdownArrow) {
                dropdownArrow.classList.remove('text-gray-400');
                dropdownArrow.classList.add('text-white');
            }

        } else {
            navbar.classList.remove('bg-[#10AF13]');
            navbar.classList.add('bg-white');

            if (logoBlack && logoWhite) {
                logoBlack.classList.remove('hidden');
                logoWhite.classList.add('hidden');
            }

            if (trialButton) {
                trialButton.classList.remove('bg-white', 'text-[#00C220]');
                trialButton.classList.add('bg-[#10AF13]', 'text-white');
            }

            if (dropdownMenu) {
                dropdownMenu.classList.remove('bg-[#10AF13]');
                dropdownMenu.classList.add('bg-white');

                const langOptions = dropdownMenu.querySelectorAll('.lang-option span');
                langOptions.forEach(span => {
                    span.classList.remove('text-white');
                    span.classList.add('text-gray-600');
                });

                const langButtons = dropdownMenu.querySelectorAll('.lang-option');
                langButtons.forEach(button => {
                    button.classList.remove('hover:bg-[#0E8E10]');
                    button.classList.add('hover:bg-gray-50');
                });
            }

            if (currentLang) {
                currentLang.classList.remove('text-white');
                currentLang.classList.add('text-gray-500');
            }

            if (dropdownArrow) {
                dropdownArrow.classList.remove('text-white');
                dropdownArrow.classList.add('text-gray-400');
            }
        }
    }

    window.addEventListener('scroll', updateNavbarBackground);
    updateNavbarBackground();
});

// SWIPER
import Swiper from "swiper";
import { Autoplay, Navigation } from "swiper/modules";
import 'swiper/css';

// ✅ CEK ELEMENT SWIPER ADA ATAU TIDAK
const swiperLeftEl = document.querySelector(".swiper_left");
if (swiperLeftEl) {
    new Swiper(".swiper_left", {
        modules: [Autoplay],
        loop: true,
        allowTouchMove: false,
        slidesPerView: "auto",
        spaceBetween: 24,
        speed: 5000,
        autoplay: {
            delay: 0,
            disableOnInteraction: false,
        },
        breakpoints: {
            1366: {
                slidesPerView: 2,
            },
        },
    });
}

const swiperRightEl = document.querySelector(".swiper_right");
if (swiperRightEl) {
    new Swiper(".swiper_right", {
        modules: [Autoplay],
        loop: true,
        slidesPerView: "auto",
        spaceBetween: 24,
        speed: 800,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            reverseDirection: true
        },
    });
}

const projectSwiperEl = document.querySelector(".project_swiper");
if (projectSwiperEl) {
    const projectSwiper = new Swiper(".project_swiper", {
        modules: [Autoplay, Navigation],
        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        on: {
            init(swiper) {
                updateStudentInfo(swiper);
            },
            slideChange(swiper) {
                updateStudentInfo(swiper);
            },
        },
    });

    // ✅ CEK BUTTON ADA ATAU TIDAK
    const btnPrev = document.querySelector(".btn-prev");
    const btnNext = document.querySelector(".btn-next");

    if (btnPrev) {
        btnPrev.addEventListener("click", function () {
            projectSwiper.slidePrev();
        });
    }

    if (btnNext) {
        btnNext.addEventListener("click", function () {
            projectSwiper.slideNext();
        });
    }

    function updateStudentInfo(swiper) {
        const activeSlide = swiper.slides[swiper.activeIndex];
        const title = document.getElementById("students");
        const project = document.getElementById("project_type");

        if (!title || !project) return; // ✅ CEK DULU

        title.classList.add("opacity-0");
        project.classList.add("opacity-0");

        setTimeout(() => {
            title.innerText = `${activeSlide.dataset.name}, ${activeSlide.dataset.age}`;
            project.innerHTML = `<span class="block transform skew-x-6">${activeSlide.dataset.project}</span>`;

            title.classList.remove("opacity-0");
            project.classList.remove("opacity-0");
        }, 200);
    }
}