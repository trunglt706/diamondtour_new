/*--------------------- Scroll */
var header = document.querySelector(".box-header");
window.onscroll = function () {
    // pageYOffset or scrollY
    if (window.pageYOffset > 50) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
};
$(".scroll-top-sec>a").click(function () {
    var destination = $(this).attr("href");
    $("html,body").animate(
        {
            scrollTop: $(destination).offset().top - 150,
        },
        150
    );
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
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 15,
    initialSlide: 1,
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    },
});
/*------------------------------------ Blog Slider Swiper */
var blog_slider_swiper = new Swiper(".blog-slider-swiper", {
    loop: true,
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 5,
    initialSlide: 1,
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    },
});
/*------------------------------------ testimonial Slider Swiper */
var blog_slider_swiper = new Swiper(".testimonial-slider-swiper", {
    loop: true,
    spaceBetween: 30,
    slidesPerView: 1,
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    },
});
/*------------------------------------ Box Tour Home */
(function ($) {
    $(".section-tour-home--content").isotope({
        itemSelector: ".th-grid-item",
        percentPosition: true,
        originLeft: true,
        masonry: {
            columnWidth: ".th-grid-sizer",
        },
    });
})(jQuery);
/*------------------------------------ Box Blog Page */
(function ($) {
    $(".section-blog-page--content").isotope({
        itemSelector: ".blog-grid-item",
        percentPosition: true,
        originLeft: true,
        masonry: {
            columnWidth: ".blog-grid-sizer",
        },
    });
})(jQuery);
/*------------------------------------ Box Slider Home */
(function ($) {
    if ($(".block-portfolio-gallery-container").length > 0) {
        $(".discovery-home-item").each(function (index, el) {
            let get_data_tab = $(this).attr("data-tab");
            if (index === 0) {
                $(this).addClass("current-item");
                $(".gallery-items #" + get_data_tab).addClass("current-item");
            }
        });

        $(document).on("mouseenter", ".discovery-home-item", function (e) {
            $(".discovery-home-item").each(function (index, el) {
                let get_data_tab = $(this).attr("data-tab");
                $(this).removeClass("current-item");
                $(".gallery-items #" + get_data_tab).removeClass(
                    "current-item"
                );
            });
            let get_data_tab = $(this).attr("data-tab");
            $(this).addClass("current-item");
            $(".gallery-items #" + get_data_tab).addClass("current-item");
        });
    }
})(jQuery);
