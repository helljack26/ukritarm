<?php
include('includes/config.php');
include('function.php');

// Real title
$page_data = getTitleGoogle();
$title_google = $page_data['title_google'];

$getParamTransName= removeRootDir();

if ($getParamTransName == 'search-result' || $getParamTransName == 'search-result/' || $getParamTransName == 'search-result.php') {
    $getParamTransName = '';
}
// Real title end
$find="{$getParamTransName}%";

$get_soc_data = mysqli_query($con,"SELECT * from social_page_content where newid='2'");
$row_soc_data = mysqli_fetch_array($get_soc_data);
$soc_title = $row_soc_data['title'];
$soc_image = $row_soc_data['image'];
$soc_description = $row_soc_data['soc_info_description'];
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <base href="<?=checkIsHttp() .  $_SERVER['SERVER_NAME']; ?>" />
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta property="og:title" content="<?=$soc_title?>" />
    <meta property="og:image" content="images/information/<?=$soc_image?>" />

    <meta property="og:description" content="<?= ($soc_description);?>" />
    <meta name="description" content="<?= ($soc_description);?>">

    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title><?=$title_google?></title>
    <?php include('includes/links.php');?>

    <link rel="stylesheet" href="assets/css/product_small_card.min.css">
    <link rel="stylesheet" href="assets/css/search_results.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <div class="search_header">
            <h1>
                Пошук товарів
            </h1>
            <!-- Product search -->
            <div class="search_header_row">
                <input type="text" id='search_header_input' value='<?=$getParamTransName?>' autocomplete='off'>

                <button type='button' id='search_header_row_button'></button>
            </div>
        </div>

        <!-- Product Search results -->
        <div class="product_category_row">
            <div id="product_category_row_results" class="product_category_row_results">
                
            </div>

            <div class="product_category_row_results_block_empty">Товари не знайдено</div>

            <div id='loadMore'></div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>

    <script type="text/javascript" src="assets/js/search_result.js"></script>
</body>

</html>