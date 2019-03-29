$(function () {
    $('.multiple-select').multiselect({
        enableFiltering: true,
        includeSelectAllOption: true,
        maxHeight: 400,
        buttonWidth: '100%',
        buttonText: function (options, select) {
            return 'Выберите номер договора!';
        }
    });

    $(".tooltip-link").tooltip();
}());