// mobiscroll.setOptions({
//     locale: mobiscroll.localeEn, // Specify language like: locale: mobiscroll.localePl or omit setting to use default
//     theme: "ios", // Specify theme like: theme: 'ios' or omit setting to use default
//     themeVariant: "light", // More info about themeVariant: https://mobiscroll.com/docs/jquery/datepicker/api#opt-themeVariant
// });
$(function () {
    $(".widget_slider_banner").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        dots: false,
        infinite: true,
        autoplay: true,
        prevArrow:
            '<button type="button" class="slick-prev"><i class="fa-solid fa-arrow-left"></i></i></button>',
        nextArrow:
            '<button type="button" class="slick-next"<i class="fa-solid fa-arrow-right"></i></button>',
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

    $(".widget_post_style_1 .box-img").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        dots: false,
        infinite: true,
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
    $(".widget_feed_style_1 .box-list-item").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        dots: true,
        infinite: true,
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

    $(".widget_post_style_1.js_widget_post_style_1_4 .post-detail ").slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        dots: true,
        infinite: true,
        autoplay: true,
        prevArrow:
            '<button type="button" class="slick-prev"><i class="fa-solid fa-arrow-left"></i></i></button>',
        nextArrow:
            '<button type="button" class="slick-next"<i class="fa-solid fa-arrow-right"></i></button>',
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
    $(".widget_post_style_1.js_widget_post_style_1_5 .post-detail ").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        dots: true,
        infinite: true,
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

    $(".widget_item_1 .dropdown").on("click", function (e) {
        e.stopPropagation();
    });
});
