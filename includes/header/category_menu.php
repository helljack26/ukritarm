<div class="header_hidden_menu header_hidden_menu_category">
    <div class="header_category_menu">
        <?php
            $getAllCat = mysqli_query($con,"SELECT * FROM category");
            while ($rowAllCat = mysqli_fetch_array($getAllCat)):
                $cat_id = $rowAllCat['id'];
                $cat_name = $rowAllCat['categoryName'];
        ?>
        <!-- All category item -->
        <div class="header_category_menu_item">

            <!-- Item header -->
            <a href="category/<?=transliterate($cat_name);?>" class="header_category_menu_item_header">
                <?=$cat_name?>
            </a>

            <!-- Subcategory block -->
            <? $getSubCat = mysqli_query($con,"SELECT * 
                                                    FROM subcategory 
                                                    WHERE categoryid='$cat_id'
                                                    ");
                    while ($rowSubCat = mysqli_fetch_array($getSubCat)):
                    $subCatName = $rowSubCat['subcategory'];
                ?>
            <a href="sub-category/<?=transliterate($subCatName)?>" class="header_category_menu_item_link">
                <?=$subCatName?>
            </a>
            <?endwhile;?>
        </div>

        <?endwhile;?>
    </div>
    <a href="images/<?=getCatalogueName()?>" class="catalogue_link" download>
        Завантажити каталог
    </a>

</div>