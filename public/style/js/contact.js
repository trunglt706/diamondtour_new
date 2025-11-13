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

$(".btn-register").click(function () {
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
            `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span class="visually-hidden" role="status">Loading...</span>`
        );
    }
});
