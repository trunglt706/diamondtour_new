$(function(){


    let feedback2 = $('.widget_feedback_style_2 .list-item');

    feedback2.slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        dots:true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 1000,
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

      
      $('.widget_feedback_style_2 .box-arrow .btn-prev').on('click', function() {
        feedback2.slick('slickPrev');
        updateButtons();
      });
      
      $('.widget_feedback_style_2 .box-arrow .btn-next').on('click', function() {
        feedback2.slick('slickNext');
        updateButtons();
      });
      
      function updateButtons() {
        var currentSlide = feedback2.slick('slickCurrentSlide');
        var totalSlides = feedback2.slick('getSlick').slideCount;

        $('.btn-prev').prop('disabled', currentSlide === 0);
        $('.btn-next').prop('disabled', currentSlide === totalSlides - 1 || currentSlide === totalSlides - 2);
      }
});