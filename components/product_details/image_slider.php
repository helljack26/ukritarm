<div class="product_row_col">
    <div class="product_row_col_sticky">

        <!-- Image slider -->
        <div class="product_row_col_slider">
            <!--  -->
            <?if (strlen($c_photo_main) > 0) :?>
            <div class="product_row_col_slider_item">
                <img src="images/<?=$c_photo_main?>" />
            </div>
            <? endif;?>

            <?if (strlen($raw_product_image_secondary) > 0):
                foreach ($product_image_secondary as $imageName):
            ?>
            <div class="product_row_col_slider_item">
                <img src="images/<?=$imageName?>" />
            </div>
            <? endforeach; 
            endif;?>
        </div>
    </div>

</div>