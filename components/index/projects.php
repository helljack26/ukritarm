<?require_once 'function.php';?>

<div class="projects">
    <div class="projects_block">

        <h3 class="projects_block_header">

            <span data-edit='projects_block_header_1'>
                <?=html_entity_decode($parsedData['projects_block_header_1'])?>
            </span>
            <span data-edit='projects_block_header_2'>
                <?=html_entity_decode($parsedData['projects_block_header_2'])?>
            </span>
        </h3>

        <!-- Services results -->
        <div class="projects_block_row_wrapper">
            <div class="projects_block_row_results">

                <!-- 1 -->
                <div class="projects_item" data-visible>
                    <div class="projects_item_image">
                        <img src="<?=$parsedData['project_img_1']?>" data-edit='project_img_1' width="100%"
                            height="100%">
                    </div>

                    <span class="projects_item_name" data-edit='project_name_1'>
                        <?=html_entity_decode($parsedData['project_name_1'])?>
                    </span>
                </div>

                <!-- 2 -->
                <div class="projects_item" data-visible>
                    <div class="projects_item_image">
                        <img src="<?=$parsedData['project_img_2']?>" data-edit='project_img_2' width="100%"
                            height="100%">
                    </div>

                    <span class="projects_item_name" data-edit='project_name_2'>
                        <?=html_entity_decode($parsedData['project_name_2'])?>
                    </span>
                </div>

                <!-- 3 -->
                <div class="projects_item" data-visible>
                    <div class="projects_item_image">
                        <img src="<?=$parsedData['project_img_3']?>" data-edit='project_img_3' width="100%"
                            height="100%">
                    </div>

                    <span class="projects_item_name" data-edit='project_name_3'>
                        <?=html_entity_decode($parsedData['project_name_3'])?>
                    </span>
                </div>

            </div>
        </div>
        <!-- Link to projects -->
        <a href="aboutus#gallery" class="projects_block_link">
            Перейти до галереї
        </a>
    </div>
</div>