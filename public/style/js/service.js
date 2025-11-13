$(function () {
    function initSwiper(container) {
        return new Swiper(container, {
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
                nextEl: `${container} .swiper-button-next`,
                prevEl: `${container} .swiper-button-prev`,
            },
        });
    }
    const swiper1 = initSwiper(".widget_service_style_3 .box-1 .swiper");
    const swiper2 = initSwiper(".widget_service_style_3 .box-2 .swiper");
    const swiper3 = initSwiper(".widget_service_style_3 .box-3 .swiper");
    const swiper4 = initSwiper(".widget_service_style_3 .box-4 .swiper");

    $(".btn-submit").click(function () {
        let form = $(this).closest("form"); // Lấy form gần nhất
        let hasEmptyRequiredFields = false;
        form.find("input[required], select[required], textarea[required]").each(
            function () {
                if ($(this).val() === "") {
                    hasEmptyRequiredFields = true;
                }
            }
        );
        if (!hasEmptyRequiredFields) {
            $(this).html(
                `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">Loading...</span>`
            );
        }
    });
});
