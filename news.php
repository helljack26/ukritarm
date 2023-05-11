<?php
include('includes/config.php');
include_once('function.php');

// Real title 
$page_data = getTitleGoogle();
$title_google = $page_data['title_google'];

// Real title end
$sql = mysqli_query($con,"SELECT * from page_content where newid='2'");
$row = mysqli_fetch_array($sql);

$soc_description = $row['soc_info_description'];
$parsedData = unserialize($row['text']);

?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta property="og:image" content="assets/no_foto.webp" />
    <meta property="og:title" content="<?=$row['title']?> | UKRITARM" />

    <meta property="og:description" content="<? echo($soc_description);?>" />
    <meta name="description" content="<? echo($soc_description);?>">

    <meta name="author" content="">
    <meta name="robots" content="all">

    <title><?=$title_google?></title>

    <?php include('includes/links.php');?>
    <link rel="stylesheet" href="assets/css/news.min.css" />
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <!-- Title -->
        <?php $splited = explode(' ',$parsedData['main_title']);?>
        <h1>
            <span><?=$splited[0]?></span>
            <span><?=$splited[1]?></span>
        </h1>

        <!-- Secondary title -->
        <span class="main_second_title">
            <?php echo htmlentities($parsedData['second_title']);?>
        </span>

        <!-- News list -->
        <div class="news_list">
            <?
			    $getNews = mysqli_query($con,"SELECT * from news ORDER BY date DESC");
                while($newsRow = mysqli_fetch_array($getNews)){

                    include('components/news/news_item.php');
                }
                ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>
    <script src="assets/js/news.js"></script>

</body>

</html>