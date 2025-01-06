$(function () {
    const counters = document.querySelectorAll(".widget_item_2 .counter");

    counters.forEach((counter) => {
        counter.innerText = "0";
        const updateCounter = () => {
            const target = +counter.getAttribute("data-target");
            const count = +counter.innerText;
            const increment = target / 200;
            if (count < target) {
                counter.innerText = `${Math.ceil(count + increment)}`;
                setTimeout(updateCounter, 1);
            } else counter.innerText = target;
        };
        updateCounter();
    });

    let swiper = new Swiper(".widget_album_like .swiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        spaceBetween: 0,
        coverflowEffect: {
            rotate: 60,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
            scale: 0.9,
        },
        loop: true,
        navigation: {
            nextEl: ".widget_album_like .swiper-button-next",
            prevEl: ".widget_album_like .swiper-button-prev",
        },
        pagination: {
            el: ".widget_album_like .swiper-pagination",
            clickable: true,
        },
    });

    $(".widget_tour_style_2 #myTab").slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        dots: true,
        infinite: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    $(".widget_tour_style_2 #myTabContent #item1-content").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: false,
        dots: true,
        infinite: true,
        loop: true,
        navigation: {
            nextEl: ".widget_tour_style_2 .swiper-button-next",
            prevEl: ".widget_tour_style_2 .swiper-button-prev",
        },
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
        customPaging: function (slider, i) {
            return "<button>" + (i + 1) + "</button>";
        },
    });

    const swiper_about_7 = new Swiper(".widget_about_7 .swiper", {
        slidesPerView: "auto",
        spaceBetween: 0,
        autoplay: true,
        loop: true,
        navigation: {
            nextEl: ".widget_about_7 .swiper-button-next",
            prevEl: ".widget_about_7 .swiper-button-prev",
        },
    });
});
