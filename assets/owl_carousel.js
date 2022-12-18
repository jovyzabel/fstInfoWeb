import Swiper, {Navigation, Autoplay} from "swiper";
import 'swiper/css';
import 'swiper/css/navigation';

const swiper = new Swiper('.owl-carousel', {
    modules: [ Navigation, Autoplay ],
    slidesPerView: 5,
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    spaceBetween: 15,
    keyboard: {
        enabled: true,
    },
    grabCursor: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
})
document.addEventListener("DOMContentLoaded", function(){
})