$(function () {
    $(".widget-slider-blogs-style-1 .blog-main").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        dots: false,
        infinite: true,
        asNavFor: ".widget-slider-blogs-style-1 .list-image-blogs",
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
    $(".widget-slider-blogs-style-1 .list-image-blogs").slick({
        asNavFor: ".widget-slider-blogs-style-1 .blog-main",
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        dots: false,
        infinite: true,
        focusOnSelect: true,
        speed: 400,
        autoplay: true,
        vertical: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    vertical: false,
                },
            },
        ],
    });
});
