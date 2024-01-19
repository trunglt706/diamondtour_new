$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// event confirm logout system
function confirmLogout() {
    if (confirm("Xác nhận thoát khỏi hệ thống?")) {
        location.href = urlLogout;
    }
    return;
}

// function show sniper from class element
function showSniper(elementClass) {
    var html =
        '<div class="text-center sniper-content"> <div class="spinner-border" role="status"></div> </div>';
    $(elementClass).append(html);
}

// function hide sniper from class element
function hideSniper(elementClass) {
    $(elementClass).closest(".card-body").find(".sniper-content").remove();
}

// function load data table
function loadTable(
    uri = "",
    currentPage = 1,
    tableElement = "#load-table",
    formElement = "#form-filter",
    otherFunction
) {
    uri = uri != "" ? uri : routeList;
    showSniper(".table-loading");
    var data = $(formElement).serialize();
    const url = uri + "?page=" + currentPage + "&" + data;
    $.get(url, function (rs) {
        hideSniper(".table-loading");
        $("button[type=submit]").removeAttr("disabled");
        $(".btn-reload").html('<i class="fas fa-sync"></i>');
        if (rs.status == 200) {
            $(tableElement).html(rs.data);
            $(".total-item").html(`(${formatNumber(rs?.total)})`);
            if (otherFunction) {
                otherFunction(rs);
            }
            const tooltipTriggerList = document.querySelectorAll(
                '[data-bs-toggle="tooltip"]'
            );
            const tooltipList = [...tooltipTriggerList].map(
                (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
            );
        } else {
            Toast.fire({
                icon: "error",
                title: rs.message,
            });
        }
    });
}

// function delete data table
function deleteData(id, url, title = "Xác nhận xóa dữ liệu này?") {
    if (confirm(title)) {
        showSniper(".table-loading");
        $.ajax({
            url: url,
            data: { id },
            success: function (rs) {
                hideSniper(".table-loading");
                if (rs.status == 200) {
                    filterTable();
                }
                Toast.fire({
                    icon: rs?.type,
                    title: rs.message,
                });
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                var err = eval("(" + XMLHttpRequest.responseText + ")");
                hideSniper(".table-loading");
                Toast.fire({
                    icon: "error",
                    title: err?.message
                        ? err?.message.split("!")[0]
                        : "Xóa dữ liệu lỗi!",
                });
            },
        });
    }
    return;
}

// load list notify in header
function loadNotify(urlLoadNotify) {
    $.ajax({
        url: urlLoadNotify,
        async: true,
        processData: false,
        contentType: false,
        type: "POST",
        success: function (rs) {
            if (rs.status == 200) {
                $(".notification .notify-total").text(rs?.data?.total);
                $(".notification .dropdown-notification").html(rs?.data?.list);
            }
            console.log(rs?.data?.total);
            const tooltipTriggerList = document.querySelectorAll(
                '[data-bs-toggle="tooltip"]'
            );
            const tooltipList = [...tooltipTriggerList].map(
                (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
            );
        },
    });
}

$(document).ready(function () {
    $(document).on("click", ".reload-data", function () {
        $(this).html(
            `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>`
        );
    });
    // event click to notify item
    $(document).on("click", ".notification-item", function (e) {
        e.preventDefault();
        const id = $(this).data("id");
        const status = $(this).data("status");
        if (!status) {
            updateNotification("one", id);
        } else {
            const href = $(".notification-item.item-" + id).attr("href");
            if (href && href != "#") {
                location.href = href;
            }
        }
    });
    // event click to view all notity
    $(document).on("click", ".view-all-notify", function () {
        if ($(".notification .notify-total").text() != "0") {
            updateNotification("all", 0, 0);
        }
    });
    // event click to button update data
    $(document).on("click", ".btn-update", function (e) {
        e.preventDefault();
        if (confirm("Xác nhận cập nhật dữ liệu?")) {
            $(this).html(
                `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Loading...</span>`
            );
            $('button[type="submit"]').trigger("click");
            showSniper(".card-main");
            return true;
        }
        return false;
    });
    // event click to input secret data: phone, email, ...
    $(document).on("click", ".edit-data", function (e) {
        e.preventDefault();
        const classElement = $(this).data("show");
        $("." + classElement)
            .removeAttr("disabled")
            .focus();
    });
});

// function update status of notify
function updateNotification(type = "one", id = "", status = 1) {
    $.post(
        urlUpdateNotification,
        {
            id: id,
            type: type,
        },
        function (data) {
            if (data?.status == 200) {
                let total = $(".notification .notify-total").text();
                if (data?.read == "all") {
                    $(".notification-item")
                        .removeClass("read-0")
                        .addClass("read-1");
                    total = 0;
                } else if (status) {
                    const href = $(".notification-item.item-" + id).attr(
                        "href"
                    );
                    if (href && href != "#") {
                        location.href = href;
                    } else {
                        $(".notification-item.item-" + id)
                            .removeClass("read-0")
                            .addClass("read-1");
                        total -= 1;
                    }
                }
                $(".switch-" + id).attr("disabled", true);
                $(".notification .notify-total").text(total);
            }
            Toast.fire({
                icon: data?.type,
                title: data?.message,
            });
        }
    );
}

// event update status of data table
function changeStatus(id) {
    $.post(
        routeUpdate,
        {
            id,
        },
        function (rs) {
            Toast.fire({
                icon: rs?.type,
                title: rs.message,
            });
        }
    );
}

// event create new data
const form_create = $("form#form-create");
if (form_create) {
    const action = form_create.attr("action");
    form_create.submit(function (e) {
        e.preventDefault();
        $("#addModal .btn-create").html(
            `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Loading...</span>`
        );
        const data = new FormData($(this)[0]);
        $.ajax({
            url: action,
            data: data,
            processData: false,
            contentType: false,
            type: "POST",
            success: function (rs) {
                $("#addModal .btn-create").html(`<i class="fas fa-plus"></i> Tạo mới`);
                $("button[type=submit]").removeAttr("disabled");
                if (rs.status == 200) {
                    loadTable();
                    if (rs?.uri) {
                        location.href = rs?.uri;
                    }
                    $(".btn-close").click();
                    form_create[0].reset();
                }
                Toast.fire({
                    icon: rs?.type,
                    title: rs.message,
                });
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                var err = eval("(" + XMLHttpRequest.responseText + ")");
                $("#addModal .btn-create").html(`<i class="fas fa-plus"></i> Tạo mới`);
                $("button[type=submit]").removeAttr("disabled");
                Toast.fire({
                    icon: "error",
                    title: err?.message
                        ? err?.message.split("!")[0]
                        : "Tạo mới lỗi!",
                });
            },
        });
    });
}

// event update form data table
const form_update = $("form#form-update");
if (form_update) {
    const action = form_update.attr("action");
    form_update.submit(function (e) {
        e.preventDefault();
        const data = new FormData($(this)[0]);
        $.ajax({
            url: action,
            data: data,
            processData: false,
            contentType: false,
            type: "POST",
            success: function (rs) {
                $("#editModal .btn-create").html(
                    `<i class="fas fa-save"></i> Cập nhật`
                );
                $("button[type=submit]").removeAttr("disabled");
                if (rs.status == 200) {
                    form_update[0].reset();
                    loadTable();
                    if (rs?.uri) {
                        location.href = rs?.uri;
                    }
                    $(".btn-close").click();
                }
                Toast.fire({
                    icon: rs?.type,
                    title: rs.message,
                });
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                var err = eval("(" + XMLHttpRequest.responseText + ")");
                $("#editModal .btn-create").html(
                    `<i class="fas fa-save"></i> Cập nhật`
                );
                $("button[type=submit]").removeAttr("disabled");
                Toast.fire({
                    icon: "error",
                    title: err?.message
                        ? err?.message.split("!")[0]
                        : "Cập nhật lỗi!",
                });
            },
        });
    });
}

function notifyDesktop(title, content, link = "", icon = "") {
    if (!window.Notification) {
        console.log("Browser does not support notifications.");
    } else {
        if (Notification.permission === "granted") {
            var notify = new Notification(title, {
                body: content,
                icon: icon,
            });
            if (link) {
                notify.onclick = function () {
                    location.href = link;
                };
            }
        }
    }
}

function initSelect2(
    element,
    placeholder,
    table,
    dropdownParent = "",
    where,
    lstCol = ["id", "name"]
) {
    var $where =
        typeof userId != "undefined"
            ? { status: "active", brand_id: brandId }
            : { status: "active" };
    $where = where ? where : $where;
    return $(element).select2({
        dropdownParent: dropdownParent,
        placeholder: placeholder,
        allowClear: true,
        ajax: {
            delay: 500,
            type: "POST",
            dataType: "json",
            url: routeSelect,
            processResults: function (data) {
                return {
                    results: $.map(data, function (obj) {
                        return {
                            id: obj.id,
                            text: `${obj.name}`,
                        };
                    }),
                };
            },
            data: function (params) {
                var query = {
                    search: params.term,
                    table: table,
                    lstCol: lstCol,
                    where: $where,
                };
                return query;
            },
        },
    });
}

$(document).on("change", ".previewImg", function (event) {
    var input = event.target;
    console.log($(".show-img").length);
    console.log($(this).closest(".show-img").find(".preview"));
    var img = $(".show-img").length
        ? $(this).closest(".show-img").find(".preview")
        : $(this).closest(".show").find(".preview");
    var reader = new FileReader();
    reader.onload = function () {
        img.attr("src", reader.result);
        img.css("display", "block");
    };
    reader.readAsDataURL(input.files[0]);
});

$(document).on("click", ".btn-trigger", function (event) {
    btnTrigger = $(this).attr("id");
});

$(document).on("click", ".btn-back", function (event) {
    if (btnTrigger) {
        $("#" + btnTrigger).trigger("click");
    }
});
