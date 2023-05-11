<?require_once 'function.php'; ?>

<div class="popularProduct">
    <div class="popularProduct_row">

        <h3 class="popularProduct_header">
            <span data-edit='product_popularProduct_title_1'>
                <?=html_entity_decode($parsedPageContent['product_popularProduct_title_1'])?>
            </span>
        </h3>

        <div id="popularProduct_slider" class="popularProduct_slider">

            <?php
            $ret=mysqli_query($con,"SELECT * FROM products 
                                                WHERE category='$c_category_id' 
                                                AND sub_category='$c_sub_сategory_id'
                                                AND product_code != '$c_code'
                                                GROUP BY product_code
                                                LIMIT 10
                                                ");
            $num=mysqli_num_rows($ret);

            if($num>0):
                $i=0;
                while($row_product_card_item=mysqli_fetch_array($ret)):
                    include 'components/common/product_small_card.php';
                endwhile;
            endif; ?>
        </div>
    </div>
</div>