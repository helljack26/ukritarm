<div class="aboutIntro" style="background-image: url(../../images/aboutus_bg.png);">
    <div class="aboutIntro_info">
        <div class="aboutIntro_info_block">
            <div class="aboutIntro_info_block_item">
                <h1 data-edit='aboutIntro_main_header'>
                    <?=html_entity_decode($parsedData['aboutIntro_main_header'])?>
                </h1>
            </div>
            <div class="aboutIntro_info_block_item">
                <div class="aboutIntro_info_block_item_title" data-edit='aboutIntro_secondary_title'>
                    <?=html_entity_decode($parsedData['aboutIntro_secondary_title'])?>
                </div>
                <div class="aboutIntro_info_block_item_text" data-edit='aboutIntro_text'>
                    <?=html_entity_decode($parsedData['aboutIntro_text'])?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about_tabs">
    <div class="about_tabs_links">
        <button type="button" id="btn_about_company">
            <span class='about_tabs_links_desktop' data-edit='aboutIntro_tab_1_desk'>
                <?=html_entity_decode($parsedData['aboutIntro_tab_1_desk'])?>
            </span>
            <span class='about_tabs_links_mobile' data-edit='aboutIntro_tab_1_mobile'>
                <?=html_entity_decode($parsedData['aboutIntro_tab_1_mobile'])?>
            </span>
        </button>
        <button type="button" id="btn_manufacture" data-edit='aboutIntro_tab_2'>
            <?=html_entity_decode($parsedData['aboutIntro_tab_2'])?>
        </button>
        <button type="button" id="btn_gallery">
            <span class='about_tabs_links_desktop' data-edit='aboutIntro_tab_3_desk'>
                <?=html_entity_decode($parsedData['aboutIntro_tab_3_desk'])?>
            </span>
            <span class='about_tabs_links_mobile' data-edit='aboutIntro_tab_3_mobile'>
                <?=html_entity_decode($parsedData['aboutIntro_tab_3_mobile'])?>
            </span>
        </button>
    </div>
</div>