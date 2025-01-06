$(function () {
    const widget_about_4 = new Swiper(".widget_about_4 .box-right .swiper", {
        grabCursor: true,
        speed: 500,
        effect: "slide",
        loop: true,
        mousewheel: {
            invert: false,
            sensitivity: 1,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    widget_about_4.enable();
});
