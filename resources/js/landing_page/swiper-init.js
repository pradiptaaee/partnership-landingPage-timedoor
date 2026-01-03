import Swiper from "swiper";
import { Autoplay, Navigation} from "swiper/modules";
import 'swiper/css';

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
        1024: {
            slidesPerView: 2, 
        },
    },
});

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

    // breakpoints: {
    //     1024: {
    //         slidesPerView: 2, 
    //     },
    // },
});

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

document.querySelector(".btn-prev").addEventListener("click", function () {
    projectSwiper.slidePrev();
});

document.querySelector(".btn-next").addEventListener("click", function () {
    projectSwiper.slideNext();
});

function updateStudentInfo(swiper) {
    const activeSlide = swiper.slides[swiper.activeIndex];

    const title = document.getElementById("students");
    const project = document.getElementById("project_type");

    title.classList.add("opacity-0");
    project.classList.add("opacity-0");

    setTimeout(() => {
        title.innerText = `${activeSlide.dataset.name}, ${activeSlide.dataset.age}`;
        project.innerHTML = `<span class="block transform skew-x-6">${activeSlide.dataset.project}</span>`;

        title.classList.remove("opacity-0");
        project.classList.remove("opacity-0");
    }, 200);
}
