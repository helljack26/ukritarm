<?php
include('includes/config.php');
include('function.php');

// Real title 15
$page_data = getTitleGoogle();
$title_google = $page_data['title_google'];
// Real title end

// Data for social media
$get_soc_data = mysqli_query($con, "SELECT * from social_info_pages where newid='3'");

if ($get_soc_data) {
    $row_soc_data = mysqli_fetch_array($get_soc_data);
    $soc_title = $row_soc_data['title'];
    $soc_image = $row_soc_data['image'];
    $soc_description = $row_soc_data['soc_info_description'];
}
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <meta property="og:title" content="<?= $soc_title ?>" />
    <meta property="og:image" content="images/<?= $soc_image ?>" />
    <meta property="og:description" content="<? echo ($soc_description); ?>" />

    <meta name="description" content="<? echo ($soc_description); ?>">

    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title><?= $title_google ?></title>

    <?php include('includes/links.php'); ?>

    <link rel="stylesheet" href="assets/css/all_category.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php'); ?>

    <main>
        <div class="breadcrumbs_block">
            <a href='/'>
                Головна
            </a>
            <span>
                Продукція
            </span>
        </div>

        <h1>
            Категорії продукції
        </h1>

        <div class="allcategory_row">
            <?php
            $getAllCat = mysqli_query($con, "SELECT * FROM category");
            while ($rowAllCat = mysqli_fetch_array($getAllCat)) :
                $cat_id = $rowAllCat['id'];
                $cat_name = $rowAllCat['categoryName'];
                $cat_icon = $rowAllCat['image_url_index'];
                $cat_bg = $rowAllCat['image_bg'];
            ?>
            <!-- All category item -->
            <div class="allcategory_row_item">

                <!-- Item header -->
                <a href="category/<?= transliterate($cat_name); ?>" class="allcategory_row_item_header">
                    <img src="images/category/<?= $cat_icon ?>" alt="Iконка категорії <?= $cat_name ?>">
                    <span><?= $cat_name ?></span>
                </a>

                <!-- Subcategory block -->
                <div class="allcategory_row_item_block">
                    <!-- Bg on hover -->
                    <img src="images/category/<?=$cat_bg ?>" alt="Фон категорії <?= $cat_name ?> при наведенні">

                    <!-- Scroll block -->
                    <div class="allcategory_row_item_block_scroll">
                        <div class="allcategory_row_item_block_scroll_links">
                            <? $getSubCat = mysqli_query($con, "SELECT * FROM subcategory WHERE categoryid='$cat_id'");
                                while ($rowSubCat = mysqli_fetch_array($getSubCat)) :
                                    $subCatName = $rowSubCat['subcategory'];
                                ?>
                            <a href="sub-category/<?= transliterate($subCatName) ?>">
                                <?= $subCatName ?>
                            </a>
                            <? endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            <? endwhile; ?>
        </div>

        <a href="images/<?= getCatalogueName() ?>" class="catalogue_link" download>
            Завантажити каталог
        </a>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
</body>

</html>