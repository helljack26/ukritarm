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

    showPassword('#show-pass', '#cpass');
    showPassword('#show-pass2', '#cnfpass');
    showPassword('#show-pass3', '#newpass');
    showPassword('#show-pass3', '#cpass');

    // Set active link to account sidebar
    let currentLocation = location.pathname;

    // Set active link
    const setActiveLink = (activeId) => {
        $(activeId).addClass("account_sidebar_block_links_active");
    }

    // Remove all active link
    $(".account_sidebar_block_links").children('a').removeClass("account_sidebar_block_links_active");

    // Define active link
    switch (currentLocation) {
        case '/my-account':
        case '/my-account.php':
            setActiveLink('#sidebar_myaccount')
            break;
        case '/change-password':
        case '/change-password.php':
            setActiveLink('#sidebar_change_pass')
            break;
        case '/pending-orders':
        case '/pending-orders.php':
            setActiveLink('#sidebar_active')
            break;
        case '/order-history':
        case '/order-history.php':
            setActiveLink('#sidebar_history')
            break;

        default:
            break;
    }

    // Sidebar dropdown action
    $(".account_sidebar_header").click(function () {
        $(this).toggleClass('account_sidebar_header_open');
        $(".account_sidebar_block").slideToggle();
    });

    // Show success message if redirect from forgot pass page
    if (document.referrer.includes('forgot-password')) {
        setTimeout(() => {
            $('.success_password_update').addClass('success_password_update_show');
        }, 500);

        setTimeout(() => {
            $('.success_password_update').removeClass('success_password_update_show');
        }, 3000);
    }


    // Order history / Pending orders
    $(".history_item_header_show_btn").click(function () {
        const thisParentNext = $(this).parent().next('.history_item_hidden');
        const isAlreadyOpen = thisParentNext.attr('data-is-open') == 'true';
        if (isAlreadyOpen) {
            thisParentNext.attr('data-is-open', 'false')
            $(this).removeClass('history_item_header_show_btn_active');
            $(this).children('.history_item_header_show_btn_desktop').text('Детальніше');
            $(this).children('.history_item_header_show_btn_tablet').text('Деталі');
            thisParentNext.slideUp();
            return
        }
        // Animate arrow
        $('.history_item_header_show_btn').removeClass('history_item_header_show_btn_active');
        $('.history_item_header_show_btn').children('.history_item_header_show_btn_desktop').text('Детальніше');
        $('.history_item_header_show_btn').children('.history_item_header_show_btn_tablet').text('Деталі');
        $(this).addClass('history_item_header_show_btn_active');
        $(this).children('.history_item_header_show_btn_desktop').text('Згорнути');
        $(this).children('.history_item_header_show_btn_tablet').text('Згорнути');

        // Change attr for hidden blocks
        $('.history_item_hidden').attr('data-is-open', 'false')
        thisParentNext.attr('data-is-open', 'true');


        let offsetWhenScroll = 0;
        if (window.matchMedia("(min-width: 992px)").matches) {
            offsetWhenScroll = 70;
        } else {
            offsetWhenScroll = 130;
        }


        // Show and hide 
        $(".history_item_hidden").each(function () {
            const thisItem = $(this);
            const isAttrOpen = thisItem.attr("data-is-open") == 'true';

            // Add active checkbox classes
            if (isAttrOpen) {
                setTimeout(() => {
                    const scrollTab = thisItem.prev('.history_item_header');
                    $("html:not(:animated),body:not(:animated)").animate({
                            scrollTop: scrollTab.offset().top - offsetWhenScroll,
                        },
                        200
                    );
                }, 200);
                thisItem.show();

            } else {
                $(this).hide();
            }
        });

    });
});

function valid() {
    if (document.update_pass.newpass.value != document.update_pass.cnfpass.value) {
        $("#form_col_item_pass_error").text("Паролі не співпадають");
        document.update_pass.cnfpass.focus();
        return false;
    } else {
        $("#form_col_item_pass_error").text("");
    }
    return true;
}