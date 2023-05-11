<?php
include('includes/config.php');
include('function.php');

// Real title 15
$page_data = getTitleGoogle();
$title_google = $page_data['title_google'];
// Real title end

$get_soc_data = mysqli_query($con,"SELECT * from social_page_content where newid='5'");
$row_soc_data = mysqli_fetch_array($get_soc_data);

$soc_title = $row_soc_data['title'];
$soc_image = $row_soc_data['image'];
$soc_description = $row_soc_data['soc_info_description'];
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="author" content="">
    <meta name="robots" content="all">

    <meta property="og:image" content="./images/social_media_category/<?=$soc_image;?>" />
    <meta property="og:title" content="<?=$soc_title; ?>" />
    <meta property="og:description" content="<?=$soc_description;?>" />
    <meta name="description" content="<?=$soc_description;?>">

    <title><?=$title_google?></title>

    <?php include('includes/links.php');?>
    <link rel="stylesheet" href="assets/css/services.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <!-- Services header -->
        <h1 class="wow fadeInUp">
            Послуги
        </h1>

        <!-- Services results -->
        <div class="services_row_results">
            <?php 
                $getServices = mysqli_query($con,"SELECT * from services");
                while ($rowService=mysqli_fetch_array($getServices)){
                    include('components/services/services_item.php');
                }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>
    <script type="text/javascript" src="assets/js/services_hover.js"></script>

</body>

</html>