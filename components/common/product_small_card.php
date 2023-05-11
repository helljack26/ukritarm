<?
    $s_product_name = codeToQuote($row_product_card_item['product_name']);
    $s_product_articul = codeToQuote($row_product_card_item['product_articul']);
    $s_product_articul_name = codeToQuote($row_product_card_item['product_articul_name']);

    $s_productLink = generateProductDetailsUrl($s_product_name, $row_product_card_item['product_articul']);

    $s_product_name = generateProductName($s_product_name, $s_product_articul_name, $s_product_articul);
    
    // Price
    $product_product_price = htmlentities($row_product_card_item['product_price']);
    $product_product_price = floatval($product_product_price);
    $product_product_price = addSpaceForThousands($product_product_price);

    $product_price_before_discount = htmlentities($row_product_card_item['product_price_before_discount']);
    $product_price_before_discount = floatval($product_price_before_discount);
    $product_price_before_discount = addSpaceForThousands($product_price_before_discount);
?>

<div class="product_small_card item<?=$row_product_card_item['id']?>" data-hash="<?=$row_product_card_item['id']?>">

    <div class="<?php if($row_product_card_item['product_availability'] == 0){ echo('product_small_card_disabled');}?>">
        <!-- Product image -->
        <div class="product_small_card_image">
            <a href="<?=$s_productLink?>">
                <img src="images/<?=$row_product_card_item['product_image']?>"
                    data-echo="images/<?=$row_product_card_item['product_image']?>" height="250px">
            </a>
        </div>

        <div class="product_small_card_info">
            <!-- Product name -->
            <h3 class="product_small_card_info_name">
                <a href="<?=$s_productLink?>">
                    <?= htmlentities($s_product_name);?>
                </a>
            </h3>

            <!-- Product rating -->
            <?php                     
                $getReviewNums = discountReview($con, $row_product_card_item['product_code']);
                $averageRating = $getReviewNums[0]; 
                $discountReviewsNum = $getReviewNums[1];

                if($averageRating > 5){
                    $averageRating = round($averageRating / 5);
                }
                {
            ?>
            <div class="product_small_card_info_reviews">
                <? if ($discountReviewsNum == 0) :?>
                <div class="reviews">
                    <a href="<?=$s_productLink?>#review">
                        <span class='content_info_reviews_icon'></span>
                        Залишити відгук
                    </a>
                </div>
                <? else: ?>
                <span class='reviews_item_rate'>
                    <?  for ($i = 1; $i < 6 ; $i++) {
                            if ($i <= $averageRating) {
                                echo('<div class="reviews_item_rate_star reviews_item_rate_star_checked"></div>');
                            } else {
                                echo('<div class="reviews_item_rate_star"></div>');
                            } 
                        }
                    ?>
                </span>
                <div class="reviews">
                    <span class="lnk"><?= htmlentities($discountReviewsNum);?> відгук</span>
                </div>
                <? endif; ?>
            </div>
            <?php } ?>
        </div>

        <!-- Product buttons -->
        <div class="product_small_card_footer">

            <!-- Product price -->
            <div class="product_small_card_footer_price">
                <div class="product_small_card_footer_price_col">

                    <? if($product_price_before_discount > 0 && $row_product_card_item['product_availability'] > 0):?>
                    <span class="product_small_card_footer_price_col_discount">
                        <?=$product_price_before_discount;?> ₴
                        <span></span>
                    </span>
                    <span class="product_small_card_footer_price_col_text">
                        <?= $product_product_price;?> ₴
                    </span>
                    <?else:?>
                    <span class="product_small_card_footer_price_col_text_large">
                        <?= $product_product_price;?> ₴
                    </span>
                    <?endif;?>
                </div>

                <!-- If not available -->
                <?php if($row_product_card_item['product_availability'] == 0){?>
                <span class="product_small_card_footer_price_unaveilable">
                    Немає в наявності
                </span>
                <?php } ?>

            </div>

            <!-- Buy button -->
            <?php 
            $isAvailable = $row_product_card_item['product_availability'] >=1;
            $isInBasket = isExistInBasket($row_product_card_item['product_code'], $row_product_card_item['product_articul']) != 'Купити';
            
            $isActiveTitle = $isInBasket ? 'Оформити замовлення' : 'Додати в кошик';
            $isActiveClass = $isInBasket ? 'product_small_card_footer_basket_active' : '';
            
            if($isAvailable === true){?>
            <!-- Buy button -->
            <button type="button" data-prices="<?= htmlentities($row_product_card_item['product_price']);?>"
                data-unit="<?= $row_product_card_item['main_value']?>"
                data-code="<?= $row_product_card_item['product_code']?>"
                data-articul="<?= $row_product_card_item['product_articul']?>" title="<?= $isActiveTitle?>"
                class="product_small_card_footer_basket <?= $isActiveClass?>">
            </button>
            <?php } ?>
        </div>
    </div>
</div>