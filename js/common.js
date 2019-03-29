$(function () {
    $('.multiple-select').multiselect({
        enableFiltering: true,
        includeSelectAllOption: true,
        maxHeight: 400,
        buttonWidth: '100%'
    });

    $(".tooltip-link").tooltip();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    $('#back-to-top').tooltip('show');
}());