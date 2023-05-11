import {
    addSpaceToNumber,
    removeSpaceFromNumber
} from "../module/helpers.js";

export const basketListActions = (currentLocation) => {

    // Popup basket open / close
    $(".header_first_right_basket_btn").click(function () {
        $(".basket_btn_icon").css({
                transform: "scale(0.7)",
            },
            "slow"
        );
        setTimeout(() => {
            $(".basket_btn_icon").toggleClass("basket_btn_icon_open");
            $(".basket_btn_icon").css({
                    transform: "scale(1)",
                },
                "slow"
            );
        }, 300);

        $(".header_first_right_basket_block").fadeToggle();
    });

    const updateMainQuantityOnMyCartPage = () => {
        if (currentLocation === '/my-cart' || currentLocation === '/my-cart.php') {
            let mainQuantity = 0;

            $(document).find(".basket_block_ul_item_info_row_quantity_input").each(function () {
                mainQuantity += parseInt($(this).val());
            });
            $(".aside_block_products_row_count").text(`${mainQuantity} шт`);
        }
    }

    const updatePopupBasketList = (results) => {
        if (results.length > 0) {
            let data = results.split("|");
            let countInBasket = data[0];
            let sumInBasket = parseFloat(data[1]);
            sumInBasket = addSpaceToNumber(sumInBasket);

            let newBasketData = data[2];
            let newBasketFooter = data[3];

            // Basket update
            if (currentLocation === '/my-cart') {
                $(".aside_block_products").html(newBasketData);
            } else {
                $(".header_first_right_basket_block").html(`${newBasketData} ${newBasketFooter}`);
            }

            if (parseInt(countInBasket) > 0) {
                $(".count").fadeIn();
                $(".count").text(countInBasket);
            } else {
                $(".count").text(countInBasket);
                $(".count").fadeOut();
            }

            $(".value").html(`${sumInBasket} ₴`);
            $(".basket_price_sum").html(`${sumInBasket} ₴`);

            updateMainQuantityOnMyCartPage();
        }
    }

    // Initial get basket list
    $.ajax({
        type: "POST",
        url: "../components/my-cart/get_basket_list.php",
        success: function (results) {
            updatePopupBasketList(results);
        },
    });


    // Update prices when change quantity in popup basket
    const updatePopupBasketListOnFront = (popup_basket_id, oldQuntity, newQuantity) => {
        if (newQuantity == 0) {
            return
        }
        $(document).find("#popup_basket_quantity_" + popup_basket_id).val(newQuantity).attr('data-old', newQuantity);

        // Price
        const popupBasketPrice = $(document).find("#popup_basket_price_" + popup_basket_id).first();
        let popupBasketPriceVal = removeSpaceFromNumber(popupBasketPrice.val());
        popupBasketPriceVal = parseInt(popupBasketPriceVal);

        const oldPopupBasketPrice = oldQuntity * popupBasketPriceVal;
        const newPopupBasketPrice = popupBasketPriceVal * newQuantity;

        // Total price
        const totalPrice = $(document).find(".basket_price_sum").first();
        let totalPriceVal = removeSpaceFromNumber(totalPrice.text());
        totalPriceVal = parseInt(totalPriceVal);

        const totalPriceWitoutProduct = totalPriceVal - oldPopupBasketPrice;
        const newTotalPrice = totalPriceWitoutProduct + newPopupBasketPrice;

        const popupBasketUnit = $(document).find("#popup_basket_unit_" + popup_basket_id).first().val();
        $.ajax({
            type: "POST",
            url: "components/my-cart/my-cart-no-reload.php",
            data: {
                quant: newQuantity,
                pid: $(document).find("#popup_basket_code_" + popup_basket_id).first().val(),
                articul: $(document).find("#popup_basket_articul_" + popup_basket_id).first().val(),
                price: popupBasketPriceVal,
                unit: popupBasketUnit,
            },
            success: function (data) {
                const spacedProductPrice = addSpaceToNumber(newPopupBasketPrice);
                $(document).find("#popup_basket_price_front_" + popup_basket_id).text(`${spacedProductPrice} ₴`);

                const spacedTotalPrice = addSpaceToNumber(newTotalPrice);
                $(document).find(".basket_price_sum").text(`${spacedTotalPrice} ₴`);
                updateMainQuantityOnMyCartPage();
            },
        });
    }


    // Update price and quantity in header basket by buttons
    $(document).on(
        "click",
        ".basket_block_ul_item_info_row_quantity_btn",
        function () {
            const isPlus = $(this).text().trim() == '+';
            const popup_basket_id = $(this).attr("data-id");
            // Quantity 
            const quantityInput = $(document).find("#popup_basket_quantity_" + popup_basket_id);

            let getQuantity = parseInt(quantityInput.val());
            let newQuantity = isPlus ? getQuantity + 1 : getQuantity - 1;

            if (quantityInput.val() == '' || quantityInput.val() == null) {
                getQuantity = parseInt(quantityInput.attr('data-old'));
                newQuantity = 1;
            }

            updatePopupBasketListOnFront(popup_basket_id, getQuantity, newQuantity);
            return false;
        }
    );


    // Update price and quantity in header basket by input
    $(document).on(
        "input",
        ".basket_block_ul_item_info_row_quantity_input",
        function () {
            // Quantity 
            const thisVal = $(this).val();
            if (thisVal == '' || thisVal == null) {
                return
            } else {
                const popup_basket_id = $(this).attr("data-id");
                const newQuantity = parseInt($(this).val());
                const getOldQuantity = parseInt($(this).attr('data-old'));
                updatePopupBasketListOnFront(popup_basket_id, getOldQuantity, newQuantity);
            }
            return false;
        }
    );


    // Delete product from popup basket
    $(document).on(
        "click",
        ".basket_block_ul_item_remove",
        function () {
            const popup_basket_id = $(this).attr("data");

            $.ajax({
                type: "POST",
                url: "components/my-cart/my-cart-no-reload.php",
                data: {
                    isDelete: true,
                    pid: $("#popup_basket_code_" + popup_basket_id).val(),
                    articul: $("#popup_basket_articul_" + popup_basket_id).val(),
                },
                success: function (results) {
                    updatePopupBasketList(results);
                },
            });
            return false;
        }
    );


    // Small product card add to cart 
    $(document).on(
        "click",
        ".product_small_card_footer_basket",
        function (e) {
            const thisClass = $(this).attr('class');
            const isInBasket = thisClass.includes('product_small_card_footer_basket_active');

            if (isInBasket) {
                return (document.location = "my-cart");
            } else {
                $(this).attr('title', 'Оформити замовлення');
                $(this).addClass('product_small_card_footer_basket_active');

                const thisPrice = removeSpaceFromNumber($(this).attr('data-prices'));
                $.ajax({
                    type: "POST",
                    url: "components/my-cart/my-cart-no-reload.php",
                    data: {
                        pid: $(this).attr('data-code'),
                        articul: $(this).attr('data-articul'),
                        price: thisPrice,
                        quant: 1,
                        unit: $(this).attr('data-unit'),
                    },
                    success: function (results) {
                        updatePopupBasketList(results);
                    },
                });
            }
        }
    );
}