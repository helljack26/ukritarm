<div id="manufacture_wrapper" class="aboutUs_wrapper">
    <div class="manufacture">
        <!-- Title -->
        <div class="manufacture_title">
            <h2>
                <b data-edit='manufacture_title_bold'>
                    <?=html_entity_decode($parsedData['manufacture_title_bold'])?>
                </b>
                <span data-edit='manufacture_title_simple'>
                    <?=html_entity_decode($parsedData['manufacture_title_simple'])?>
                </span>
            </h2>
        </div>

        <!-- Images -->
        <div class="manufacture_images">
            <div class='manufacture_images_item' data-visible>
                <img src="<?=$parsedData['manufacture_image_1']?>" data-edit='manufacture_image_1' width="100%"
                    height="100%" />
            </div>
            <div class='manufacture_images_item' data-visible>
                <img src="<?=$parsedData['manufacture_image_2']?>" data-edit='manufacture_image_2' width="100%"
                    height="100%" />
            </div>
            <div class='manufacture_images_item' data-visible>
                <img src="<?=$parsedData['manufacture_image_3']?>" data-edit='manufacture_image_3' width="100%"
                    height="100%" />
            </div>
            <div class='manufacture_images_item' data-visible>
                <img src="<?=$parsedData['manufacture_image_4']?>" data-edit='manufacture_image_4' width="100%"
                    height="100%" />
            </div>
        </div>

        <!-- Text  -->
        <div class='manufacture_text' style="background-image: url(../../images/about_manufacture_bg.jpg);">
            <div class="manufacture_text_block">

                <img src="<?=$parsedData['manufacture_image_5']?>" data-edit='manufacture_image_5'>

                <div data-edit="manufacture_text">
                    <?=html_entity_decode($parsedData['manufacture_text'])?>
                </div>
            </div>
        </div>
    </div>
</div>