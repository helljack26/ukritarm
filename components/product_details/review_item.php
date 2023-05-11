<div class="block_item_reviews_item">
    <!-- Name and date -->
    <div class="block_item_reviews_item_col">
        <!-- Name -->
        <span class='block_item_reviews_item_name'>
            <?= $row_product_reviews['name']?>
        </span>
        <!-- Date -->
        <span class='block_item_reviews_item_date'>
            <? $rawReviewDate = explode(" ", $row_product_reviews['reviewDate']);
                $splitedDate =explode("-", $rawReviewDate[0]); 
                echo($splitedDate[2] . '.' . $splitedDate[1] . '.' . $splitedDate[0] );
            ?>
        </span>
    </div>

    <!-- Star and review text -->
    <div class="block_item_reviews_item_col">
        <!-- Rate -->
        <span class='block_item_reviews_item_rate'>
            <? 
                for ($i = 1; $i < 6 ; $i++) {
                    if ($i <= $row_product_reviews['value']) {
                        echo('<div class="block_item_reviews_item_rate_star reviews_item_rate_star_checked"></div>');
                    } else {
                        echo('<div class="block_item_reviews_item_rate_star"></div>');
                    } 
                }
            ?>
        </span>
        <span class='block_item_reviews_item_text'>
            <?= ($row_product_reviews['review'])?>
        </span>
    </div>

</div>