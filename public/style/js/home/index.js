$(function () {
    $('input[name="daterange"]').daterangepicker(
        {
            opens: "left",
            startDate: startDate ? moment(startDate) : moment(),
            endDate: endDate ? moment(endDate) : moment().add(7, "days"),
        },
        function (start, end, label) {
            const startDate = start.format("YYYY-MM-DD");
            const endDate = end.format("YYYY-MM-DD");
            location.href = `${url}?t=tour&start=${startDate}&end=${endDate}`;
        }
    );

    // event click btn-submit-daterange
    $(".btn-submit-daterange").on("click", function () {
        const daterange = $('input[name="daterange"]').val();
        const dates = daterange.split(" - ");
        const startDate = moment(dates[0], "MM/DD/YYYY").format("YYYY-MM-DD");
        const endDate = moment(dates[1], "MM/DD/YYYY").format("YYYY-MM-DD");
        location.href = `${url}?t=tour&start=${startDate}&end=${endDate}`;
    });
});
