<?php
include('includes/config.php');
include('function.php');

$catId = 0;

$getParamTransName= removeRootDir();

$get_category=mysqli_query($con,"SELECT * FROM category");

$row = [];
while($row_category = mysqli_fetch_array($get_category)){   
    $transCatName = transliterate($row_category['categoryName']);

    $isEqual = trim($getParamTransName) == trim($transCatName);

    if ($isEqual) {
        $row = $row_category;
        $catId = $row_category['id'];
    } 
}

if($row === []){
    show404();
}

$cat_name = $row['categoryName'];
$cat_icon = $row['image_url_index'];
$cat_bg = $row['image_bg'];

$soc_title = $row['soc_title'];
$soc_description = $row['soc_description'];
$soc_image = $row['soc_image'];
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <base href="<?= checkIsHttp() .  $_SERVER['SERVER_NAME']; ?>" />

    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="author" content="">
    <meta name="robots" content="all">

    <meta property="og:image" content="./images/category/<?=$soc_image;?>" />
    <meta property="og:title" content="<?=$soc_title =='' ? $row['categoryName'] : $soc_title;?>" />
    <meta property="og:description" content="<?=$soc_description;?>" />
    <meta name="description" content="<?=$soc_description;?>">

    <title><?=$row['categoryName'];?> | UKRITARM</title>
    <?php include('includes/links.php');?>
    <link rel="stylesheet" href="assets/css/category.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <div class="breadcrumbs_block">
            <a href='/'>
                Головна
            </a>
            <a href='all-category'>
                Продукція
            </a>
            <span>
                <?=$row['categoryName'];?>
            </span>
        </div>

        <!-- Category name -->
        <h1>
            <img src="images/category/<?=$cat_icon?>" alt="Iконка категорії <?=$row['categoryName'];?>">
            <span><?=$row['categoryName'];?></span>
        </h1>

        <!-- Category results -->
        <div class="category_row">
            <?php 
                $ret=mysqli_query($con,"SELECT * 
                                        FROM subcategory 
                                        WHERE categoryid='$catId'
                                        ");
                while ($row=mysqli_fetch_array($ret)):
            ?>
            <a href="sub-category/<?=transliterate($row['subcategory'])?>" class="category_row_item">

                <!-- Image -->
                <div class="category_row_item_image">
                    <img src="images/subcategory/<?= $row['subcategory_image']?>" height="154px">
                </div>

                <!-- Subcat name -->
                <span>
                    <?= htmlentities($row['subcategory']);?>
                </span>
            </a>
            <? endwhile; ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>
</body>

</html>