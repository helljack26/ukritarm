<?
    $rawAverageRating = getAverageRating($con, $c_code);
    $averageRating = $rawAverageRating['averageRating'];
    $rating_number = intval($rawAverageRating['num']);
?>

<div class="product_reviewDescription">
    <!-- Tab -->
    <div class="product_reviewDescription_header">
        <button type="button" class="product_reviewDescription_header_btn product_reviewDescription_header_btn_active">
            Все про товар
        </button>

        <?if($c_attributes !== '[]'):?>
        <button type="button"
            class="product_reviewDescription_header_btn product_reviewDescription_header_btn_description">
            Характеристики
        </button>
        <?endif;?>

        <button type="button" class="product_reviewDescription_header_btn product_reviewDescription_header_btn_review">
            Відгуки
            <?=$rating_number > 0 ? "($rating_number)": '';?>
        </button>
    </div>


    <div class="product_reviewDescription_block">
        <!-- All about product -->
        <div id="product_reviewDescription_block_item_allAbout" class="product_reviewDescription_block_item ">

            <!-- Зображення -->
            <div class="item_allAbout_images">
                <h3 data-edit='product_tab_title_1'>
                    <?=html_entity_decode($parsedPageContent['product_tab_title_1'])?>
                </h3>
                <div class="item_allAbout_images_block">

                    <?if (strlen($c_photo_main) > 0) :?>
                    <div class="item_allAbout_images_item">
                        <img src="images/<?=$c_photo_main?>" />
                    </div>
                    <? endif;?>

                    <?if (strlen($raw_product_image_secondary) > 0) :
                        $i=0;
                        foreach ($product_image_secondary as $imageName):
                        $i++;
                    ?>
                    <div class="item_allAbout_images_item" data-id='<?=$i?>'>
                        <img src="images/<?=$imageName?>" />
                    </div>
                    <? endforeach; endif;?>
                </div>
            </div>

            <? 
            $isShowAllAboutInfo = !$isAdminEditPage ? true : strlen($c_description) > 5 || $c_attributes_count > 0; 
            
            if ($isShowAllAboutInfo):?>
            <div class="item_allAbout_info">
                <!-- Опис -->
                <? if (strlen($c_description) > 5 ):?>
                <div class="item_allAbout_info_item item_allAbout_info_item_about">
                    <h3 data-edit='product_tab_title_2'>
                        <?=html_entity_decode($parsedPageContent['product_tab_title_2'])?>
                    </h3>
                    <p>
                        <?=$c_description?>
                    </p>
                </div>
                <?endif;?>

                <!-- Характеристики -->
                <?if($c_attributes !== '[]'):?>
                <div class="item_allAbout_info_item item_allAbout_info_item_characteristic">
                    <div class="item_allAbout_info_item_header">
                        <h3 data-edit='product_tab_title_3'
                            class='<?if ($c_attributes_count > 5) echo("item_allAbout_info_item_header_characteristic");?>'>
                            <?=html_entity_decode($parsedPageContent['product_tab_title_3'])?>
                        </h3>
                        <?
                        // Show button only if more than 5
                        if ($c_attributes_count > 5):?>
                        <button id="show_all_attributes" type="button">
                            Дивитись всі
                        </button>
                        <? endif;?>
                    </div>

                    <?php
                        $i=0;                        
                        foreach($attributesDecoded as $key => $value): 
                        $i++;
                        if($i <= 5):
                    ?>
                    <div class="product_reviewDescription_block_item_attributes_row">
                        <span>
                            <?=cleanName($value['name']).': '?>
                        </span>
                        <span>
                            <?=$value['value']?>
                        </span>
                    </div>

                    <?endif; endforeach;?>
                </div>
                <?endif;?>
            </div>
            <?endif;?>

        </div>

        <!-- Attributes -->
        <div id="product_reviewDescription_block_item_attributes" class="product_reviewDescription_block_item">
            <?php
            // Read the elements of the associative array
            foreach($attributesDecoded as $key => $value ): ?>
            <div class="product_reviewDescription_block_item_attributes_row">
                <span>
                    <?=(cleanName($value['name']).': ')?>
                </span>
                <span>
                    <?=$value['value']?>
                </span>
            </div>

            <?endforeach?>
        </div>

        <!-- Review -->
        <div id="product_reviewDescription_block_item_review" class="product_reviewDescription_block_item">
            <div class="product_reviewDescription_block_item_review_row">
                <? 
                $isAdminEditPage2 = isset($_GET['edit_page_content']);

                if($rating_number > 0 || $isAdminEditPage2):?>
                <div class="product_reviewDescription_block_item_reviews">
                    <div class="product_reviewDescription_block_item_reviews_header">
                        <h3>
                            <span data-edit='product_tab_title_7'>
                                <?=html_entity_decode($parsedPageContent['product_tab_title_7'])?>
                            </span> (<?=$rating_number?>)
                        </h3>

                        <span class='reviews_item_rate'>
                            <? getAverageRatingStars($averageRating) ?>
                        </span>
                    </div>

                    <? $get_product_reviews = mysqli_query($con,"SELECT * 
                                                                    FROM productreviews 
                                                                    WHERE productId='$c_code' 
                                                                    ORDER BY reviewDate DESC
                                                                    ");
                        $j = 0;
                        while($row_product_reviews = mysqli_fetch_array($get_product_reviews)):
                            $j++;
                            if ($j <= 2) {
                                include('review_item.php');
                            }
                        endwhile;
                    
                        $k = 0;
                        if ($j > 2){
                            $get_product_reviews2 = mysqli_query($con,"SELECT * 
                                                                        FROM productreviews 
                                                                        WHERE productId='$c_code' 
                                                                        ORDER BY reviewDate DESC
                                                                        ");
                        ?>
                    <div class='product_reviewDescription_block_item_reviews_hidden'>

                        <? while($row_product_reviews = mysqli_fetch_array($get_product_reviews2)){
                            $k++;
                            if ($k > 2) {
                                include('review_item.php');
                            }
                        }
                        ?>
                    </div>

                    <?if ($j > 2): ?>
                    <button type="button" class="product_reviewDescription_block_item_reviews_more_btn">
                        Показати ще <span><?=$rating_number - 2?></span> відгуки
                    </button>
                    <? endif;?>

                    <?}?>
                </div>
                <? endif;?>


                <!-- Review form -->
                <form id="review_form" role="form" name="review" method="post" autocomplete="off"
                    class="<? if($rating_number == 0 ){ echo('review_form_extended'); } ?>">
                    <input type="hidden" value='<?= $c_code?>' id="product_header_code">

                    <!-- Modal Дякуємо за відгук -->
                    <div id="review_form_success" class="product_reviewDescription_block_item_success">
                        <div class="product_reviewDescription_block_item_success_header">
                            <h2>
                                Дякуємо за відгук! &#10084;
                            </h2>
                        </div>
                        <span class="product_reviewDescription_block_item_success_body">
                            Ваш відгук дуже важливий для нас
                        </span>
                    </div>
                    <!-- Review form -->
                    <div class="product_reviewDescription_block_item_review_container">
                        <h4 data-edit='product_tab_title_4'>
                            <?=html_entity_decode($parsedPageContent['product_tab_title_4'])?>
                        </h4>
                        <div class="product_reviewDescription_block_item_review_header">
                            <h4>
                                Оцінка:
                            </h4>
                            <!-- Review rating -->
                            <div class="product_reviewDescription_block_item_review_star_container">
                                <div class="review_star_container_star"></div>
                                <div class="review_star_container_star"></div>
                                <div class="review_star_container_star"></div>
                                <div class="review_star_container_star"></div>
                                <div class="review_star_container_star"></div>
                            </div>
                        </div>
                        <div class="product_reviewDescription_block_item_review_form">
                            <div class="product_reviewDescription_block_item_review_form_item">
                                <label id="exampleInputName_label" for="exampleInputName">
                                    Ваше ім'я*
                                </label>
                                <input type="text" class="form-control txt" id="exampleInputName" name="name"
                                    required="required">
                            </div>
                            <div class="product_reviewDescription_block_item_review_form_item">
                                <label id="exampleInputEmail_label" for="exampleInputEmail">
                                    Email*
                                </label>
                                <input type="text" class="form-control txt" id="exampleInputEmail" name="email"
                                    required="required">
                            </div>
                        </div>
                        <div class="form_group">
                            <label id="exampleInputReview_label" for="exampleInputReview">
                                Відгук*
                            </label>
                            <textarea class="form-control" id="exampleInputReview" rows="3" name="review"
                                required="required"></textarea>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" id="review_form_submit" class="product_reviewDescription_block_item_submit">
                        Залишити відгук
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>