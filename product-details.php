<?php 
    include('includes/pdo_config.php');
    include('includes/config.php');
    include('function.php');
    
    // Future logic
	$url_parts = explode('/', $_SERVER['REQUEST_URI']);
	
	$product_url_name = $url_parts[2];
	$get_articul = isset($url_parts[3]) ? $url_parts[3] : '';

    // Is exist characteristic
    $prepareQuery = strlen($get_articul) > 0 ? '`product_name_en` = :get_name and `product_articul_en` = :get_articul' : '`product_name_en` = :get_name';
    $executeQuery = strlen($get_articul) > 0 ? [':get_name'=> $product_url_name, ':get_articul'=>$get_articul] : [':get_name'=> $product_url_name];
    
    $pid = $dbh->prepare("SELECT * FROM products WHERE $prepareQuery ORDER BY product_availability DESC");
    $pid->execute($executeQuery);
    
    while ($row = $pid->fetch(PDO::FETCH_LAZY)):
        $c_code = $row['product_code'];

        $c_category_id = $row['category'];
        $c_sub_сategory_id = $row['sub_category'];
        
        // Info
        $c_product_name = codeToQuote($row['product_name']);
        $c_product_articul = codeToQuote($row['product_articul']);
        $c_product_articul_name = codeToQuote($row['product_articul_name']);
        $c_description = codeToQuote($row['product_description']);
        
        $c_main_value = $row['main_value'];
        $c_second_value = $row['second_value'];
        
        $c_availability = $row['product_availability'];

        $c_attributes = $row['attributes'];
        $attributesDecoded = json_decode($c_attributes, true);
        $c_attributes_count = count($attributesDecoded);

        // Price
        $c_price = floatval($row['product_price']);
        $c_second_price = floatval($row['product_price_second']);
        $c_old_price = floatval($row['product_price_before_discount']);
        // Image
        $c_photo_main = $row['product_image'];
        $raw_product_image_secondary = $row['product_image_secondary'];
        $product_image_secondary = unserialize($row['product_image_secondary']);
    endwhile;

    $isAdminEditPage = !isset($_GET['edit_page_content']);

    if (strlen($c_code) === 0 && $isAdminEditPage) {
        show404();
    }
    
    $categoryName = CategoryName($con,$c_category_id, '');
    $transCatName = transliterate($categoryName);
    $subcat_name = CategoryName($con,$c_category_id, $c_sub_сategory_id);

    $parsedPageContent = getPageContent($con,'6');
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <base href="<?= checkIsHttp() .  $_SERVER['SERVER_NAME']; ?>" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="author" content="">
    <meta name="keywords"
        content="<?=generateProductName($c_product_name , $c_product_articul_name ,$c_product_articul);?>" />
    <meta name="robots" content="all">

    <meta property="og:title"
        content="<?php echo generateProductName($c_product_name, $c_product_articul_name, $c_product_articul); ?>">
    <meta property="og:image"
        content="<?php echo $c_photo_main == '' ? 'images/no_foto.png' : 'images/'.$c_photo_main; ?>">
    <meta property="og:description"
        content="<?php echo strip_tags($c_description);?> Замовити за низькими цінами від виробника. Швидка та надійна доставка по всій території України">
    <meta name="description"
        content="<?php echo strip_tags($c_description);?> Замовити за низькими цінами від виробника. Швидка та надійна доставка по всій території України">

    <title><?= generateProductName($c_product_name , $c_product_articul_name ,$c_product_articul);?> - Купити від
        виробника «Укрітарм»</title>

    <?php include('includes/links.php');?>

    <!-- Slider style -->
    <link rel="stylesheet" type="text/css" href="assets/js/lib/slick-1.8.1/css/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/product_details.min.css">
</head>

<body id="reload-wrapper">
    <!-- Header -->
    <?php include('includes/main-header.php');?>
    <main>

        <? if(check_mobile_device() == true): ?>
        <div class="tablet_header">
            <?php include('components/product_details/product_name.php');?>
        </div>
        <?endif;?>


        <div class="product_row">
            <!-- Image slider -->
            <?php include('components/product_details/image_slider.php');?>

            <!-- Right info -->
            <?php include('components/product_details/product_right_info.php');?>
        </div>

        <!-- Review \ Desctription -->
        <?php include('components/product_details/product_tabs.php');?>

        <!-- Similar slider -->
        <?php include('components/product_details/similar_slider.php');?>

    </main>

    <!-- Fullscreen slider -->
    <?php include('components/product_details/fullscreen_slider.php');?>

    <!-- Footer -->
    <?php include('includes/footer.php');?>

    <script type="text/javascript" src="assets/js/lib/slick-1.8.1/slick/slick.min.js"></script>
    <script type="module" crossorigin src="assets/js/product_details.js"></script>
    <script type="text/javascript" src="assets/js/formValidation.js"></script>
</body>

</html>