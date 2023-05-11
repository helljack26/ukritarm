<div class='product_row_col'>
    <div class="product_info">
        <? if(check_mobile_device() == false): ?>
        <div class="desktop_header">
            <?php include('product_name.php');?>
        </div>
        <?endif;?>


        <!-- Is available -->
        <?  $isAvailable = $c_availability == 1; ?>
        <span class="product_info_availability" style='<?= !$isAvailable ? 'color: grey;' : '';?>'>
            <?= $isAvailable ? "В наявності" : "Немає в наявності"; ?>
        </span>

        <!-- Articul -->
        <? $get_articul_from_db=mysqli_query($con,"SELECT product_articul, product_articul_name, product_availability, product_name
                                                    FROM products 
                                                    WHERE product_code='$c_code'
                                                    ");
            $chars_num=mysqli_num_rows($get_articul_from_db);
            if ($chars_num > 1): 
        ?>
        <div class="product_info_char">
            <? while($row_articul = mysqli_fetch_array($get_articul_from_db)): 
                $product_name_art = $row_articul['product_name'];
                $product_articul = $row_articul['product_articul'];
                $product_articul_name = $row_articul['product_articul_name'];
                $product_availability = $row_articul['product_availability']; 
                // Link state 
                $isActiveCharId = transliterate($product_articul) == transliterate($c_product_articul) ? 'id="product_info_char_button_active"' : '';
                $isDisableChar = intval($product_availability) == 0 ? 'product_info_char_button_disable' : '';
                if (strlen($product_articul) > 0):
            ?>

            <a <?=$isActiveCharId?> href="<?=generateProductDetailsUrl($product_name_art, $product_articul)?>"
                class="product_info_char_button <?=$isDisableChar?>">
                <?=$product_articul_name?>
            </a>

            <?endif; endwhile; ?>
        </div>
        <? endif; ?>

        <!-- Price  -->
        <div class="product_info_price">

            <? // With discount
            if($c_old_price >= 1):?>
            <div class="product_info_price_row">
                <span class="product_info_price_row_old">
                    <!-- Diagonal line -->
                    <span></span>
                    <?= htmlentities(addSpaceForThousands($c_old_price));?>
                    <?=html_entity_decode($parsedPageContent['product_price_currency'])?>
                </span>
                <span class="product_info_price_row_discount">
                    <?=getDiscountPercent ($c_old_price, $c_price);?>
                    <?=html_entity_decode($parsedPageContent['product_price_currency'])?>
                </span>
            </div>

            <? // Without discount ?>
            <? endif; ?>

            <span class="product_info_price_main prices" data="<?=$c_price?>">
                <?=addSpaceForThousands($c_price)?>
                <span data-edit='product_price_currency'>
                    <?=html_entity_decode($parsedPageContent['product_price_currency'])?>
                </span>
            </span>
        </div>

        <!-- Count and value -->
        <div class="product_info_row" style='<?=$isAvailable ? '' : 'display:none' ?>'>
            <div class="product_info_row_count">
                <span>Кількість:</span>

                <!-- Count -->
                <div class="count_container">
                    <input type="number" class="count_container_input quant" min="1" name="quantity" value="1">
                    <div class="count_container_arrows">
                        <button type="button" class="count_container_arrow_plus plus"></button>
                        <button type="button" class="count_container_arrow_minus minus"></button>
                    </div>
                </div>
            </div>

            <!-- Value select show if  -->
            <select class="product_info_select select_tb" name="product_unit">
                <option data="<?=$c_main_value?>" value="<?=$c_price, $c_main_value?>">
                    <?=$c_main_value?>
                </option>
                <? if ($c_main_value !== $c_second_value && $c_second_value != ''): ?>
                <option data="<?=$c_second_value?>" value="<?=$c_second_price, $c_second_value?>">
                    <?=$c_second_value?>
                </option>
                <?endif;?>
            </select>
        </div>

        <!-- Buttons -->
        <div class="product_info_buttons">
            <?php if($c_availability >= 1){
                $isExist = isExistInBasket($c_code, $c_product_articul);
                $isActiveClass = $isExist != 'Купити' ? 'product_buy_button_active' : '';
            ?>
            <button type="button" class="product_buy_button <?=$isActiveClass?>" data-code="<?= $c_code;?>"
                data-articul='<?=$c_product_articul?>'>
                <?=$isExist;?>
            </button>
            <?php } else {?>
            <!-- <button type="button" class="product_info_isAvailable" data-product-code="<?//$c_code?>"
                data-articul='<? //$c_product_articul?>'>
                Уточнити наявність
            </button> -->
            <?php } ?>
        </div>

        <!-- Delivery -->
        <div class="product_info_delivery">
            <span class="product_info_delivery_title" data-edit='product_info_delivery_title_delivery'>
                <?=html_entity_decode($parsedPageContent['product_info_delivery_title_delivery'])?>

            </span>

            <!--  -->
            <div class="product_info_delivery_item">
                <span class="product_info_delivery_item_title before_icon_self_pickup"
                    data-edit='product_info_delivery_pickup_1'>
                    <?=html_entity_decode($parsedPageContent['product_info_delivery_pickup_1'])?>

                </span>
                <span class='product_info_delivery_item_text' data-edit='product_info_delivery_pickup_2'>
                    <?=html_entity_decode($parsedPageContent['product_info_delivery_pickup_2'])?>

                </span>
            </div>

            <!-- Nova poshta -->
            <div class="product_info_delivery_item">
                <span class="product_info_delivery_item_title before_icon_np" data-edit='product_info_delivery_nova'>
                    <?=html_entity_decode($parsedPageContent['product_info_delivery_nova'])?>

                </span>
            </div>
        </div>

        <!-- Pay -->
        <div class="product_info_pay">
            <span class="product_info_pay_title" data-edit='product_info_title_payment'>
                <?=html_entity_decode($parsedPageContent['product_info_title_payment'])?>

            </span>
            <span class="product_info_pay_text" data-edit='product_info_payment_text_1'>
                <?=html_entity_decode($parsedPageContent['product_info_payment_text_1'])?>

            </span>
            <span class="product_info_pay_text" data-edit='product_info_payment_text_2'>
                <?=html_entity_decode($parsedPageContent['product_info_payment_text_2'])?>

            </span>
            <span class="product_info_pay_text" data-edit='product_info_payment_text_3'>
                <?=html_entity_decode($parsedPageContent['product_info_payment_text_3'])?>

            </span>
            <img src="./assets/icon/bank/bank_row.svg" width="260px" height="20px" alt="bank_row">
        </div>

        <!-- Refund -->
        <div class="product_info_refund">
            <span class="product_info_refund_title" data-edit='product_info_title_refund'>
                <?=html_entity_decode($parsedPageContent['product_info_title_refund'])?>

            </span>
            <div class="product_info_refund_item">
                <span data-edit='product_info_refund_1'>
                    <?=html_entity_decode($parsedPageContent['product_info_refund_1'])?>

                </span>
                <span data-edit='product_info_refund_2'>
                    <?=html_entity_decode($parsedPageContent['product_info_refund_2'])?>

                </span>
            </div>
        </div>
    </div>
</div>