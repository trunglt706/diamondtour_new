Fancybox.bind("[data-fancybox]", {
    l10n: Fancybox.l10n.de,
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
