console.log("Hello JS");

// jQuery(document).ready(function($){
//   $(".owl-carousel").owlCarousel({
//     loop: true,
//     margin: 10,
//     nav: true,
//     dots: true,
//     autoplay: true,
//     autoplayTimeout: 3000,
//     items: 1
//   });
// });

document.addEventListener("DOMContentLoaded", function () {
  const swiper = new Swiper(".mySwiper", {
    speed: 1000, // Thời gian chuyển slide (ms) -> càng cao càng mượt
    effect: "fade", // Có thể đổi sang 'slide', 'cube', 'coverflow', 'flip'
    grabCursor: true, // Con trỏ dạng bàn tay khi rê
    loop: true, // vòng lặp vô hạn
    spaceBetween: 20, // khoảng cách giữa các slide
    slidesPerView: 1, // số slide hiển thị
    autoplay: {
      delay: 3000, // delay 3s
      disableOnInteraction: false, // tiếp tục chạy sau khi người dùng tương tác
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    // breakpoints: {
    //   0:     { slidesPerView: 1 },
    //   640:   { slidesPerView: 2 },
    //   768:   { slidesPerView: 3 },
    //   1024:  { slidesPerView: 4 }
    // }
  });
});
