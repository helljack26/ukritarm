$(document).ready(function () {
    // 
    // Switch fiz form and yur form 
    // 
    $(".user_buttons_item").click(function () {
        paymetd_method = "Готівкою або картою при отриманні";

        // Add active class for button
        $(".user_buttons_item").removeClass('user_buttons_item_active');
        $(this).addClass('user_buttons_item_active');

        // Reset payment checkboxes
        $('.my_cart_payment_block_radiobox').attr("data-is-open", 'false');
        $('.my_cart_payment_block_radiobox[data-id="1"]').attr("data-is-open", 'true');

        updatePaymentRadio();

        if ($(this).attr("id") == "fiz") {
            //Фізична особа
            yurydychna_osoba = 0;
            $("#fiz-osoba").show();
            $("#yurydychna_osoba_tab").hide();
        } else {
            //Юридична особа
            yurydychna_osoba = 1;
            $("#fiz-osoba").hide();
            $("#yurydychna_osoba_tab").show();
        }
    });


    // 
    // Delivery checkboxes
    // 
    $(".my_cart_delivery_block_item_radiobox").click(function () {
        delivery_type = $(this).children('.delivery_type').text().trim();
        id = $(this).attr("data-id");

        if (delivery_type == 'Самовивіз із відділення Нової Пошти' || delivery_type == 'Адресна доставка Нової почти') {
            $(".nova_poshta_payment_message").show();
        } else {
            $(".nova_poshta_payment_message").hide();
        }

        // Change current checkbox
        $('.my_cart_delivery_block_item_radiobox').attr("data-is-open", 'false');
        $(this).attr("data-is-open", 'true');

        // Update active state
        $(".my_cart_delivery_block_item_radiobox").each(function () {
            const isAttrOpen = $(this).attr("data-is-open") == 'true';
            const isNotFirst = $(this).attr("data-id") != '1';

            // Add active checkbox classes
            if (isAttrOpen) {
                $(this).parent().parent().addClass('my_cart_delivery_block_item_active');
            } else {
                $(this).parent().parent().removeClass('my_cart_delivery_block_item_active');
            }

            // Open hidden blocks
            if (isAttrOpen && isNotFirst) {
                $(this).parent().next('.my_cart_delivery_block_item_hidden').slideDown();
            }
            if (!isAttrOpen && isNotFirst) {
                $(this).parent().next('.my_cart_delivery_block_item_hidden').slideUp();
            }
        });
    });


    // 
    // Payment checkboxes
    // 
    const updatePaymentRadio = () => {
        $(".my_cart_payment_block_radiobox").each(function () {
            const isAttrOpen = $(this).attr("data-is-open") == 'true';

            // Add active checkbox classes
            if (isAttrOpen) {
                $(this).addClass('my_cart_payment_block_radiobox_active');
            } else {
                $(this).removeClass('my_cart_payment_block_radiobox_active');
            }
        });
    }
    $(".my_cart_payment_block_radiobox").click(function () {
        paymetd_method = $(this).text().trim();

        // Change current checkbox
        $('.my_cart_payment_block_radiobox').attr("data-is-open", 'false');
        $(this).attr("data-is-open", 'true');

        updatePaymentRadio();
    });


});