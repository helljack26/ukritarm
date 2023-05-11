<?php 
include('includes/config.php');
include('function.php');

require("vendor/pay/LiqPay.php");

$sessionLogin = isset($_SESSION['login']) ? $_SESSION['login'] : '';
if(strlen($sessionLogin) == 0) {   
    header('location:login');
} else {
    // Get all summs
    $get_order_history = mysqli_query($con,"SELECT *, SUM(summa)
                                                    FROM orders 
                                                    WHERE userId='$_SESSION[id]'
                                                    GROUP BY collapse_order_id
                                                    ");

    $num_order_history = mysqli_num_rows($get_order_history);

?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>Історія замовлень | UKRITARM</title>

    <?php include('includes/links.php');?>

    <link rel="stylesheet" href="assets/css/my-account.min.css">
    <link rel="stylesheet" href="assets/css/order_history.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <!-- Title -->
        <h1>
            Власний кабінет
        </h1>

        <div class="account_row">

            <div class="account_col_left">

                <div class="account_col_left_header">
                    <span>
                        Історія замовлень
                    </span>
                </div>

                <!-- Історія замовлень -->
                <div class="account_col_left_form">
                    <? if ($num_order_history > 0): ?>
                    <div class="account_col_left_form_header">
                        <span>Дата</span>
                        <span>Номер</span>
                        <span>Статус</span>
                        <span>Сума</span>
                        <span></span>
                    </div>
                    <? endif;?>


                    <div class="account_col_left_form_history">
                        <? if ($num_order_history == 0): ?>
                        <h2>Історія замовлень порожня</h2>
                        <? else:
                                // Render list
                                while($row_order_history = mysqli_fetch_array($get_order_history)){
                                    $order_user_id = $_SESSION['id'];
                                    include('components/common/order_item_row.php');
                                }
                            endif; 
                        ?>
                    </div>
                </div>
            </div>

            <!-- Side bar -->
            <?php include('includes/account-sidebar.php');?>
        </div>
    </main>
    <!-- Footer -->
    <?php include('includes/footer.php');?>

    <script type="text/javascript" src="assets/js/account.js"></script>
    <script type="text/javascript" src="assets/js/my-account.js"></script>
</body>

</html>
<?php } ?>