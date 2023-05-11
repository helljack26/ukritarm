<?php 
include('includes/config.php');
include('function.php');

// Real title 
$page_data = getTitleGoogle();
$title_google = $page_data['title_google'];
$base_url = $page_data['base_url'];
// Redirect if empty cart
if(empty($_SESSION['cart'])){
    header('location:/');
    exit;
}

$user_email = isset($_SESSION['login']) ? $_SESSION['login'] : '';
$getUserInfo = mysqli_query($con,"SELECT name,midle_name,last_name,email,contactno 
                            FROM users 
                            WHERE email='$user_email'
                            ");
$rowUserInfo = mysqli_fetch_array($getUserInfo);

//Fix warning 
$name = isset($_SESSION['username']) && strlen($_SESSION['username']) > 0 ? $_SESSION['username'] : '';
// End fix
$city = 'Київ';
?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="all">
    <title><?=$title_google?></title>

    <? include('includes/links.php');?>
    <link href="assets/css/my-cart.min.css" rel="stylesheet">
    <link href="assets/css/novaposhta_dropdown_popup.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <? include('includes/main-header.php');?>

    <main>
        <!-- Main title -->
        <h1>
            Кошик
        </h1>
        <div class="mycart_row">
            <div class="mycart_row_left">
                <!-- User info -->
                <? include('components/my-cart/content/user_info.php');?>

                <!-- Delivery / Payment -->
                <? include('components/my-cart/content/delivery_payment.php');?>
            </div>

            <!-- Product list -->
            <? include('components/my-cart/content/cart_product_list.php');?>
        </div>

    </main>

    <!-- City popup -->
    <? include('components/my-cart/content/nova_poshta_city_popup.php');?>

    <!-- Footer -->
    <? include('includes/footer.php');?>

    <script src="./assets/js/account.js" type="text/javascript"></script>
    <script src="./assets/js/my-cart.js" type="text/javascript"></script>

    <script src="./assets/js/my-cart-js/nova_poshta_dropdown_popup.js" type="text/javascript"></script>
    <script src="./assets/js/my-cart-js/tab_switchers_action.js" type="text/javascript"></script>
</body>

</html>