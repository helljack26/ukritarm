<?php
include('includes/config.php');
include('function.php');

$cat = 0;
$cid = 0;

$getParamTransName= removeRootDir();

$get_subcategory=mysqli_query($con,"SELECT * from subcategory");

$get_sub_row = [];
while($row_subcategory = mysqli_fetch_array($get_subcategory)){   
    $transSubCatName = transliterate($row_subcategory['subcategory']);

    $isEqual = trim($getParamTransName) == trim($transSubCatName);

    if ($isEqual) {
        $get_sub_row = $row_subcategory;
        $cat = $row_subcategory['categoryid'];
        $cid = $row_subcategory['subcategory_id'];
    } 
}

if($get_sub_row === []){
    show404();
}

$sub_cat_name = $get_sub_row['subcategory'];

$getCatName = mysqli_query($con,"SELECT * FROM category WHERE id = '$get_sub_row[categoryid]'");
$rowCatName=mysqli_fetch_array($getCatName);
$categoryName = $rowCatName['categoryName'];
$transCatName = transliterate($rowCatName['categoryName']);
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <base href="<?=checkIsHttp() .  $_SERVER['SERVER_NAME']; ?>" />

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <meta property="og:image" content="images/<?= $get_sub_row['product_image']?>" />
    <meta property="og:title" content="<?=$sub_cat_name?>" />
    <meta property="og:description" content="<?= $get_sub_row['product_soc_description']?>" />
    <meta name="description" content="<?= $get_sub_row['product_soc_description']?>">

    <title><?=$sub_cat_name?> | UKRITARM</title>

    <?php include('includes/links.php');?>
    <link rel="stylesheet" href="assets/css/product_small_card.min.css">
    <link rel="stylesheet" href="assets/css/sub_category.min.css">
</head>

<body>
    <input type="hidden" id='cat' value='<?=$cat?>'>
    <input type="hidden" id='cid' value='<?=$cid?>'>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>

        <div class="product_category_row">
            <!-- Filters -->
            <? include('includes/product_filters/product_filters.php'); ?>

            <!-- Product results -->
            <div class="product_category_row_results">
                <div class="product_category_row_results_header">
                    <div class="breadcrumbs_block">
                        <a href='/'>
                            Головна
                        </a>
                        <a href='category/<?=$transCatName?>'>
                            <?=$categoryName?>
                        </a>
                        <span>
                            <?=$sub_cat_name;?>
                        </span>
                    </div>

                    <div class="product_category_row_results_header_row">
                        <h1>
                            <?=$sub_cat_name?>
                        </h1>
                        <!-- Sort buttons -->
                        <? include('includes/product_filters/sort_button.php'); ?>
                    </div>
                </div>
                <div id="load_more_results" class="product_category_row_results_block">
                    <?php
                        $retDistinct=mysqli_query($con,"SELECT product_code, product_articul
                                                        FROM products
                                                        WHERE category='$cat' 
                                                        AND sub_category='$cid' 
                                                        AND product_price > 1 
                                                        ORDER BY product_articul ASC
                                                        ");
        
                        $numDistinct=mysqli_num_rows($retDistinct);
    
                        if($numDistinct>0){
                            $i=0;
                            while($rowDisctinct=mysqli_fetch_array($retDistinct)):   
                                    $ret=mysqli_query($con,"SELECT * 
                                                            FROM products 
                                                            WHERE product_code='$rowDisctinct[product_code]' 
                                                            AND product_articul='$rowDisctinct[product_articul]' 
                                                            ");
                                    $row_product_card_item=mysqli_fetch_array($ret);                                                              
                                    include('components/common/product_small_card.php');
                            endwhile;
                        } else {
                        ?>
                    <h2 class="product_category_row_results_block_empty">Товари не знайдені</h2>
                    <? } ?>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>
    <script type="text/javascript" src="assets/js/product_filters.js"></script>
    <script type="text/javascript" src="assets/js/lib/range_slider.js"></script>

</body>

</html>