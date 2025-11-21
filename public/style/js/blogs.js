$(function(){
  $('.widget-blog-style-2 .list-blogs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    fade: false,
    dots:false,
    infinite: true,
    asNavFor: '.widget-blog-style-2 .list-item',
     responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
  });
  $('.widget-blog-style-2 .list-item').slick({
    asNavFor: '.widget-blog-style-2 .list-blogs',
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    fade: false,
    dots:false,
    infinite: true,
      focusOnSelect: true,
      speed: 400,
    autoplay: true,
  });
    $('.widget-blog-style-2 .navigation .prev').on('click', function() {
      $('.widget-blog-style-2 .list-blogs').slick('slickPrev');
      updateButtons();
    });
    
    $('.widget-blog-style-2 .navigation .next').on('click', function() {
      $('.widget-blog-style-2 .list-blogs').slick('slickNext');
      updateButtons();
    });
    
    function updateButtons() {
      var currentSlide = $('.widget-blog-style-2 .list-blogs').slick('slickCurrentSlide');
      var totalSlides = $('.widget-blog-style-2 .list-blogs').slick('getSlick').slideCount;

      $('.widget-blog-style-2 .navigation .prev').prop('disabled', currentSlide === 0);
      $('.widget-blog-style-2 .navigation .next').prop('disabled', currentSlide === totalSlides - 1);
    }


    const  widget_blog_3 = new Swiper(".widget-blog-style-3 .swiper", {
      grabCursor: true,
      speed: 500,
      effect: "slide",
      loop: true,
      slidesPerView: 3,
      spaceBetween: 20,
      mousewheel: {
        invert: false,
        sensitivity: 1,
      },
      navigation: {
        nextEl: '.widget-blog-style-3 .swiper-button-next',
        prevEl: '.widget-blog-style-3 .swiper-button-prev',
      },
      breakpoints: {
        320: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
    });
    
    widget_blog_3.enable();

    const  widget_blog_4 = new Swiper(".widget-blog-style-4 .swiper", {
      grabCursor: true,
      speed: 500,
      effect: "slide",
      loop: true,
      slidesPerView: 3,
      spaceBetween: 20,
      mousewheel: {
        invert: false,
        sensitivity: 1,
      },
      navigation: {
        nextEl: '.widget-blog-style-4 .swiper-button-next',
        prevEl: '.widget-blog-style-4 .swiper-button-prev',
      },
      pagination: {
        el: '.widget-blog-style-4 .swiper-pagination',
        clickable: true,
        renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + '</span>'; // Hiển thị số cho dots
        },
    },breakpoints: {
      320: {
          slidesPerView: 1,
      },
      768: {
          slidesPerView: 2, 
      },
      1024: {
          slidesPerView: 3, 
      },
  },
    });
    
    widget_blog_4.enable();
  

});