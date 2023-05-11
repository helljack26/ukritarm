import {
    addSpaceToNumber,
    removeSpaceFromNumber
} from "./module/helpers.js";

$(document).ready(function () {
    // Close fullscreen slider
    const closeFullScreenSlider = () => {
        $(".product_img_fullscreen_container").animate({
            opacity: "0",
        });
        // On body scroll when fullscreen off
        $("body").css("padding-right", "0px");
        $("body").css("overflow-y", "scroll");
        setTimeout(() => {
            // Hide fullscreen slider
            $(".product_img_fullscreen_container").css("top", "-100%");
        }, 300);
    }

    // Fullscreen slider
    const largeFullSlider = $(".product_img_fullscreen_largeImg_slider");
    largeFullSlider.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        swipe: true,
        arrows: true,
        fade: false,
        infinite: false,
        variableWidth: true,
        prevArrow: '<button type="button" class="slick-prev"></button>',
        nextArrow: '<button type="button" class="slick-next"></button>',
        responsive: [{
                breakpoint: 992,
                settings: {
                    swipe: true,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    swipe: true,
                    arrows: true,
                    prevArrow: '<button type="button" class="slick-prev"></button>',
                    nextArrow: '<button type="button" class="slick-next"></button>',
                },
            },
        ],
    });

    // On click on nav item set active class
    $(".product_img_fullscreen_slider_item, .item_allAbout_images_item").click(function () {
        const itemIndex = $(this).attr('data-id');
        $(".product_img_fullscreen_largeImg_slider").slick("slickGoTo", +itemIndex);
    });


    // Listen fullscreen slider
    $(".product_img_fullscreen_largeImg_slider").on(
        "afterChange",
        function (event, slick, currentSlide, nextSlide) {
            // Set active class for fullscreen nav
            $(".product_img_fullscreen_slider_item").removeClass(
                "product_img_fullscreen_slider_item_active"
            );
            setTimeout(() => {
                $(
                    `.product_img_fullscreen_slider div:nth-child(${currentSlide + 1})`
                ).addClass("product_img_fullscreen_slider_item_active");
            }, 200);
        }
    );

    let isOpenFullscreenViewer = false;
    // Close fullscreen slider
    $(".product_img_fullscreen_container_close").click(function () {
        isOpenFullscreenViewer = false;
        closeFullScreenSlider()
    });

    // If escape close fullscreen viewer
    $(document).keyup(function (e) {
        if (e.key === "Escape" && isOpenFullscreenViewer === true) {
            isOpenFullscreenViewer = false;
            closeFullScreenSlider()
        }
    });

    // Вначале нужно показать а потом спрятать полноекранний слайдер что би отрабативались клики на мобильном хедере
    $(".product_img_fullscreen_container").hide();
    // Zoom and open fullscreen slider
    $(".product_row_col_slider_item, .item_allAbout_images_item").click(function (e) {
        $(".product_img_fullscreen_container").show();
        isOpenFullscreenViewer = true;
        const windowHeight = window.innerHeight
        $(".product_img_fullscreen_container").css({
            "top": "0px",
            'height': `${windowHeight}`
        });

        // Wait while slider change offset top
        setTimeout(() => {
            // Off body scroll when fullscreen on
            $(".product_img_fullscreen_container").animate({
                opacity: "1",
            });
            // Set current slide in fullscreen slider
            const currentSlide = $(".product_row_col_slider").slick(
                "slickCurrentSlide"
            );
            $(".product_img_fullscreen_largeImg_slider").slick(
                "slickGoTo",
                +currentSlide
            );

            // Set active class for fullscreen nav
            $(".product_img_fullscreen_slider_item").removeClass(
                "product_img_fullscreen_slider_item_active"
            );
            $(
                `.product_img_fullscreen_slider div:nth-child(${currentSlide + 1})`
            ).addClass("product_img_fullscreen_slider_item_active");
        }, 300);
        setTimeout(() => {
            $("body").css("overflow-y", "hidden");
            $("body").css("padding-right", "10px");
        }, 500);
    });

    // Largeimg Page slider
    $(".product_row_col_slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        swipe: false,
        dots: true,
        autoplay: false,
        variableWidth: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick_prev_product"><img src="assets/icon/arrow_down.svg"/></button>',
        nextArrow: '<button type="button" class="slick_next_product"><img src="assets/icon/arrow_down.svg"/></button>',
        responsive: [{
            breakpoint: 992,
            settings: {
                variableWidth: true,
                swipe: true,
            },
        }, ],
    });
});

$(document).ready(function () {
    const resetBuyButton = () => {
        $(".product_buy_button").text("Купити");
        $(".product_buy_button").css({
            "background-color": "#001F48",
            color: "white",
        });
    }

    // Select unit
    $(".select_tb").change(function () {
        resetBuyButton()
        let unit = parseFloat($(this).val());
        $(".prices").html(unit + " ₴").attr("data", unit + " ₴");
        $(".quant").val(1);
    });

    // Plus
    $(".plus").click(function () {
        resetBuyButton()
        let quant = parseFloat($(".quant").val());
        let old = parseFloat($(".prices").attr("data"));
        let res = old * (quant + 1);
        res = addSpaceToNumber(res);

        if (
            $(".quant").val() == null ||
            $(".quant").val() == "0" ||
            $(".quant").val() == ""
        ) {
            $(".quant").val(1);
        }
        if (quant > 0) {
            $(".quant").val(quant + 1);
            $(".prices").html(res + " ₴");
        }
    });

    // Minus
    $(".minus").click(function () {
        resetBuyButton()
        let quant = parseInt($(".quant").val());
        let old = parseFloat($(".prices").attr("data"));
        let res = old * (quant - 1);
        res = addSpaceToNumber(res);
        if (quant > 1) {
            $(".quant").val(quant - 1);
            $(".prices").html(res + " ₴");
        }
    });

    $(".quant").bind("input paste", function () {
        resetBuyButton()
        let quant = parseInt($(this).val());
        let old = parseFloat($(".prices").attr("data"));
        let res = old * quant;
        res = addSpaceToNumber(res);

        if (quant > 0) {
            $(".prices").html(res + " ₴");
        }
    });

    // Buy button
    $(".product_buy_button").click(function (event) {
        if (event.target.innerText === "Оформити") {
            return (document.location = "my-cart");
        } else {
            let price = removeSpaceFromNumber($(".prices").attr("data"));
            price = parseFloat(price);

            let quant = parseInt($(".quant").val());
            let unit = $(".select_tb").val();
            let product_code = $(this).attr('data-code');
            let product_articul = $(this).attr('data-articul');
            $.ajax({
                type: "POST",
                url: "components/my-cart/my-cart-no-reload.php",
                data: {
                    pid: product_code,
                    articul: product_articul,
                    price: price,
                    quant: quant,
                    unit: unit,
                },
                success: function (results) {
                    $(".product_buy_button").text("Оформити").css({
                        "background-color": "#405776",
                        color: "#ffcd00",
                    });

                    const data = results.split("|");
                    const countInBasket = data[0];
                    let sumInBasket = parseFloat(data[1]);
                    sumInBasket = addSpaceToNumber(sumInBasket);
                    const newBasketData = data[2];
                    const newBasketFooter = data[3];

                    // Basket update
                    $(".header_first_right_basket_block").html(`${newBasketData} ${newBasketFooter}`);

                    $(".count").fadeIn();
                    $(".count").text(countInBasket);

                    // $(".value").html(`${sumInBasket} ₴`);
                    $(".basket_price_sum").html(`${sumInBasket} ₴`);
                },
            });
        }
    });

    let thisInitialText = '';
    let isFirstOpenHiddenReviews = false;
    let isOpenHiddenReviews = false;
    $(".product_reviewDescription_block_item_reviews_more_btn").click(function () {
        if (isFirstOpenHiddenReviews == false) {
            thisInitialText = $(this).html();
            isFirstOpenHiddenReviews = true;
        }

        if (isOpenHiddenReviews === false) {
            $(this).html('Згорнути');
            isOpenHiddenReviews = true;
        } else {
            $(this).html(thisInitialText);
            isOpenHiddenReviews = false;
        }


        $('.product_reviewDescription_block_item_reviews').toggleClass('product_reviewDescription_block_item_reviews_scroll');
        $('.product_reviewDescription_block_item_reviews_hidden').slideToggle();
    });

    let offsetWhenScroll = 0;
    if (window.matchMedia("(min-width: 992px)").matches) {
        offsetWhenScroll = 150;
    }

    if (window.matchMedia("(max-width: 450px)").matches) {
        offsetWhenScroll = 310;
    } else {
        offsetWhenScroll = 210;
    }

    const scrollToTab = (tabId) => {
        const scrollTab = $(tabId);
        $("html:not(:animated),body:not(:animated)").animate({
                scrollTop: scrollTab.offset().top - offsetWhenScroll,
            },
            300
        );
    }

    // Review/Description
    const scrollToReviewDesktop = (e) => {
        $(".product_reviewDescription_header_btn").removeClass(
            "product_reviewDescription_header_btn_active"
        );
        $(".product_reviewDescription_header_btn_review").addClass(
            "product_reviewDescription_header_btn_active"
        );

        $("#product_reviewDescription_block_item_allAbout").fadeOut();

        setTimeout(() => {
            $("#product_reviewDescription_block_item_review").fadeIn();
        }, 400);
        const blockHash =
            e !== "review_form" ? e.target.attributes[2].value : "review_form";

        setTimeout(() => {
            const reviewBlock = $("#product_reviewDescription_block_item_review");
            $("html:not(:animated),body:not(:animated)").animate({
                    scrollTop: reviewBlock.offset().top - offsetWhenScroll,
                },
                200
            );

            if (blockHash === "review_form") {
                reviewBlock.scrollTop(reviewBlock.prop("scrollHeight"));
            } else {
                reviewBlock.scrollTop(0);
            }
            return false;
        }, 600);
    };


    // If click leave review in some small card
    if (location.hash === "#review") {
        setTimeout(() => {
            scrollToReviewDesktop("review_form");
        }, 400);
    }

    // Tab open
    $(".product_reviewDescription_header_btn, #show_all_attributes").click(function (e) {
        const hash = e.target.innerText.split(" ")[0];
        $(".product_reviewDescription_header_btn").removeClass(
            "product_reviewDescription_header_btn_active"
        );

        if (hash === "Дивитись") {
            $('.product_reviewDescription_header_btn_description').addClass("product_reviewDescription_header_btn_active");
        } else {
            $(this).addClass("product_reviewDescription_header_btn_active");
        }

        const openActiveTab = (activeTab) => {
            $("#product_reviewDescription_block_item_allAbout").fadeOut();
            $("#product_reviewDescription_block_item_attributes").fadeOut();
            $("#product_reviewDescription_block_item_review").fadeOut();

            setTimeout(() => {
                $(activeTab).fadeIn();
            }, 400);

            setTimeout(() => {
                scrollToTab(activeTab);
            }, 600);
        }


        if (hash === "Все") {
            openActiveTab('#product_reviewDescription_block_item_allAbout');
        } else if (hash === "Характеристики" || hash === "Дивитись") {
            openActiveTab('#product_reviewDescription_block_item_attributes');
        } else {
            openActiveTab('#product_reviewDescription_block_item_review');
        }
    });

    // infinite: false,
    $('#popularProduct_slider').slick({
        infinite: false,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 4000,
        dots: false,
        swipe: false,
        arrows: true,
        prevArrow: '<button type="button" class="slick_prev_product"><img src="assets/icon/arrow_down.svg"/></button>',
        nextArrow: '<button type="button" class="slick_next_product"><img src="assets/icon/arrow_down.svg"/></button>',
        responsive: [{
                breakpoint: 1650,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1150,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    swipe: true,
                }
            },
            {
                breakpoint: 993,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: false,
                    swipe: true,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    dots: false,
                    swipe: true,
                }
            }
        ]
    });
})