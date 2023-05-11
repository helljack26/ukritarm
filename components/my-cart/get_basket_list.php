<?php
if (!$isFromNoReloadFile) {
    require_once '../../includes/config.php';
    include '../../function.php';
}

// New data for header basket
$basketData = '';
// Item in basket
$itemsInBasket = count($_SESSION['cart']);

// unset($_SESSION['cart']);
// Summ
$basket_summ = 0;

if (isset($_SESSION['cart'])) :
    foreach($_SESSION['cart'] as $id => $value):
	    $id;
        $num_top=count($_SESSION['cart']);

        if($num_top>0):
            $i=0;
            $ret=mysqli_query($con,"SELECT * 
                                    FROM products 
                                    WHERE product_code='$value[pid]' 
                                    AND product_articul='$value[articul]' 
                                    ");
            while($row_basket_top=mysqli_fetch_array($ret)):
                $i++;
                $c_code_top = $row_basket_top['product_code'];
                $product_articul = $row_basket_top['product_articul'];
                $c_main_value   = $row_basket_top['main_value'];

                $c_price        = $row_basket_top['product_price'];
                $c_second_price = $row_basket_top['product_price_second'];
        
                $cartId = $c_code_top . $product_articul;

                if($id == $cartId):	

                    // Name
                    $c_product_name_top = codeToQuote($row_basket_top['product_name']);
                    $c_product_articul_name = codeToQuote($row_basket_top['product_articul_name']);
                    
                    $productLink = generateProductDetailsUrl($c_product_name_top, $product_articul);
                    
                    $c_product_name_top = generateProductName($c_product_name_top , $c_product_articul_name ,$product_articul);
                    
                    $quantity=$_SESSION['cart'][$id]['quantity'];
                    $product_unit=$_SESSION['cart'][$id]['product_unit'];
                    
                    // Price
                    $price_unit = 0;

                    // Get actual price from db
                    if ($product_unit == $c_main_value) {   
                        $price_unit = $c_price;
                    } else {
                        $price_unit = $c_second_price;
                    }
                    
                    $subtotal = $_SESSION['cart'][$id]['quantity'] * $price_unit;
                    $_SESSION['cart'][$id]['price'] = $subtotal;
                    // For front order summ
                    $basket_summ += $subtotal;

                    // Image
                    $c_photo = $row_basket_top['product_image'];
                    if($c_photo == '') {
                        $c_photo = 'images/no_foto.png'; 
                    }else{
                        $c_photo = 'images/'. htmlentities($c_photo);
                    }
                
                    // Basket product item
                    include(__DIR__. '/../common/product_basket_item.php');
                
                    // Push to basket ul
                    $basketData =  $basketItem . $basketData;
                endif;
            endwhile;
        endif;
    endforeach;
endif;

// If exist
$isEmptyUl = '';
$popupBasketFooter = '';

if($_SESSION['cart'] != []){
    $isEmptyUl = $basketData;
    $popupBasketFooter = "<div class='header_first_right_basket_block_footer'>
                        <span class='basket_price_sum'>00.00</span>

                        <a href='my-cart' class='header_first_right_basket_button' >
                            Кошик
                        </a>
                    </div>";

}else{
    $isEmptyUl = "<span class='header_first_right_basket_block_ul_empty'>
                        Ваш кошик порожній
                    </span>";

    $popupBasketFooter = "<div class='header_first_right_basket_block_footer'>
                        <a href='/' class='header_first_right_basket_button header_first_right_basket_button_continue'>
                            Продовжити покупки
                        </a>
                    </div>";
};

$basketBlock = "<ul class='header_first_right_basket_block_ul'>
                    $isEmptyUl
                </ul>";

echo("$itemsInBasket|$basket_summ|$basketBlock|$popupBasketFooter");

?>