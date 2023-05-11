$(document).ready(function () {
    $(".header_logo").attr("href", "#");
    $(".header_logo").addClass("header_logo_disable");

    // Intro animation
    const setActiveBlock = (activeBlock) => {
        if (activeBlock == 'product') {
            $(".intro_col_products").removeClass('intro_col_disactive')
            $(".intro_col_products").addClass('intro_col_active')
            $(".intro_col_services").removeClass('intro_col_active')
            $(".intro_col_services").addClass('intro_col_disactive')
        } else {
            $(".intro_col_products").addClass('intro_col_disactive')
            $(".intro_col_products").removeClass('intro_col_active')
            $(".intro_col_services").addClass('intro_col_active')
            $(".intro_col_services").removeClass('intro_col_disactive')
        }
    }


    if (window.matchMedia("(min-width: 992px)").matches) {
        $(".intro").mouseenter(function () {
            $(".intro_col_products").mouseenter(function () {
                setActiveBlock('product')
            });
            $(".intro_col_services").mouseenter(function () {
                setActiveBlock('services')
            });
        });
        // If leave from intro remove all animation
        $(".intro").mouseleave(function () {
            $(".intro_col_products").removeClass('intro_col_disactive')
            $(".intro_col_products").removeClass('intro_col_active')
            $(".intro_col_services").removeClass('intro_col_disactive')
            $(".intro_col_services").removeClass('intro_col_active')
        });
    }

    window.onresize = function () {
        location.reload()
    }

    $('#popularProduct_slider').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        dots: false,
        swipe: false,
        arrows: true,
        prevArrow: '<button type="button" class="slick_prev_product"><img src="assets/icon/arrow_down.svg"/></button>',
        nextArrow: '<button type="button" class="slick_next_product"><img src="assets/icon/arrow_down.svg"/></button>',
        asNavFor: '#popularProduct_slider_links',
        responsive: [{
                breakpoint: 1650,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1100,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
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
    $('#popularProduct_slider_links').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
        dots: false,
        swipe: false,
        asNavFor: '#popularProduct_slider',
        responsive: [{
                breakpoint: 1650,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1100,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
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