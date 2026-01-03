import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

// 1. Swiper Banner (Kiri)
const swiperLeft = new Swiper(".swiperLeft", {
    loop: true,
    autoplay: {
        delay: 2800,
        disableOnInteraction: false,
    },
});

// 2. Swiper Testimoni (Kanan)
const swiperRight = new Swiper(".swiperRight", {
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
        reverseDirection: true
    }
});

// 3. Swiper Student Project (YANG KITA PERBAIKI)
const projectSwiper = new Swiper(".projectSwiper", {
    loop: true,
    effect: 'slide', // atau 'coverflow'/'cards' sesuai selera
    spaceBetween: 20,
    autoplay: {
        delay: 4000, // Ganti slide tiap 4 detik
        disableOnInteraction: false,
    },
    // Hubungkan tombol custom secara native
    navigation: {
        nextEl: ".btn-next",
        prevEl: ".btn-prev",
    },
    // EVENT LISTENER: Ini otak yang mengubah teks
    on: {
        slideChange: function () {
            // 1. Ambil elemen slide yang sedang aktif
            // (Kita pakai this.activeIndex karena loop:true membuat duplikat slide)
            const activeSlide = this.slides[this.activeIndex];

            if (activeSlide) {
                // 2. Ambil data dari atribut HTML 'data-student' & 'data-type'
                const studentName = activeSlide.getAttribute('data-student');
                const projectType = activeSlide.getAttribute('data-type');

                // 3. Cari elemen teks di HTML berdasarkan ID
                const nameDisplay = document.getElementById('student-name-display');
                const typeDisplay = document.getElementById('project-type-display');

                // 4. Update teksnya jika elemen ditemukan
                if (nameDisplay && studentName) {
                    nameDisplay.textContent = studentName;
                }
                
                if (typeDisplay && projectType) {
                    typeDisplay.textContent = projectType;
                }
            }
        },
    },
});

