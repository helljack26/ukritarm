<?php 
    include('includes/config.php');
    include('function.php');

    $catId = 0;

    $getParamTransName= removeRootDir();
    
    $get_services=mysqli_query($con,"SELECT * from services");
    
    $row = [];
    while($row_services = mysqli_fetch_array($get_services)){   
        $transCatName = codeToQuote($row_services['servicesName']);
        $transCatName = transliterate($transCatName);
    
        $isEqual = trim($getParamTransName) == trim($transCatName);
    
        if ($isEqual) {
            $row = $row_services;
            $catId = $row_services['id'];
        } 
    }
    
    if($row === []){
        header('Location: 404.php');
        exit;
    }
    // Content
    $servicesName = codeToQuote($row['servicesName']);
    $shortDescription = codeToQuote($row['servicesShortDescription']);
    $phoneNumbers = $row['phoneNumbers'];
    $longDescription = codeToQuote($row['servicesLongDescription']);
    // Images
    $services_main_image = $row['image_url_index'];
    $image_other = $row['image_other'];

    $soc_title = codeToQuote($row['soc_title']);
    $soc_description = codeToQuote($row['soc_description']);
    $soc_image = $row['soc_image'];
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <!-- Meta -->
    <base href="<?=checkIsHttp() .  $_SERVER['SERVER_NAME']; ?>" />
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <meta property="og:title" content="<?=$soc_title?>" />
    <meta property="og:image" content="images/<?=$soc_image?>" />

    <meta property="og:description" content="<? echo($soc_description);?>" />
    <meta name="description" content="<? echo($soc_description);?>">

    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title><?=$servicesName?> | UKRITARM</title>

    <!-- Styles -->
    <?php include('includes/links.php');?>

    <link rel="stylesheet" href="assets/css/services_details.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <!-- Intro -->
        <div class="servicesIntro" style="background-image: url(../../images/<?=$services_main_image?>);">
            <!-- Content -->
            <div class="servicesIntro_info">
                <div class="servicesIntro_info_block">

                    <a href='services' class='servicesIntro_info_block_back'>
                        Послуги
                    </a>

                    <div class="servicesIntro_info_block_item">
                        <h1 class="servicesIntro_info_block_item_title">
                            <?=$servicesName?>
                        </h1>
                        <p>
                            <?=$shortDescription?>
                        </p>
                    </div>

                    <!-- Консультація та замовлення -->
                    <?
                        $parsedNumbers = unserialize($phoneNumbers);
                        if ($parsedNumbers):
                    ?>
                    <div class="servicesIntro_info_block_item">
                        <span class="servicesIntro_info_block_item_subtitle">
                            Консультація та замовлення
                        </span>

                        <div class="servicesIntro_info_block_item_row">
                            <?
                                for($i = 0;$i < 3; $i++):
                                $isPhoneNumber= $parsedNumbers[$i] !=='' ? $parsedNumbers[$i] : '';
                            ?>
                            <a href="tel:<?=$isPhoneNumber?>" class="servicesIntro_info_block_item_row_number">
                                <?=$isPhoneNumber?>
                            </a>
                            <? endfor;?>
                        </div>
                    </div>
                    <? endif; ?>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="servicesContent">
            <!-- Images -->
            <?  $parsedData = unserialize($image_other);
                if($parsedData):
            ?>
            <div class="servicesContent_images">
                <? 
                    foreach ($parsedData as $imageName):
                ?>
                <div class='servicesContent_images_item'>
                    <img src="images/<?=$imageName?>" width="100%" height="100%" />
                </div>
                <? endforeach; ?>
            </div>
            <? endif; ?>

            <!-- Text content -->
            <div class="servicesContent_text">
                <?= html_entity_decode($longDescription)?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>

</body>

</html>