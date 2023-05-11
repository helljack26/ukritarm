$(document).ready(function () {

    // Contact num mask input init
    $("#contactno").mask("+38 (999) 99-99-999");

    // Show password action
    const showPassword = (buttonClass, inputClass) => {
        $(buttonClass).click(function () {
            if ($(inputClass).attr("type") == 'password') {
                $(inputClass).attr("type", "text");
            } else {
                $(inputClass).attr("type", "password");
            }
        });
    }

    showPassword('#show-pass', '#password');
    showPassword('#show-pass2', '#confirmpassword');
    showPassword('#show-pass3', '#pass_login');

    $(".account_col_left_header, .account_col_right_header").click(function () {
        const thisClass = $(this).attr('class');

        const isLoginBtn = thisClass.includes('account_col_right_header');
        if (isLoginBtn) {
            $(this).addClass("account_headers_active");
            $('.account_col_left_header').removeClass("account_headers_active");
            $('.account_col_left_form').hide();
            $('.account_col_right_form').show();
        } else {
            $(this).addClass("account_headers_active");
            $('.account_col_right_header').removeClass("account_headers_active");
            $('.account_col_left_form').show();
            $('.account_col_right_form').hide();
        }
    })

    // Password recovery 
    let isOpenPassRestorePopup = false;

    const openPassRestorePopup = () => {
        $("#pass_restore_popup").fadeIn();
        isOpenPassRestorePopup = true;
    }
    const closePassRestorePopup = () => {
        $("#pass_restore_popup").fadeOut();
        setTimeout(() => {
            $("#pass_restore_popup_content_form_input").val('');
            $("#hidden_novaposhta_city_block").html('');
            $('.pass_restore_popup_content_form_success').hide();

            isOpenPassRestorePopup = false;
        }, 200);
    }

    // Open popup
    $("#pass_restore_open").click(function () {
        openPassRestorePopup();
    });
    // Close popup
    $(".pass_restore_popup_content_header_close, .pass_restore_popup_bg").click(function () {
        closePassRestorePopup()
    });

    $(document).keyup(function (e) {
        if (e.key === "Escape" && isOpenPassRestorePopup === true) {
            isOpenPassRestorePopup = false;
            closePassRestorePopup()
        }
    });

    const sendPassRecovery = () => {
        const userEmail = $("#pass_restore_popup_content_form_input").val().trim();

        $.ajax({
            type: "POST",
            url: '/functions/send_pass_recovery.php',
            data: {
                restore_email: userEmail
            },
            success: function (data) {
                console.log(data);
                if (data == 0) {
                    $('.pass_restore_popup_content_form_error').text('Користувача з таким email не знайдено');
                } else {
                    $('.pass_restore_popup_content_form_error').text('');
                    $('.pass_restore_popup_content_form_success').fadeIn();
                }
            },
        });
    }

    $(".pass_restore_popup_content_form_button").click(function () {
        sendPassRecovery()
    });
    $("#pass_restore_popup_content_form_input").on("keyup", function (e) {
        if (e.keyCode === 13 && $(this).val().length > 0) sendPassRecovery()
    });
});

function valid() {
    if (document.register.password.value != document.register.confirmpassword.value) {
        $("#form_col_item_pass_error").text("Паролі не співпадають");
        document.register.confirmpassword.focus();
        return false;
    } else {
        $("#form_col_item_pass_error").text("");
    }
    return true;
}

function userAvailability() {
    $("#loaderIcon").show();
    $.ajax({
        url: "functions/check_is_exist_email.php",
        data: 'email=' + $("#email").val(),
        type: "POST",
        success: function (data) {
            if (data == "1") {
                $("#form_col_item_availability").text('Email вже існує');
                $('#submit').prop('disabled', true);
            }

            if (data == "0") {
                $("#form_col_item_availability").text('Email доступний для реєстрації');
                $('#submit').prop('disabled', false);

            }
            $("#loaderIcon").hide();
        }
    });
}