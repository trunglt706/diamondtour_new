/*--------------------- Scroll */
var header = document.querySelector('.box-header');
window.onscroll = function() {
  // pageYOffset or scrollY
  if (window.pageYOffset > 50) {
    header.classList.add('sticky')
  } else {
    header.classList.remove('sticky')
  }
};
$(".scroll-top-sec>a").click(function() {
  var destination = $(this).attr('href');
  $('html,body').animate({
    scrollTop: $(destination).offset().top - 150},
    150);
  });
/*------------------------------------ Box Slider Home */
var carousel_home_swiper = new Swiper(".carousel-home-swiper", {
  loop: true,
  spaceBetween: 30,
  effect: "fade",
  slidesPerView: 1,
  autoplay: {
    delay: 10000,
    disableOnInteraction: false,
  },
});

/*------------------------------------ Box Destinations */
var destinations_swiper = new Swiper(".destinations-swiper", {
  loop: true,
  slidesPerView: 'auto',
  centeredSlides: true,
  spaceBetween: 15,
  initialSlide: 1,
  autoplay: {
    delay: 10000,
    disableOnInteraction: false,
  },
});
/*------------------------------------ Box Tour Home */
(function($) {
  $('.section-tour-home--content').isotope({
    itemSelector: '.th-grid-item',
    percentPosition: true,
    originLeft: true,
    masonry: {
      columnWidth: '.th-grid-sizer',
    }
  });
})(jQuery);
