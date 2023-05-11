<?php
header('Access-Control-Allow-Origin: *');
if(isset($_POST['data']) || isset($_POST['order_id'])) {
    include('includes/config.php');
    include('function.php');

    if (isset($_POST['data'])) {   
        
        require("vendor/pay/LiqPay.php");
        
        $data = $_POST['data'];
        $decodedData = base64_decode($data);
        // true parameter to return an associative array
        $decodedJsonData = json_decode($decodedData, true); 
        $order_id = $decodedJsonData['order_id'];
    }else{
        $order_id = $_POST['order_id'];
    }
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="Ukritarm">
    <meta name="robots" content="all">
    <?include('includes/links.php');?>

    <title>Дякуємо за покупку ❤️ | Ukritarm</title>
</head>

<body>
    <?
        include('includes/main-header.php');
        include('components/common/thanks_content.php');
        include('includes/footer.php'); 
    ?>
</body>
<?
} else {
    require("function.php");
    show404();
}
?>