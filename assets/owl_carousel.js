import Swiper, {Navigation, Autoplay, Pagination, EffectFade} from "swiper";
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination'

const swiper = new Swiper('.owl-carousel', {
    modules: [ Autoplay, ],
    slidesPerView: 1,
    spaceBetween: 5,
    loop: true,
    grabCursor: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    keyboard: {
        enabled: true,
    },
    breakpoints: {
    // when window width is >= 320px
    // 576: {
    //   slidesPerView: 1,
    //   spaceBetween: 10
    // },
    // when window width is >= 480px
    767: {
      slidesPerView: 2,
      spaceBetween: 10
    },
    // when window width is >= 640px
    992: {
      slidesPerView: 4,
      spaceBetween: 15
    },

    1200: {
      slidesPerView: 5,
      spaceBetween: 5
    },
  }

})

const carousel = new Swiper('.headerCarousel', {
  modules: [ Navigation, Pagination, Autoplay, EffectFade ],
  slidesPerView: 1,
  // effect: "fade",
  loop: true,
  grabCursor: true,
  autoplay: {
    delay: 3800,
    disableOnInteraction: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  // fadeEffect: {

  //   crossFade: true
  // },
})

document.addEventListener("DOMContentLoaded", function(){
})