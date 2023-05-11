let isFiltersOn = false;
$(document).ready(function () {
    // Get product category path

    const cat = $("#cat").val();
    const scid = $("#cid").val();

    let currentFilterQuery = "";

    let currentPriceQuery = "";

    let isCurrentPopularSortQuery = false;

    let defaultSort = 'and product_price > 1 ORDER BY product_availability DESC'

    const getProduct = () => {
        isFiltersOn = true;
        $.ajax({
            type: "POST",
            url: "/includes/product_filters/apply_filters.php",
            data: {
                sqlQuery: `${currentFilterQuery} ${currentPriceQuery} ${defaultSort}`,
                isPopularSort: isCurrentPopularSortQuery,
                category: cat,
                sub_сategory: scid,
            },

            success: function (html) {
                $(".product_category_row_results_block").html(html);
            },
        });
    };

    //////////////////////// end ////////////////////////

    //////////////////////// Price range ////////////////////////
    // Min max price
    let minPrice = 0;
    let maxPrice = $("#price_range_max").val();
    // Get data from back
    const priceRangeProducts = () => {
        currentPriceQuery = "";
        if (minPrice === 0) {
            minPrice = 1;
        }
        currentPriceQuery = `and product_price BETWEEN '${minPrice}' and '${maxPrice}'`;

        getProduct();
    };

    // Change class if not default value
    const rangeButtonChangeClass = () => {
        if (minPrice > 0 || maxPrice != 100000) {
            $(".range_slider_button").removeClass("range_slider_button_disable");
        }

        if (minPrice == 0 && maxPrice == 100000) {
            $(".range_slider_button").addClass("range_slider_button_disable");
        }
    };

    // Price range slider
    (function () {
        const parentNum = document.querySelector(".range_slider_row");
        const parentRange = document.querySelector(".range_slider_row_track");
        if (!parentNum) return;
        if (!parentRange) return;

        const numberS = parentNum.querySelectorAll("input[type=number]");
        const rangeS = parentRange.querySelectorAll("input[type=range]");

        // Range slider
        $('.noUi-handle').on('click', function () {
            $(this).width(50);
        });
        const rangeSlider = document.getElementById('slider-range');
        const moneyFormat = wNumb({
            decimals: 0
        });

        noUiSlider.create(rangeSlider, {
            start: [minPrice, parseInt(maxPrice)],
            step: 1,
            range: {
                'min': [minPrice],
                'max': [parseInt(maxPrice)]
            },
            format: moneyFormat,
            connect: true
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on('update', function (values) {
            var slide1 = parseFloat(values[0]),
                slide2 = parseFloat(values[1]);

            if (slide1 > slide2) {
                [slide1, slide2] = [slide2, slide1];
            }

            numberS[0].value = slide1;
            numberS[1].value = slide2;
            // Set input value to variable
            minPrice = slide1;
            maxPrice = slide2;
            rangeButtonChangeClass();
        });


        numberS.forEach(function (el) {
            el.oninput = function () {
                var number1 = parseFloat(numberS[0].value),
                    number2 = parseFloat(numberS[1].value);

                if (number1 > number2) {
                    var tmp = number1;
                    numberS[0].value = number2;
                    numberS[1].value = tmp;
                }

                // Update range slider
                rangeSlider.noUiSlider.set([number1, number2]);
                // Set input value to variable
                minPrice = number1;
                maxPrice = number2;
                rangeButtonChangeClass();
            };
        });
    })();

    // Range slider submit button
    $(".range_slider_button").click(function () {
        priceRangeProducts();
    });

    let filterQueryObject = {};

    const getAllCheckedCheckbox = () => {
        const allCheckbox = $(".item_hidden_list_row_checkbox");
        currentFilterQuery = "";
        filterQueryObject = {};
        for (let i = 0; i < allCheckbox.length; i++) {
            const element = allCheckbox[i];

            if (element.checked) {
                const filterHash = element.getAttribute("data-hash");
                const filterType = element.getAttribute("name");
                const filterCatType = element.getAttribute("data-cat");

                if (filterQueryObject[filterHash] !== undefined) {
                    filterQueryObject[filterHash] = [...filterQueryObject[filterHash],
                        {
                            value: filterType,
                            cat_name: filterCatType,
                        }
                    ];
                } else {
                    filterQueryObject[filterHash] = [{
                        value: filterType,
                        cat_name: filterCatType,
                    }];
                }
            }
        }

        for (const key in filterQueryObject) {
            if (Object.hasOwnProperty.call(filterQueryObject, key)) {
                const element = filterQueryObject[key][0].value;
                const catName = filterQueryObject[key][0].cat_name;
                currentFilterQuery += `and attributes->'$."${key}".value' LIKE '%${element}%'`;
            }
        }

    };

    //////////////////////// Filters type item  ////////////////////////
    $(".item_hidden_list_row_checkbox").click(function () {
        getAllCheckedCheckbox();
        getProduct();
    });
    //////////////////////// end ////////////////////////

    //////////////////////// Filters item toggle ////////////////////////
    $(".product_filters_container_item_header").click(function () {
        $(this).next(".product_filters_container_item_hidden").toggle();
        $(this)
            .children(".product_filters_container_item_header_arrow")
            .toggleClass("arrow_rotate");
    });
    //////////////////////// end ////////////////////////

    //////////////////////// Sub filters toggle ////////////////////////
    $(".item_hidden_list_more_btn").click(function () {
        $(this).next(".item_hidden_list_more_block").toggle();
    });
    //////////////////////// end ////////////////////////

    //////////////////////////////////////////////// Mobile filters open ////////////////////////////////////////////////
    const openMobileFilter = () => {
        $(".product_filters").animate({
                right: "0px",
            },
            "slow"
        );
        $(".product_filters_mobile_bg").fadeIn("slow");
        $("body").css("overflow-y", "hidden");
        return;
    };
    const closeMobileFilter = () => {
        // $(".product_filters_container_header_mobile").removeClass("product_filters_container_header_mobile_open");

        $(".product_filters").animate({
                right: "-100%",
            },
            "slow"
        );
        $(".product_filters").attr("data", "0");
        $(".product_filters_mobile_bg").fadeOut("slow");
        $("body").css("overflow-y", "scroll");
        return;
    };
    // Mobile side filters button
    $(".product_filters_container_header_mobile").click(function () {
        if ($(".product_filters").attr("data") == "0") {
            openMobileFilter();
        } else {
            closeMobileFilter();
        }
    });
    // If touch opacity bg close
    $(
        ".product_filters_mobile_bg, .product_filters_container_header_icon_sidefilters"
    ).click(function () {
        closeMobileFilter();
    });

    // Swipe close side filters
    var touchstartX = 0;
    var touchendX = 0;

    var gestureZone = document.querySelector(".product_filters_mobile_bg");

    gestureZone.addEventListener(
        "touchstart",
        function (event) {
            touchstartX = event.changedTouches[0].screenX;
        },
        false
    );

    gestureZone.addEventListener(
        "touchend",
        function (event) {
            touchendX = event.changedTouches[0].screenX;
            handleGesture();
        },
        false
    );

    function handleGesture() {
        if (
            touchendX > touchstartX + 100 &&
            $(".product_filters").css("right") == "0px"
        ) {
            closeMobileFilter();
        }
    }

    //////////////////////////////////////////////// Sort dropdown ////////////////////////////////////////////////
    $(".product_category_row_results_header_sort").click(function () {
        $(".results_header_sort_dropdown").slideToggle();
    });

    // Change sort header
    $(".results_header_sort_dropdown_item").click(function (e) {
        const currentText = $(this).text();
        const currentSortType = $(this).attr("data-sort");
        const isComma = currentPriceQuery.length > 0 ? ", " : ",";

        const isExistOrderBy = 'ORDER BY product_availability DESC';

        const isEmptyPrice = () => {
            if (currentPriceQuery.length == 0) {
                currentPriceQuery = '';
                currentPriceQuery = 'and product_price > 1';
            }
        }

        switch (currentSortType) {
            case "cheap":
                isCurrentPopularSortQuery = false;
                isEmptyPrice();
                defaultSort = "";
                defaultSort = `${isExistOrderBy}, product_price ASC `;
                break;
            case "expensive":
                isCurrentPopularSortQuery = false;
                isEmptyPrice();
                defaultSort = "";
                defaultSort = `${isExistOrderBy}, product_price DESC`;
                break;
            case "popular":
                isEmptyPrice();
                defaultSort = "";
                isCurrentPopularSortQuery = true;
                break;

            default:
                break;
        }
        getProduct();
        //
        $(".product_category_row_results_header_sort_text").text(currentText);
        $(".results_header_sort_dropdown").slideUp();
    });

    // Close sort dropdown if click outside
    $(document).click(function (e) {
        e.stopPropagation();
        var container = $(".product_category_row_results_header");

        //check if the clicked area is dropDown or not
        if (container.has(e.target).length === 0) {
            $(".results_header_sort_dropdown").slideUp();
        }
    });
});