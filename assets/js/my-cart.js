const emailRefexp =
    /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
var disableSubmit = true;

var yurydychna_osoba = 0;

var delivery = "";
var delivery_type = 'Самовивіз зі складу';

var paymetd_method = "Готівкою або картою при отриманні";

$(document).ready(function () {

    // Init phone masks
    $("#fiz_phone, #yurydychna_phone").mask("+38 (999) 99-99-999");

    const checkUserEmail = (arg_email) => {
        let disableSubmit
        $.ajax({
            type: "POST",
            url: "functions/check_is_exist_email.php",
            data: {
                email: arg_email,
                isMyCart: true,
            },
            success: function (result) {
                if (yurydychna_osoba == 1) {
                    $(".yurydychni_email").removeClass('required_input_error');
                    $("#error_yurydychni_email").text(result);
                } else {
                    $(".email").removeClass('required_input_error')
                    $("#error_email").text(result);
                }
                if (result == 'Невiрний формат') {
                    disableSubmit = true;
                } else {
                    disableSubmit = false;
                }
            },
        });
        return disableSubmit;
    }

    //Check email 
    $(".email, .yurydychni_email").blur(function () {
        const email = $(this).val().trim();
        checkUserEmail(email);
    });


    // Submit order
    $("#cart-add").click(function () {

        /* Форма фіз особи */
        let names = $("#fiz_name").val().trim();
        let fiz_midlname = $("#fiz_midlname").val().trim();
        let fiz_lastname = $("#fiz_lastname").val().trim();

        // Форма юр особи
        let yurydychna_code = $("#yurydychna_code").val().trim();
        let yurydychna_company = $("#yurydychna_company").val().trim();

        let fiz_phone = '';
        let email = '';

        if (yurydychna_osoba == 0) {
            email = $(".email").val().trim();
            fiz_phone = $("#fiz_phone").val().trim();
        } else {
            email = $(".yurydychni_email").val().trim();
            fiz_phone = $("#yurydychna_phone").val().trim();
        }

        // Address
        let house = $("#house").val().trim();
        let street = $("#street").val().trim();
        let apartment = $("#apartment").val().trim();

        /*  Fiz check */
        // showInputErrorIfRequired(input class, is add placeholder error color)
        if (yurydychna_osoba == 0) {
            const check_fiz_name = showInputErrorIfRequired("#fiz_name", false) === true;
            const check_fiz_lastname = showInputErrorIfRequired("#fiz_lastname", false) === true;
            const check_email = showInputErrorIfRequired(".email", false) === true;
            const check_fiz_phone = showInputErrorIfRequired("#fiz_phone", true) === true;

            if (check_fiz_name ||
                check_fiz_lastname ||
                check_email ||
                check_fiz_phone
            ) {
                return
            } else {
                disableSubmit = false;
            };

            yurydychna_code = '';
            yurydychna_company = '';
        }
        /*  Yur check */
        if (yurydychna_osoba == 1) {
            const check_yurydychna_code = showInputErrorIfRequired("#yurydychna_code", false) === true;
            const check_yurydychna_company = showInputErrorIfRequired("#yurydychna_company", false) === true;
            const check_yurydychni_email = showInputErrorIfRequired("#yurydychni_email", false) === true;
            const check_yurydychna_phone = showInputErrorIfRequired("#yurydychna_phone", true) === true;

            if (check_yurydychna_code ||
                check_yurydychna_company ||
                check_yurydychni_email ||
                check_yurydychna_phone
            ) {
                return
            } else {
                disableSubmit = false;
            };

            names = yurydychna_code;
            fiz_midlname = yurydychna_company;
            fiz_lastname = '';
        }


        const isSelfPickUp = $('.my_cart_delivery_block_item_radiobox[data-id="1"]').attr('data-is-open') == 'true';
        if (isSelfPickUp) {
            house = '';
            street = '';
            apartment = '';
            delivery = '';
        }

        // Check if checked nova poshta department 
        const isDepartmentNovaposhta = $('.my_cart_delivery_block_item_radiobox[data-id="2"]').attr('data-is-open') == 'true';
        if (isDepartmentNovaposhta) {
            const isDefaultNpDeliveryField = $(".hidden_novaposhta_header_text").text() == 'Оберіть потрібне Вам відділення із списку';

            if (isDefaultNpDeliveryField) {
                $(".hidden_novaposhta_header_text").addClass("hidden_novaposhta_header_text_error");
                disableSubmit = true;
                return
            } else {
                $(".hidden_novaposhta_header_text").removeClass("hidden_novaposhta_header_text_error");
                delivery = $(".hidden_novaposhta_header_text").text().trim();
                disableSubmit = false;
            }

            house = '';
            street = '';
            apartment = '';
        }

        // Check if checked nova poshta address
        const isDeliveryNovaposhta = $('.my_cart_delivery_block_item_radiobox[data-id="3"]').attr('data-is-open') == 'true';
        if (isDeliveryNovaposhta) {
            delivery = '';

            const check_street = showInputErrorIfRequired("#street", false) === true;
            const check_house = showInputErrorIfRequired("#house", false) === true;

            if (check_street ||
                check_house
            ) {
                return
            } else {
                disableSubmit = false;
            };
        }

        function validateEmail(value) {
            const isValid = emailRefexp.test(value);
            const isFizEmail = yurydychna_osoba == 0 ? '.email' : '.yurydychni_email';
            if (isValid) {
                $(isFizEmail).siblings('.form_col_item_label').removeClass('required_label_error');
                $(isFizEmail).removeClass('required_input_placeholder_error');
                $(isFizEmail).removeClass('required_input_error');
            } else {
                $(isFizEmail).siblings('.form_col_item_label').addClass('required_label_error');
                $(isFizEmail).addClass('required_input_placeholder_error');
                $(isFizEmail).addClass('required_input_error');
            }
            return isValid;
        }

        const isValidUserEmail = validateEmail(email);
        if (isValidUserEmail) {
            disableSubmit = false;

        } else {
            return
        };

        // Submit new order
        if (disableSubmit == false) {
            const data = {
                currentTime: new Date().toLocaleString(),

                names: names,
                email: email,
                pass: Math.random().toString(36).slice(-8),
                // Fiz  
                fiz_midlname: fiz_midlname,
                fiz_lastname: fiz_lastname,
                fiz_phone: fiz_phone,

                // Yur
                osoba: yurydychna_osoba,
                yurydychna_code: yurydychna_code,
                yurydychna_company: yurydychna_company,

                paymetd_method: paymetd_method,

                // Delivery
                delivery: delivery,
                delivery_type: delivery_type,
                city: $(".nova_poshta_city_btn").text().trim(),
                city_hash: $(".nova_poshta_city_btn").attr('data').trim(),
                house: house,
                street: street,
                apartment: apartment,

                comment: $("#comment").val().trim(),
            };

            $.ajax({
                type: "POST",
                url: '/components/my-cart/cart-action.php',
                data: data,
                beforeSend: function () {
                    $("body").append('<div id="preloader"><img src="assets/loader_screen.svg" width="300px"></div>');
                },

                success: function (data) {
                    $("main").html(data);
                },
            });
        }
    });
});



const showInputErrorIfRequired = (inputClass, placeholder) => {
    let disableSubmit

    const isInputWithPlaceholder = placeholder === true ?
        'required_input_placeholder_error' :
        'required_input_error';

    const labelErrorClass = 'required_label_error';
    const labelClass = '.form_col_item_label';

    if ($(inputClass).val().length < 1) {
        $(inputClass).siblings(labelClass).addClass(labelErrorClass);
        $(inputClass).addClass(isInputWithPlaceholder);
        disableSubmit = true;
    } else {
        $(inputClass).siblings(labelClass).removeClass(labelErrorClass);
        $(inputClass).removeClass(isInputWithPlaceholder);
        disableSubmit = false;
    };

    // After click 
    $(inputClass).on("input", function () {
        const isRemoveError = $(this).val().trim().length > 0;
        if (isRemoveError) {
            $(this).siblings(labelClass).removeClass(labelErrorClass);
            $(this).removeClass('required_input_placeholder_error');
            $(this).removeClass('required_input_error');
        } else {
            $(this).siblings(labelClass).addClass(labelErrorClass);
            $(this).addClass('required_input_placeholder_error');
            $(this).addClass('required_input_error');
        }
    });
    return disableSubmit;
};