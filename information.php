<?php 
include('includes/config.php');
include('function.php');

if(isset($_GET['name'])){
    $url = $_GET['name'];
    $name_page = basename($url);
    $sql = "SELECT * FROM social_page_content WHERE name_page='$name_page'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $title = codeToQuote($row['title']);
        $content = codeToQuote($row['content']);
        $soc_info_description = codeToQuote($row['soc_info_description']);
        $title_google = codeToQuote($row['title_google']);
    } else {
        show404();
    }
}
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <!-- Meta -->
    <base href="<?=checkIsHttp() .  $_SERVER['SERVER_NAME']; ?>" />
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="robots" content="all">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">

    <meta property="og:title" content="<?=replaceDoubleQuote($title_google)?>" />
    <meta property="og:image" content="assets/no_photo.webp" />
    <meta property="og:description" content="<?=replaceDoubleQuote($soc_info_description) ?>" />

    <meta name="description" content="<?=replaceDoubleQuote($soc_info_description) ?>">

    <title><?=replaceDoubleQuote($title_google)?></title>

    <!-- Styles -->
    <?php include('includes/links.php');?>

    <link rel="stylesheet" href="assets/css/news.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <h1 style='padding-bottom: 15px;'><?=$title?></h1>
        <div class="servicesContent">
            <!-- Text content -->
            <div class="servicesContent_text">
                <?=$content?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>

</body>

</html>