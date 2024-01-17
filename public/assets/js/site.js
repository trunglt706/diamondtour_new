
function appSelectPicker(element) {

    if (typeof(element) == 'undefined') {
        element = $("body").find('select.selectpicker');
    }

    if (element.length) {
        element.selectpicker({
            showSubtext: true
        });
    }
}
function appDatepicker(options) {

    jQuery.datetimepicker.setLocale('vi');

    var defaults = {
        date_format: 'd/m/Y',
        time_format: '24',
        week_start: 1,
        date_picker_selector: '.datepicker',
        date_time_picker_selector: '.datetimepicker',
    }

    var settings = $.extend({}, defaults, options);

    var datepickers = typeof(settings.element_date) != 'undefined' ? settings.element_date : $(settings.date_picker_selector);
    var datetimepickers = typeof(settings.element_time) != 'undefined' ? settings.element_time : $(settings.date_time_picker_selector);

    if (datetimepickers.length === 0 && datepickers.length === 0) {
        return;
    }

    // Datepicker without time
    $.each(datepickers, function() {
        var that = $(this);

        var opt = {
            timepicker: false,
            scrollInput: false,
            lazyInit: true,
            format: settings.date_format,
            dayOfWeekStart: settings.week_start,
        };

        // Check in case the input have date-end-date or date-min-date
        var max_date = that.attr('data-date-end-date');
        var min_date = that.attr('data-date-min-date');
        var lazy = that.attr('data-lazy');

        if (lazy) {
            opt.lazyInit = lazy == 'true';
        }

        if (max_date) {
            opt.maxDate = max_date;
        }

        if (min_date) {
            opt.minDate = min_date;
        }

        // Init the picker
        that.datetimepicker(opt);

        that.parents('.form-group').find('.calendar-icon').on('click', function() {
            that.focus();
            that.trigger('open.xdsoft');
        });
    });

    // Datepicker with time
    $.each(datetimepickers, function() {
        var that = $(this);
        var opt_time = {
            lazyInit: true,
            scrollInput: false,
            validateOnBlur: false,
            dayOfWeekStart: settings.week_start
        };
        if (settings.time_format == 24) {
            opt_time.format = settings.date_format + ' H:i';
        } else {
            opt_time.format = settings.date_format + ' g:i A';
            opt_time.formatTime = 'g:i A';
        }
        // Check in case the input have date-end-date or date-min-date
        var max_date = that.attr('data-date-end-date');
        var min_date = that.attr('data-date-min-date');
        var lazy = that.attr('data-lazy');

        if (lazy) {
            opt.lazyInit = lazy == 'true';
        }

        if (max_date) {
            opt_time.maxDate = max_date;
        }

        if (min_date) {
            opt_time.minDate = min_date;
        }
        // Init the picker
        that.datetimepicker(opt_time);

        that.parents('.form-group').find('.calendar-icon').on('click', function() {
            that.focus();
            that.trigger('open.xdsoft');
        });
    });
}
function init_selectpicker() {
  appSelectPicker();
}
function init_datepicker(element_date, element_time) {
  appDatepicker({
    element_date: element_date,
    element_time: element_time,
  });
}
/*--------------------- Scroll */
var header = document.querySelector(".box-header");
var myBacktoTop = document.getElementById("btn-back-to-top");
window.onscroll = function () {
    // pageYOffset or scrollY
    if (window.pageYOffset > 50) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }

    scrollFunction();
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
function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    myBacktoTop.style.display = "block";
  } else {
    myBacktoTop.style.display = "none";
  }
}
function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
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
var carousel_list_schedule_swiper = new Swiper(".carousel-list-schedule-swiper", {
    loop: true,
    spaceBetween: 30,
    slidesPerView: 1,
    pagination: {
      el: ".swiper-pagination",
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
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
/*------------------------------------ Box Tour Page */
(function ($) {
    $(".section-tour--content").isotope({
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

    init_selectpicker();
    init_datepicker();

    myBacktoTop.addEventListener("click", backToTop);

})(jQuery);
