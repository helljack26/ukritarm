import {
    basketListActions
} from "./my-cart-js/my-cart-list.js";
import {
    mobileMenu
} from "./module/mobile_menu.js";

// Scroll to top on refresh
if (history.scrollRestoration) {
  history.scrollRestoration = 'manual';
} else {
  window.onbeforeunload = function () {
    window.scrollTo(0, 0);
  }
}

$(document).ready(function () {
    $(this).scrollTop(0);
    (function ($) {
        // Header
        let currentLocation = location.pathname;

        const closeBasketIcon = () => {
            setTimeout(() => {
                $(".basket_btn_icon").removeClass("basket_btn_icon_open");
                $(".basket_btn_icon").css({
                        transform: "scale(1)",
                    },
                    "slow"
                );
            }, 300);
        };

        let isOpenSearchBlock = false;

        // Desktop search close 
        const openSearchItems = function () {
            $(".header_first_right_basket_block").fadeOut();
            closeBasketIcon();

            $(".header_first_right_search_block_input").focus();
            $(".header_first_right_search_button").addClass("header_first_right_search_button_open");
            $(".header_first_right_search_block_input").addClass("header_first_right_search_input_open");
            setTimeout(() => {
                $(".header_first_right").addClass("header_first_right_open_input");
                $(".header_first_right_search").addClass("header_first_right_search_open_input");
            }, 200);

            isOpenSearchBlock = true
        }
        const closeSearchItems = () => {
            $(".header_first_right_search_button").removeClass("header_first_right_search_button_open");
            $(".header_first_right_search_block_input").val("");
            $(".header_first_right_search_results").html("");
            $(".header_first_right").removeClass("header_first_right_open_input");
            $(".header_first_right_search").removeClass("header_first_right_search_open_input");
            isOpenSearchBlock = false
        }
        // Mobile search close 
        // Init modules
        basketListActions(currentLocation);
        mobileMenu();

        // Close popups if click outside
        $(document).click(function (e) {
            // Закрити пошук
            const searchContainer = $(".header_first_right_search");
            if (searchContainer.has(e.target).length === 0 && !currentLocation.includes('search-result')) {
                closeSearchItems();
            }
            // Закрити Корзину
            const basketContainer = $(".header_first_right");
            if (basketContainer.has(e.target).length === 0) {
                $(".header_first_right_basket_block").fadeOut();
                closeBasketIcon();
            }
            // Закрити телефони
            const phoneContainer = $(".desktop-navbar-phones_wrapper");
            if (phoneContainer.has(e.target).length === 0) {
                $(".desktop-navbar-phones_btn_arrow").removeClass("phone_arrow_rotate");
                $(".desktop-navbar-phones").fadeOut();
            }
        });



        // Desktop search action
        $(".header_first_right_search_button").click(function () {
            if (isOpenSearchBlock === false) {
                openSearchItems();
            } else {
                closeSearchItems();
            }
        });

        // Search products
        $(".header_first_right_search_block_input, .mobile-navbar-collapse_search_block_input")
            .on("input", function () {
                const search = $(this).val();

                if (search.length > 0) {
                    $(this).next().removeClass('disabled_search_button')
                } else {
                    $(this).next().addClass('disabled_search_button')
                }

                // Return if mobile search
                const isMobileInput = $(this).attr('class').includes('mobile-navbar-collapse_search_block_input')
                if (isMobileInput) return

                $.ajax({
                    type: "POST",
                    url: "../functions/search_fields.php",
                    data: {
                        q: search,
                        search: "1",
                    },
                    success: function (data) {
                        $(".header_first_right_search_results").html(data).show();
                    },
                });
            });

        $(".header_first_right_search_block, .mobile-navbar-collapse_search").submit(function () {
            const thisChildInput = $(this).children('input').val();
            location = `search-result/${thisChildInput}`;
            return false;
        });


        // Header category and services menu action
        $(".header_link_category_trigger, .header_link_services_trigger").click(function () {
            const thisClass = $(this).attr('class');

            const isCategoryBtn = thisClass.includes('header_link_category_trigger')
            const isServicesBtn = thisClass.includes('header_link_services_trigger')

            if ((currentLocation === '/all-category' && isCategoryBtn) || (currentLocation === '/services' && isServicesBtn)) return

            const linkAddress = $(this).parent().attr('data-type');
            window.location.href = linkAddress;
        })

        $(".header_link_services, .header_link_category").mouseenter(function () {
            const typeOfMenu = $(this).attr('data-type');

            if (typeOfMenu === 'all-category') {
                $(".header_hidden_menu_category").addClass('header_hidden_menu_open');
            } else {
                $(".header_hidden_menu_services").addClass('header_hidden_menu_open');
            }
            $(this).addClass('header_link_hovered');
        })
        $(".header_link_services, .header_link_category").mouseleave(function () {
            const thisSliderItem = this;

            const typeOfMenu = $(this).attr('data-type');

            const defineHiddenMenu = typeOfMenu === 'all-category' ? '.header_hidden_menu_category' : '.header_hidden_menu_services';
            $(thisSliderItem).removeClass('header_link_hovered');
            $(defineHiddenMenu).removeClass('header_hidden_menu_open');
        })

        /*===================================================================================*/
        /*  LAZY LOAD IMAGES USING ECHO
        /*===================================================================================*/

        echo.init({
            offset: 100,
            throttle: 250,
            unload: false,
        });

        /*===================================================================================*/
        /*  WOW 
          /*===================================================================================*/
        $(document).ready(function () {
            new WOW().init();
        });

        // Set active link
        const setActiveLink = (activeId) => {
            $(activeId).addClass("header_link_active");
        }

        // Remove all active link
        $(".header_link").removeClass("header_link_active");

        // Define active link
        switch (currentLocation) {
            case '/':
            case '/index':
                setActiveLink('.header_link_main')
                break;
            case '/all-category':
                setActiveLink('.header_link_category')
                break;
            case '/services':
                setActiveLink('.header_link_services')
                break;
            case '/aboutus':
                setActiveLink('.header_link_aboutus')
                break;
            case '/news':
                setActiveLink('.header_link_news')
                break;
            case '/contact':
                setActiveLink('.header_link_contact')
                break;
            case '/login':
            case '/my-account':
            case '/order-history':
            case '/change-password':
                $('.header_first_log_block_login_icon').addClass('header_first_log_block_login_icon_active');
                // Disable pointer event on login page
                $(".header_first_log_block_login").each(function () {
                    $(this).attr('href') !== 'logout' && $(this).css('pointer-events', 'none');
                });
                break;
            case '/my-cart':
            case '/my-cart.php':
                $('.basket_btn_icon').addClass('basket_btn_icon_active');
                $('.header_first_right_basket_btn').css('pointer-events', 'none');
                break;

            default:
                break;
        }

        if (currentLocation.includes('search-result')) {
            $('.header_first_right_search_button').addClass('header_first_right_search_button_active');
        }

        // Preloader
        setTimeout(() => {
            $(document).ready(function () {
                $("body").css("overflow-y", "scroll");
                $("#preloader").animate({
                        opacity: "0",
                    },
                    300
                );

                setTimeout(() => {
                    $("#preloader").remove();
                }, 310);
            });
        }, 500);
    })(jQuery);
});