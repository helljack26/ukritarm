<?php
include('includes/config.php');
include_once('function.php');

$news_id = $_GET['dir'];
$news_id = explode("/", $news_id);

$getNews = mysqli_query($con,"SELECT * from news WHERE id='$news_id[2]'");
while($newsRow = mysqli_fetch_array($getNews)){
    $news_title  = $newsRow['title'];
    $news_date  = $newsRow['date'];
    $news_text = html_entity_decode($newsRow['text']);
    $news_image = $newsRow['image'];        
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <base href="<?= checkIsHttp() .  $_SERVER['SERVER_NAME']; ?>" />
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta property="og:image" content="assets/no_foto.webp" />
    <meta property="og:title" content="<?=$news_title?> | UKRITARM" />

    <meta property="og:description" content='<?=$news_title;?>' />
    <meta name="description" content='<?=$news_title;?>' />

    <meta name="author" content="">
    <meta name="robots" content="all">

    <title><?=$news_title?></title>

    <?php include('includes/links.php');?>
    <link rel="stylesheet" href="assets/css/single_news.min.css">

</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <a href='news' class='news_back'>
            Новини
        </a>
        <!-- Title -->
        <h1>
            <?=$news_title?>
        </h1>

        <!-- Content -->
        <div class="news_content">
            <!-- Images -->
            <div class="news_content_image">
                <img src="images/<?=$news_image?>" alt="<?= $news_title?>" />
            </div>

            <!-- Text content -->
            <div class="news_content_text">
                <?= $news_text?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>

</body>

</html>