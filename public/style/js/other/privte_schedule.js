$(function () {
    "use strict";
    var e = document.querySelectorAll(".bs-stepper"),
        n = $(".select2"),
        i = document.querySelector(".horizontal-wizard-example");
    if (void 0 !== typeof e && null !== e)
        for (var l = 0; l < e.length; ++l)
            e[l].addEventListener("show.bs-stepper", function (e) {
                for (
                    var n = e.detail.indexStep,
                        i = $(e.target).find(".step").length - 1,
                        r = $(e.target).find(".step"),
                        t = 0;
                    t < n;
                    t++
                ) {
                    r[t].classList.add("crossed");
                    for (var o = n; o < i; o++)
                        r[o].classList.remove("crossed");
                }
                if (0 == e.detail.to) {
                    for (var l = n; l < i; l++)
                        r[l].classList.remove("crossed");
                    r[0].classList.remove("crossed");
                }
            });
    if (
        (n.each(function () {
            var e = $(this);
            e.wrap('<div class="position-relative"></div>'),
                e.select2({
                    placeholder: "-- Chọn --",
                    dropdownParent: e.parent(),
                });
        }),
        void 0 !== typeof i && null !== i)
    ) {
        var d = new Stepper(i);
        $(i)
            .find(".btn-next")
            .each(function () {
                $(this).on("click", function (e) {
                    d.next();
                });
            }),
            $(i)
                .find(".btn-prev")
                .on("click", function () {
                    d.previous();
                });
    }
});

$(document).on("change", "#time_tour", function (e) {
    let get_value = $(this).val();
    if (get_value === "calendar") {
        $(this)
            .closest("#select_time_start")
            .removeClass("row-cols-md-1")
            .addClass("row-cols-md-2");
        $(this)
            .closest("#select_time_start")
            .find("#select_time_start_custom")
            .removeClass("d-none");
    } else {
        $(this)
            .closest("#select_time_start")
            .removeClass("row-cols-md-2")
            .addClass("row-cols-md-1");
        $(this)
            .closest("#select_time_start")
            .find("#select_time_start_custom")
            .addClass("d-none");
    }
});

$(document).on("change", "#someone-select", function (e) {
    let get_value = $(this).val();
    if (get_value !== "other") {
        $(this)
            .closest("#select_go_with_someone")
            .removeClass("row-cols-md-2")
            .addClass("row-cols-md-1");
        $(this)
            .closest("#select_go_with_someone")
            .find("#someone_custom")
            .addClass("d-none");
    } else {
        $(this)
            .closest("#select_go_with_someone")
            .removeClass("row-cols-md-1")
            .addClass("row-cols-md-2");
        $(this)
            .closest("#select_go_with_someone")
            .find("#someone_custom")
            .removeClass("d-none");
    }
});

$(document).on("change", "#place_start-select", function (e) {
    let get_value = $(this).val();
    if (get_value !== "other") {
        $(this)
            .closest("#place_start")
            .removeClass("row-cols-md-2")
            .addClass("row-cols-md-1");
        $(this)
            .closest("#place_start")
            .find("#place_start_custom")
            .addClass("d-none");
    } else {
        $(this)
            .closest("#place_start")
            .removeClass("row-cols-md-1")
            .addClass("row-cols-md-2");
        $(this)
            .closest("#place_start")
            .find("#place_start_custom")
            .removeClass("d-none");
    }
});

$(document).on("change", 'input[name="choose_date_number"]', function (e) {
    let get_id = $(this).attr("id");
    if (get_id == "expected_date_number") {
        $(this)
            .closest("#set-day-plan")
            .removeClass("row-cols-md-1")
            .addClass("row-cols-md-2");
        $(this)
            .closest("#set-day-plan")
            .find("#col-day-plan")
            .removeClass("d-none");
    } else {
        $(this)
            .closest("#set-day-plan")
            .removeClass("row-cols-md-2")
            .addClass("row-cols-md-1");
        $(this)
            .closest("#set-day-plan")
            .find("#col-day-plan")
            .addClass("d-none");
    }
});

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

$(".btn-prev").click(function () {
    window.scrollTo({
        top: 200,
    });
    return false;
});

$(".btn-next").click(function () {
    window.scrollTo({
        top: 200,
    });
    return false;
});
