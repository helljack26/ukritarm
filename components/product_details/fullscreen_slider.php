<div class="product_img_fullscreen_container">
    <div class="product_img_fullscreen_container_block">
        <button class="product_img_fullscreen_container_close" type="button"></button>
        <div class="product_img_fullscreen_header">
            <h2>
                <?= $c_product_name;?>
            </h2>
        </div>
        <!-- Sliders -->
        <div class="product_img_fullscreen">
            <!-- Large single image -->
            <div class="product_img_fullscreen_largeImg">
                <div class="product_img_fullscreen_largeImg_slider">

                    <?if (strlen($c_photo_main) > 0) :?>
                    <div class="product_img_fullscreen_largeImg_slider_item">
                        <img src="images/<?=$c_photo_main?>">
                    </div>
                    <? endif;?>

                    <!-- Secondary images -->
                    <?if (strlen($raw_product_image_secondary) > 0):
                        foreach ($product_image_secondary as $imageName):
                    ?>
                    <div class="product_img_fullscreen_largeImg_slider_item">
                        <img src="images/<?=$imageName?>" />
                    </div>
                    <? endforeach; 
                    endif;?>
                </div>
            </div>

            <!-- Small navigator slider -->
            <div class="product_img_fullscreen_slider">
                <div class="product_img_fullscreen_slider_item" data-id='0'>
                    <img src="images/<?=$c_photo_main?>">
                </div>

                <?if (strlen($raw_product_image_secondary) > 0) :
                    $i=0;
                    foreach ($product_image_secondary as $imageName):
                    $i++;
                ?>
                <div class="product_img_fullscreen_slider_item" data-id='<?=$i?>'>
                    <img src="images/<?=$imageName?>" />
                </div>
                <? endforeach; 
                endif;?>
            </div>
        </div>
    </div>
</div>