<div class="aboutUs" style="background-image: url(../../images/about_bg.png);">

    <!-- Content -->
    <div class="aboutUs_info">
        <div class="aboutUs_info_block">

            <div class="aboutUs_info_block_item">
                <h2 class="aboutUs_info_block_item_title">
                    <span data-edit='aboutUs_main_title_1'>
                        <?=html_entity_decode($parsedData['aboutUs_main_title_1'])?>
                    </span>
                    <span data-edit='aboutUs_main_title_2'>
                        <?=html_entity_decode($parsedData['aboutUs_main_title_2'])?>
                    </span>
                </h2>

                <p data-edit='aboutUs_main_text'>
                    <?=html_entity_decode($parsedData['aboutUs_main_text'])?>
                </p>
            </div>

            <!-- Наші партнери -->
            <div class="aboutUs_info_block_item">
                <h3 class="aboutUs_info_block_item_subtitle">
                    <span data-edit='aboutUs_secont_title_1'>
                        <?=html_entity_decode($parsedData['aboutUs_secont_title_1'])?>
                    </span>
                    <span data-edit='aboutUs_secont_title_2'>
                        <?=html_entity_decode($parsedData['aboutUs_secont_title_2'])?>
                    </span>
                </h3>
                <div class="aboutUs_info_block_item_row">
                    <div class="aboutUs_info_block_item_row_img">
                        <img src="<?=$parsedData['aboutUs_partner_1']?>" data-edit='aboutUs_partner_1'
                            alt="<?=$parsedData['aboutUs_partner_1']?>">
                    </div>
                    <div class="aboutUs_info_block_item_row_img">
                        <img src="<?=$parsedData['aboutUs_partner_2']?>" data-edit='aboutUs_partner_2'
                            alt="<?=$parsedData['aboutUs_partner_2']?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Line bottom -->
    <span class="aboutUs_line_bottom"></span>
</div>