let swiperCards = new Swiper(".pro-container", {
    loop: true,
    spaceBetween: 10,
    grabCursor: true,
    autoplay:{delay:1500},

    // pagination: {
    //   el: ".swiper-pagination2",
    //   clickable: true,
    //   dynamicBullets: true,
    // },
  
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  
    breakpoints:{
      600: {
        slidesPerView: 2,
      },
      968: {
        slidesPerView: 6,
      },
    },
});
