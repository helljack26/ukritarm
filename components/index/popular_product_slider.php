<?require_once 'function.php';?>

<div class="popularProduct">
    <div class="popularProduct_row">

        <h3 class="popularProduct_header">
            <span data-edit='popularProduct_title_1'>
                <?=html_entity_decode($parsedData['popularProduct_title_1'])?>
            </span>
            <span data-edit='popularProduct_title_2'>
                <?=html_entity_decode($parsedData['popularProduct_title_2'])?>
            </span>
        </h3>

        <div id="popularProduct_slider" class="popularProduct_slider">
            <?php
            $getPromoProducts=mysqli_query($con,"SELECT * 
                                                    FROM products 
                                                    WHERE show_on_index = '1'
                                                    GROUP BY product_code
                                                    ");
            $numPromoProducts=mysqli_num_rows($getPromoProducts);
            if($numPromoProducts>0):
                $i=0;
                while($row_product_card_item=mysqli_fetch_array($getPromoProducts)):
                    include 'components/common/product_small_card.php';
                endwhile; 
            endif;
        ?>
        </div>

        <!-- Slider for links -->
        <div id="popularProduct_slider_links" class="popularProduct_slider_links">
            <?php
                $ret=mysqli_query($con,"SELECT * 
                                        FROM products 
                                        WHERE show_on_index = '1'
                                        GROUP BY product_code
                                        ");
                $num=mysqli_num_rows($ret);
                if($num>0):
                    $i = 0;
                    while($row = mysqli_fetch_array($ret)): 
                        $s_product_name = codeToQuote($row['product_name']);

                        $s_productLink = generateProductDetailsUrl($s_product_name, $row['product_articul']);    
            ?>
            <!-- To product details -->
            <a class="popularProduct_slider_links_link link<?=$row['id']?>" href="<?=$s_productLink?>">
                До сторінки товару
            </a>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>