<?php 
include('includes/config.php');
include_once('function.php');

// Real title 15
$page_data = getTitleGoogle();
$title_google = $page_data['title_google'];
// Real title end

$getPageContent = mysqli_query($con,"SELECT * from page_content where newid='1'");
$rowPageContent = mysqli_fetch_array($getPageContent);
$soc_description = $rowPageContent['soc_info_description'];

$parsedData = unserialize($rowPageContent['text']);

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

    <meta property="og:image" content="assets/no_foto.webp" />
    <meta property="og:title" content="<?=$rowPageContent['title']?>" />

    <meta property="og:description" content="<?= ($soc_description);?>" />
    <meta name="description" content="<?= ($soc_description);?>">

    <meta name="keywords" content="<?=$rowPageContent['title']?>" />
    <meta name="robots" content="all">
    <title><?=$title_google?></title>

    <?php include('includes/links.php');?>

    <link rel="stylesheet" href="assets/css/aboutUs.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>


    <main>
        <?php include('components/aboutus/intro.php');?>

        <!-- Tabs -->
        <?php include('components/aboutus/about_company.php');?>
        <?php include('components/aboutus/manufacture.php');?>
        <?php include('components/aboutus/gallery.php');?>
    </main>

    <!-- Footer -->
    <? include('includes/footer.php');?>

    <script type="text/javascript" src="assets/js/aboutUs.js"></script>

</body>

</html>