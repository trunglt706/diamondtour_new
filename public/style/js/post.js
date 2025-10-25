$(function(){
    $('.box-post-detail-1').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        dots:true,
        infinite: true,
    });

    let post2 = $('.box-post-detail-2');

    post2.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        dots:false,
        infinite: true,
    });

    $('.box-post-2 .btn-first').on('click', function() {
        post2.slick('slickGoTo', 0);
        updateButtons();
      });
      
      $('.box-post-2 .btn-prev').on('click', function() {
        post2.slick('slickPrev');
        updateButtons();
      });
      
      $('.box-post-2 .btn-next').on('click', function() {
        post2.slick('slickNext');
        updateButtons();
      });
      
      $('.box-post-2 .btn-last').on('click', function() {
        post2.slick('slickGoTo', post2.slick('getSlick').slideCount - 1);
        updateButtons();
      });
      
      function updateButtons() {
        var currentSlide = post2.slick('slickCurrentSlide');
        var totalSlides = post2.slick('getSlick').slideCount;

        $('.btn-first').prop('disabled', currentSlide === 0);
        $('.btn-prev').prop('disabled', currentSlide === 0);
        $('.btn-next').prop('disabled', currentSlide === totalSlides - 1 || currentSlide === totalSlides - 2);
        $('.btn-last').prop('disabled', currentSlide === totalSlides - 1 || currentSlide === totalSlides - 2);
      }
});