const selectPicker = $(".select-picker");
if (selectPicker.length) {
    selectPicker.select2();
}

$("form").submit(function () {
    const btn_submit = $(this).find('button[type="submit"]');
    const type = btn_submit.data("type") ?? "submit";
    if (type == "filter") {
        btn_submit.html(
            `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>`
        );
    } else {
        btn_submit.html(
            `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Loading...</span>`
        );
    }
    btn_submit.attr("disabled", true);
});
//hide search bar in select2
$(".filter-status").select2({
    minimumResultsForSearch: Infinity,
});
$(".filter-limit").select2({
    minimumResultsForSearch: Infinity,
});
$(".no-searchbar").select2({
    minimumResultsForSearch: Infinity,
});
function copyToClipboard(current_element, elementId) {
    var icon_copy = '<i class="ki-outline ki-copy fs-4 ms-1"></i>';
    var icon_copy_done =
        '<i class="ki-outline text-success ki-check fs-4 ms-1"></i>';

    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($("#" + elementId).text()).select();
    document.execCommand("copy");
    $temp.remove();
    current_element.innerHTML = icon_copy_done;
    setTimeout(function () {
        current_element.innerHTML = icon_copy;
    }, 3000);
}

function toogle_key(btn) {
    $(btn).parent().find("span.key-hide").toggle();
    $(btn).parent().find("span.key-show").toggle();
}

$(document).on("click", ".pagination a", function (event) {
    event.preventDefault();
    page = $(this).attr("href").split("page=")[1];
    filterTable(page);
});

$(".form-filter").on("change", function () {
    filterTable();
});
$(".form-filter.select-picker").on("sp-change", function () {
    filterTable();
});

$("#form-filter").submit(function (e) {
    $('button[type="submit"]').attr("disabled", true);
    e.preventDefault();
    loadTable();
});

function formatNumber(number, currency = "") {
    let _value = 0;
    if (number) {
        _value = Math.round(number, 2);
        _value = _value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    if (currency != "") {
        _value += " " + currency;
    }
    return _value;
}

function timeConverter(t) {
    var a = new Date(t * 1000);
    var today = new Date();
    var yesterday = new Date(Date.now() - 86400000);
    var year = a.getFullYear();
    var month = a.getMonth() + 1;
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var second = a.getSeconds();
    if (a.setHours(0, 0, 0, 0) == today.setHours(0, 0, 0, 0))
        return "Hôm nay, " + hour + ":" + min;
    else if (a.setHours(0, 0, 0, 0) == yesterday.setHours(0, 0, 0, 0))
        return "Hôm qua, " + hour + ":" + min;
    else if (year == today.getFullYear())
        return hour + ":" + min + ":" + second + " " + date + "/" + month;
    else
        return (
            hour +
            ":" +
            min +
            ":" +
            second +
            " " +
            date +
            "/" +
            month +
            "/" +
            year
        );
}

function uniqueArrayObject(array) {
    return array.filter(
        (obj, index, self) =>
            index === self.findIndex((t) => t.product_id === obj.product_id)
    );
}
function generateUUID() {
    return "xxxxxxxx-xxxxxxxx".replace(/[xy]/g, function (c) {
        const r = (Math.random() * 16) | 0;
        const v = c === "x" ? r : (r & 0x3) | 0x8;
        return v.toString(16);
    });
}

$(document).on("click", ".show-password", function (e) {
    e.preventDefault();
    var passElement = $(this).closest("div").find("input");
    const type = passElement.attr("type");
    if (type == "password") {
        passElement.attr("type", "text");
        $(this).html(`<i class="fas fa-eye-slash"></i>`);
    } else {
        passElement.attr("type", "password");
        $(this).html(`<i class="fas fa-eye"></i>`);
    }
});

$(document).on("click", ".show-secret-data", function (e) {
    e.preventDefault();
    const showData = $(this).closest("div").find(".show-data");
    const oldData = showData.text();
    const table = $(this).data("table");
    const id = $(this).data("id");
    const column = $(this).data("column");
    const thisClass = $(this).data("class");
    const currentElement = $(this);
    if (table && id && column) {
        $.post(
            routeGetSecretData,
            {
                id,
                table,
                column,
            },
            function (data) {
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(data).select();
                document.execCommand("copy");
                $temp.remove();
                showData.removeClass("d-none");
                showData.text(data);
                // Toast.fire({
                //     icon: "success",
                //     title: "Đã sao chép nội dung",
                // });
                if (thisClass != "d-none") {
                    currentElement.html(
                        `<i class="fas fa-check text-success"></i>`
                    );
                    setTimeout(() => {
                        showData.text(oldData);
                        currentElement.html('<i class="fas fa-clone"></i>');
                    }, 2000);
                }
                currentElement.addClass(thisClass);
            }
        );
    }
});
