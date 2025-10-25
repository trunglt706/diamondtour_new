$(function () {
    $(".widget_post_style_1.js_widget_post_style_1_12 .post-detail ").slick({
        slidesToShow: 4,
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
    $(".widget_post_style_1.js_widget_post_style_1_13 .post-detail ").slick({
        slidesToShow: 2,
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

    var swiperImage = new Swiper(".widget_album_style_1 .mySwiper", {
        effect: "coverflow",
        coverflowEffect: {
            rotate: 20,
            slideShadows: true,
        },
    });

    var swiperContent = new Swiper(".widget_album_style_1 .myContentSwiper", {
        navigation: {
            nextEl: ".widget_album_style_1 .button-next",
            prevEl: ".widget_album_style_1 .button-prev",
        },
    });
    swiperImage.controller.control = swiperContent;
    swiperContent.controller.control = swiperImage;

    // video

    $(".box-video").click(function () {
        $("iframe", this)[0].src += "&amp;autoplay=1";
        $(this).addClass("open");
    });

    var feedbackContentSwiper = new Swiper(
        ".widget_feedback_style_2 .feedbackContentSwiper",
        {
            navigation: {
                nextEl: ".widget_feedback_style_2 .button-next",
                prevEl: ".widget_feedback_style_2 .button-prev",
            },
        }
    );

    var feedbackAvaterSwiper = new Swiper(
        ".widget_feedback_style_2 .feedbackAvaterSwiper",
        {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            loop: true,
            slidesPerView: "1",
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 4,
                slideShadows: false,
            },
            autoplay: {
                delay: 3000,
            },
            spaceBetween: 0,
            keyboard: {
                enabled: true,
            },
            mousewheel: {
                thresholdDelta: 70,
            },
            initialSlide: 0,
            on: {
                click(event) {
                    feedbackAvaterSwiper.slideTo(this.clickedIndex);
                },
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 1,
                },
            },
        }
    );

    feedbackContentSwiper.controller.control = feedbackAvaterSwiper;
    feedbackAvaterSwiper.controller.control = feedbackContentSwiper;

    $(".widget_slider_banner_2").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        dots: false,
        infinite: true,
        asNavFor: ".widget_slider .list-item",
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
    $(".widget_slider .list-item").slick({
        asNavFor: ".widget_slider_banner_2",
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        dots: false,
        infinite: true,
        vertical: true,
        focusOnSelect: true,
        speed: 400,
        autoplay: true,
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

    var swiperImage = new Swiper(".widget_about_style_3 .imgSwiper", {
        slidesPerView: 1,
        loop: true,
        // autoplay: true,
        effect: "coverflow",
        coverflowEffect: {
            rotate: 20,
            slideShadows: true,
        },
        prevArrow:
            '<button type="button" class="slick-prev"><i class="fa-solid fa-arrow-left"></i></i></button>',
        nextArrow:
            '<button type="button" class="slick-next"<i class="fa-solid fa-arrow-right"></i></button>',
        breakpoints: {
            768: {
                slidesPerView: 1,
            },
            480: {
                slidesPerView: 1,
            },
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        on: {
            click(event) {
                swiperImage.slideTo(this.clickedIndex);
            },
        },
    });
});
