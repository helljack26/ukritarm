<?php
require_once '../../includes/config.php';
include '../../function.php';

$isFromNoReloadFile = true;

$isDelete = $_POST['isDelete'];
$pid = $_POST['pid'];
$articul = $_POST['articul'];
$quant = $_POST['quant'];
$price = $_POST['price'];

$unit = $_POST['unit'];
$unit = preg_replace('/^[^а-яёa-z,]+/iu', '', $unit);


if ($isDelete == 'true') {
	unset($_SESSION['cart'][$pid . $articul]);
}else{
    // Set in cart
    $_SESSION['cart'][$pid . $articul]=array("quantity" => $quant, 
                                                "price" => $price,
                                                "product_unit" => $unit,
                                                "pid" => $pid,
                                                "articul" => $articul)
                                                ;	
};

// Update basket list
include './get_basket_list.php';
?>