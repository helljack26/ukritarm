<?
include('../../includes/config.php');
include('../../includes/links.php');

// Счетчик для
$can_pay = '1';

//Post values 
$order_time = $_POST['currentTime'];

$names = $_POST['names'];
$email = $_POST['email'];
$password = md5($_POST['pass']);

$fiz_midlname = $_POST['fiz_midlname'];
$fiz_lastname = $_POST['fiz_lastname'];
$fiz_phone = $_POST['fiz_phone'];

$osoba = $_POST['osoba'];
$yurydychna_code = $_POST['yurydychna_code'];
$yurydychna_company = $_POST['yurydychna_company'];

// Delivery
$city = $_POST['city'];
$city_hash = $_POST['city_hash'];

//    (Самовивіз зі складу) 
// or (Самовивіз із відділення Нової Пошти) 
// or (Адресна доставка Нової почти)
$delivery_type = $_POST['delivery_type']; 
$order_department_np = $_POST['delivery'];

$street = $_POST['street'];
$house = $_POST['house'];
$apartment = $_POST['apartment'];

//1 or 2 (Готівкою або карткою при отриманні)
$paymentMethod = trim($_POST['paymetd_method']); 
$comment = $_POST['comment']; 

$getLastId = mysqli_query($con,"SELECT
                                MAX(id) FROM 
                                orders;
                                ");

$rowLastId = mysqli_fetch_array($getLastId);
$newOrderId = intval($rowLastId['MAX(id)']) + 1; 

$total_price = 0;

$isSendAuth = false;

foreach($_SESSION['cart'] as $id => $value){

    $cart_product_code = $value['pid'];
    $cart_product_articul = $value['articul'];
    
    $cart_product_quantity = $value['quantity'];
    
    $cart_product_price = intval($value['price']) / intval($cart_product_quantity);
    
    $cart_product_unit = $value['product_unit'];
    $total_price += intval($value['price']);
    // Total order
    if ($paymentMethod == 'Онлайн оплата карткою (LiqPay)') {
        $can_pay = '1';
    } elseif ($paymentMethod == 'По безготівковому розрахунку (рахунок-фактура)') { 
        $can_pay = '3';
    } else { 
        $can_pay = '2';
    }

    $session_user_id = isset($_SESSION['id']) ? floatval($_SESSION['id']) : 0;
    
    // Add order to db
    $insert_order = mysqli_query($con,"INSERT INTO orders (
                                                    collapse_order_id,
                                                    userId,
                                                    productId,
                                                    product_articul,
                                                    quantity,
                                                    paymentMethod,
                                                    summa,
                                                    first_name,
                                                    midle_name,
                                                    last_name,
                                                    email_order,
                                                    phone_order,
                                                    city_order,
                                                    city_order_hash,
                                                    order_department_np,
                                                    delivery_type,
                                                    delivery_street,
                                                    delivery_house,
                                                    delivery_apartment,
                                                    comment,
                                                    price_per_unit,
                                                    unit,
                                                    can_pay 
                                                ) VALUES (
                                                    '$newOrderId',
                                                    '$session_user_id',
                                                    '$cart_product_code',
                                                    '$cart_product_articul',
                                                    '$cart_product_quantity',
                                                    '$paymentMethod',
                                                    '$value[price]',
                                                    '$names',
                                                    '$fiz_midlname',
                                                    '$fiz_lastname',
                                                    '$email',
                                                    '$fiz_phone',
                                                    '$city',
                                                    '$city_hash',
                                                    '$order_department_np',
                                                    '$delivery_type',
                                                    '$street',
                                                    '$house',
                                                    '$apartment',
                                                    '$comment',
                                                    '$cart_product_price',
                                                    '$cart_product_unit',
                                                    '$can_pay'
                                                    )");
                                                    
}

$isCanRedirect = false;

include('send_order_to_mail.php');

if ($isCanRedirect == true) :
    unset($_SESSION['cart']); 
    // If liqpay
    if ($can_pay == '1') {
        include('cart-action_liqpay.php');
        exit;
    }
    
    // else
    if ($can_pay == '2' || $can_pay == '3') :
?>
<form id="redirect_to_thanks" action="../../thanks" method="post">
    <input type="hidden" name="order_id" value="<?=$newOrderId?>">
</form>
<script type="text/javascript">
    document.getElementById('redirect_to_thanks').submit();
</script>

<?endif; endif; exit;?>