<div id="about_company_wrapper" class="aboutUs_wrapper">

    <div class="about_company">
        <!-- Title -->
        <h2 class="about_company_title">
            <b data-edit='about_company_title_bold'>
                <?=html_entity_decode($parsedData['about_company_title_bold'])?>
            </b>
            <span data-edit='about_company_title_simple'>
                <?=html_entity_decode($parsedData['about_company_title_simple'])?>
            </span>
        </h2>
        <!-- Content -->
        <div class="about_company_block">
            <div class="about_company_block_images">
                <div class='about_company_block_images_item' data-visible>
                    <img src="<?=$parsedData['about_company_block_image_1']?>" data-edit='about_company_block_image_1'
                        width="100%" height="100%" />
                </div>
                <div class='about_company_block_images_item' data-visible>
                    <img src="<?=$parsedData['about_company_block_image_2']?>" data-edit='about_company_block_image_2'
                        width="100%" height="100%" />
                </div>
            </div>

            <!-- Text content -->
            <div class="about_company_block_text">
                <!-- 1 -->
                <div class="about_company_block_text_item">
                    <h2 data-edit='about_company_secondary_title_1'>
                        <?=html_entity_decode($parsedData['about_company_secondary_title_1'])?>
                    </h2>
                    <p data-edit='about_company_secondary_text_1'>
                        <?=html_entity_decode($parsedData['about_company_secondary_text_1'])?>
                    </p>
                </div>
                <!-- 2 -->
                <div class="about_company_block_text_item">
                    <h2 data-edit='about_company_secondary_title_2'>
                        <?=html_entity_decode($parsedData['about_company_secondary_title_2'])?>
                    </h2>
                    <p data-edit='about_company_secondary_text_2'>
                        <?=html_entity_decode($parsedData['about_company_secondary_text_2'])?>
                    </p>

                    <p data-edit='about_company_secondary_text_3'>
                        <?=html_entity_decode($parsedData['about_company_secondary_text_3'])?>
                    </p>

                </div>

            </div>
        </div>

        <!-- Bottom image -->
        <div class='about_company_bottom_img' data-visible>
            <img src="<?=$parsedData['about_company_bottom_img']?>" data-edit='about_company_bottom_img' width="100%"
                height="100%" />
        </div>
    </div>

</div>