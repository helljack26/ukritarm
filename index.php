<?php 
    include('includes/config.php');
    include('function.php');

    $get_soc_data = mysqli_query($con,"SELECT * from social_page_content where newid='1'");
    $row_soc_data = mysqli_fetch_array($get_soc_data);
    $soc_title = $row_soc_data['title'];
    $title_google = $row_soc_data['title_google'];
    $soc_image = $row_soc_data['image'];
    $soc_description = $row_soc_data['soc_info_description'];
    $parsedData = getPageContent($con,'4');
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <meta property="og:title" content="<?=$soc_title?>" />
    <meta property="og:image" content="images/information/<?=$soc_image?>" />
    <title><?=$title_google?></title>
    <meta property="og:description" content="<? echo($soc_description);?>" />
    <meta name="description" content="<? echo($soc_description);?>">

    <meta name="keywords" content="<? echo($soc_description);?>" />
    <meta name="robots" content="all">
    <!-- Styles -->
    <?php include('includes/links.php');?>

    <!-- Slider style -->
    <link rel="stylesheet" type="text/css" href="assets/js/lib/slick-1.8.1/css/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/index.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <!-- Intro -->
        <?php include('components/index/intro.php');?>

        <!-- About us -->
        <?php include('components/index/about_us.php');?>

        <!-- Popular products -->
        <?php include('components/index/popular_product_slider.php');?>

        <!-- Popular services -->
        <?php include('components/index/popular_services.php');?>

        <!-- News -->
        <?php include('components/index/news.php');?>

        <!-- News -->
        <?php include('components/index/projects.php');?>

        <!-- Achieve -->
        <?php include('components/index/achieve.php');?>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>


    <script type="text/javascript" src="assets/js/index.js"></script>

    <script type="text/javascript" src="assets/js/lib/slick-1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="assets/js/slider_item_hover.js"></script>
    <script type="text/javascript" src="assets/js/services_hover.js"></script>
    <script type="text/javascript" src="assets/js/news.js"></script>

</body>

</html>