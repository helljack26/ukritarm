<!-- aboutUs_wrapper -->
<div id="gallery_wrapper" class="aboutUs_wrapper">
    <div class="gallery">
        <!-- Title -->
        <div class="gallery_title">
            <h2>
                <span data-edit='gallery_title_simple1'>
                    <?=html_entity_decode($parsedData['gallery_title_simple1'])?>
                </span>

                <b data-edit='gallery_title_bold'>
                    <?=html_entity_decode($parsedData['gallery_title_bold'])?>
                </b>

                <span data-edit='gallery_title_simple2'>
                    <?=html_entity_decode($parsedData['gallery_title_simple2'])?>
                </span>
            </h2>
            <p data-edit='gallery_text_simple'>
                <?=html_entity_decode($parsedData['gallery_text_simple'])?>
            </p>
        </div>

        <!-- Images -->
        <div class="gallery_images">
            <div class="gallery_images_block">
                <?  
                    $projectItem = [];

                    foreach ($parsedData as $key => $value) {
                        $num_of_item = preg_replace( '/[^0-9]/', '', $key );

                        if (strpos($key, 'project_img_') !== false) {
                            $projectItem[$num_of_item]['img'] = $value; 
                        }
                        if (strpos($key, 'project_name_') !== false) {
                            $projectItem[$num_of_item]['name'] = $value; 
                            
                        }
                    };
                    foreach ($projectItem as $id => $project) {
                ?>
                <div class="projects_item" data-visible>
                    <div class="projects_item_image">
                        <img src="<?= $project['img'];?>" data-edit='project_img_<?=$id?>' width="100%" height="100%">
                    </div>

                    <span class="projects_item_name" data-edit='project_name_<?=$id?>'>
                        <?= $project['name'];?>
                    </span>
                </div>
                <? }?>

            </div>
        </div>
    </div>
</div>