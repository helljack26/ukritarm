$(document).ready(function () {

    $(".form_col_item_input").each(function () {
        $(this).val().length > 0 && $(this).next("label").addClass('form_col_item_label_active')
    });

    // Shift label if input not empty
    $('.form_col_item_input').on('input change', function (e) {
        const thisValue = $(this).val();

        if (thisValue.length > 0) {
            $(this).next("label").addClass('form_col_item_label_active')
        } else {
            $(this).next("label").removeClass('form_col_item_label_active')
        }
    });
    $('.form_col_item_input').on('focus', function (e) {
        if ($(this).val().length === 0) {
            $(this).next("label").addClass('form_col_item_label_active')
        }
    });
    $('.form_col_item_input').on('blur', function (e) {
        if ($(this).val().length === 0) {
            $(this).next("label").removeClass('form_col_item_label_active')
        }
    });

});