$(document).ready(function () {
    $(window).resize(function () {
        let width = $(window).width();
        if(width >= 991 && width <=1366) {
            $('#box-container').removeClass('container');
            $('#box-container').addClass('container-fluid');
        } else {
            $('#box-container').removeClass('container-fluid');
            $('#box-container').addClass('container');
        }
    });
});