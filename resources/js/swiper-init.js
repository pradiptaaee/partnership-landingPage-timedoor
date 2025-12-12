import Swiper from "swiper";
import 'swiper/css';

var swiper_left = new Swiper(".swiperLeft", {
    loop: true,
    autoplay: {
        delay: 2800,
        disableOnInteraction: false,
        // reverseDirection: true
    },
});

var swiper_right = new Swiper(".swiperRight", {
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
        reverseDirection: true
    }
});

var project_swiper = new Swiper(".projectSwiper", {
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    }
})

document.querySelector(".btn-prev").addEventListener("click", function () {
    project_swiper.slidePrev();
});

document.querySelector(".btn-next").addEventListener("click", function () {
    project_swiper.slideNext();
});
