$(document).ready(function () {
    $(window).resize(function () {
        let width = $(window).width();
        if (width >= 991 && width <= 1366) {
            $("#box-container").removeClass("container");
            $("#box-container").addClass("container-fluid");
        } else {
            $("#box-container").removeClass("container-fluid");
            $("#box-container").addClass("container");
        }
    });

    $('input[name="daterange"]').daterangepicker(
        {
            opens: "left",
        },
        function (start, end) {
            const startDate = start.format("YYYY-MM-DD");
            const endDate = end.format("YYYY-MM-DD");
            const url = `/search?t=tour&start=${startDate}&end=${endDate}`;
            location.href = url;
        }
    );

    const $lazyImages = $('img[loading="lazy"][data-src]');

    function loadImage($img) {
        const src = $img.data("src");
        if (!src) return;

        const highRes = new Image();
        highRes.src = src;
        highRes.onload = function () {
            $img.attr("src", src).addClass("loaded");
        };

        $img.removeAttr("data-src"); // tránh load lại
    }

    function lazyLoad() {
        $lazyImages.each(function () {
            const $img = $(this);
            loadImage($img);
        });
    }

    // Gọi 1 lần đầu
    // lazyLoad();

    const Toast = Swal.mixin({
        toast: true,
        position: "bottom-end",
        showConfirmButton: false,
        timer: 3000,
    });
});
