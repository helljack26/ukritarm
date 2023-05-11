<?
    // Order info
    $order_collapsed_id = $row_order_history['collapse_order_id'];
    $order_date = correctMysqlDate($row_order_history['orderDate']);
    $order_date = htmlentities($order_date);

    $summa = floatval($row_order_history['SUM(summa)']);
    $summaWithSpaces = addSpaceForThousands($summa);
    $order_status = $row_order_history['orderStatus'];
    $can_pay = $row_order_history['can_pay'];

    // Hidden detail info
    $order_first_name = htmlentities($row_order_history['first_name']);
    $order_midle_name = htmlentities($row_order_history['midle_name']);
    $order_last_name = htmlentities($row_order_history['last_name']);
    $order_email = htmlentities($row_order_history['email_order']);
    $order_phone = htmlentities($row_order_history['phone_order']);
    $order_paymentMethod = htmlentities($row_order_history['paymentMethod']);
    $order_comment = htmlentities($row_order_history['comment']);
    $order_comment = htmlentities($row_order_history['comment']);

    // Delivery
    $order_delivery_type = $row_order_history['delivery_type'];
    $order_city = $row_order_history['city_order'];
    $order_department_np = $row_order_history['order_department_np'];
    $order_street = $row_order_history['delivery_street'];
    $order_house = $row_order_history['delivery_house'];
    $order_apartment = $row_order_history['delivery_apartment'];
    $order_track_np = $row_order_history['track_np'];
    
    // Condition
    $isSelfPickup = strlen($order_department_np) == 0 && strlen($order_street) == 0 && strlen($order_house) == 0;
    $isNpAddress = strlen($order_street) > 0 && strlen($order_house) > 0;
    $order_delivery = '';
    if($isSelfPickup) {
        $order_delivery = "<span>$order_delivery_type</span>"; 
    } elseif ($isNpAddress) {
        $order_delivery = "<span>$order_delivery_type - Місто $order_city , Вул. $order_street, буд. $order_house, кв. $order_apartment</span>"; 
    } else {
        $order_delivery = "<span>$order_delivery_type - $order_department_np</span>"; 
    }
?>
<div class="account_col_left_form_history_item">
    <!-- Visible part -->
    <div class='history_item_header'>

        <!-- Order date -->
        <span class='history_item_header_date'>
            <?=$order_date?>
        </span>

        <!-- Order id -->
        <span class='history_item_header_id'>
            № <?=$order_collapsed_id?>
            <span>від <?=$order_date?></span>
        </span>

        <!-- Status -->
        <div class='history_item_header_row'>
            <span>
                Статус:
            </span>
            <span>
                <?=$order_status?>
            </span>
        </div>

        <div class='history_item_header_row'>
            <span>
                Сума:
            </span>
            <!-- Summ -->
            <span class='history_item_header_summa'>
                <?= $summaWithSpaces?> ₴
            </span>
        </div>

        <!-- Details trigger -->
        <button type='button' class='history_item_header_show_btn'>
            <p class="history_item_header_show_btn_desktop">Детальніше</p>
            <p class="history_item_header_show_btn_tablet">Деталі</p>
        </button>
    </div>

    <!-- Hidden part -->
    <div class="history_item_hidden" data-is-open='false'>

        <span class="history_item_hidden_title_detail">Деталі замовлення</span>

        <!-- Order more info -->
        <div class="history_item_hidden_info">
            <div>
                <span>Отримувач:</span>
                <span><?= "$order_first_name $order_midle_name $order_last_name"?></span>
            </div>
            <div>
                <span>Email:</span>
                <span><?= $order_email?></span>
            </div>
            <div>
                <span>Телефон:</span>
                <span><?= $order_phone?></span>
            </div>

            <div>
                <span>Доставка:</span>
                <span><?= $order_delivery?></span>
            </div>

            <?
            if (strlen($order_track_np) > 0):?>
            <div>
                <span>№ТТН Нової пошти:</span>
                <span><?= $order_track_np?></span>
            </div>
            <? endif;?>

            <div>
                <span>Спосіб оплати:</span>
                <span><?= $order_paymentMethod;?></span>
            </div>


            <?  if ($order_paymentMethod =='Онлайн оплата карткою (LiqPay)') :?>
            <div>
                <span>Статус Liqpay:</span>

                <span class='history_item_hidden_info_liqpay'>
                    <?php
                        #liq pay
                    
                        $liqpay = new LiqPay($public_key, $private_key);
                        //Обращаемся к методу cnb_form указывая необходимые настройки для создания формы с кнопкой оплатить
                        $data = array();
                        $data['form'] = $liqpay->cnb_form(array(
                            'version'       => '3',
                            'amount'        => $summa,
                            'currency'      => 'UAH',
                            'description'   => 'Сплата за товар на суму - ' . $summa,
                            'order_id'      => $order_collapsed_id,
                            'language'		=> 'ua',
                            'type'			=> 'donate',
                            'result_url'	=> 'https://ukritarm.com.ua/thanks',
                            'server_url'	=> 'https://ukritarm.com.ua/thanks',
                            'action' 		=> 'pay',
                        ));
                        #liq pay status  
                        $liqpay2 = new LiqPay($public_key, $private_key);
                        $res = $liqpay2->api("request", array(
                            'action'        => 'status',
                            'version'       => '3',
                            'order_id'      => $order_collapsed_id
                            ));
                        #end liq pay
                        $pay_status = $res->result;
                        if ($pay_status == 'error') {
                            echo $pay_result = $data['form'];
                        } else  {
                            echo $pay_result = '<img src="assets/images/payed.jpg" name="btn_text" height="40px">';
                        }
                    ?>
                </span>
            </div>
            <? endif;?>

            <?  if ($order_paymentMethod =='Онлайн оплата карткою (LiqPay)' || $order_paymentMethod =='По безготівковому розрахунку (рахунок-фактура)' ) :?>

            <div>
                <span>або</span>
                <span></span>
            </div>
            <div class="payment_info">
                <span> Найменування одержувача:</span>
                <span> ФОП Телешун Денис Сергійович</span>
            </div>
            <div class="payment_info">
                <span> Код одержувача:</span>
                <span> 3232919452</span>
            </div>
            <div class="payment_info">
                <span> Рахунок IBAN:</span>
                <span> UA973052990000026002011216828</span>
            </div>
            <? endif;?>

            <? if (strlen($order_comment) > 0) :?>
            <div>
                <span>Комментар:</span>
                <span><?=$order_comment;?></span>
            </div>
            <?endif;?>
        </div>

        <!-- Product list -->
        <span class="history_item_hidden_title_product">Замовлені товари</span>
        <div class="history_item_hidden_header">
            <span class='history_item_hidden_header_img'></span>
            <span>Назва</span>
            <span>Кіл-ть</span>
            <span>Ціна</span>
            <span>Cума</span>
        </div>
        <ul class="history_item_hidden_products">
            <?php 
                $get_order_products = mysqli_query($con,"SELECT productId, product_articul, quantity, price_per_unit ,unit
                                                            FROM orders 
                                                            WHERE userId='$order_user_id' 
                                                            AND collapse_order_id='$order_collapsed_id'
                                                            ");
                while($row_order_product = mysqli_fetch_array($get_order_products)):
                    $order_product_code = $row_order_product['productId'];
                    $order_product_articul = $row_order_product['product_articul'];
                    $order_quantity = intval($row_order_product['quantity']);
                    $order_unit = $row_order_product['unit'];
                    
                    $order_price_per_unit = $row_order_product['price_per_unit'];
                    
                    $order_summ_price_per_unit = intval($row_order_product['price_per_unit']) * $order_quantity;

                    // Get product info
                    $get_product_info = mysqli_query($con,"SELECT * 
                                                            FROM products
                                                            WHERE product_code='$order_product_code'
                                                            AND product_articul = '$order_product_articul'
                                                            ");
                    $num_product_info = mysqli_num_rows($get_product_info);

                    // Get extra info about product
                    if ($num_product_info > 0):
                        while ($row_product_info = mysqli_fetch_array($get_product_info)):
                            $c_product_name_top = $row_product_info['product_name'];
                            $product_articul = $row_product_info['product_articul'];
                            $product_articul_name = $row_product_info['product_articul_name'];
                            $productLink = generateProductDetailsUrl($c_product_name_top, $product_articul);
                            
                            $c_product_name_top = generateProductName($c_product_name_top , $product_articul_name ,$product_articul);
                            // Image
                            $c_photo = $row_product_info['product_image'];

                            $c_photo = $c_photo == '' ? "/images/no_foto.png" : "/images/". htmlentities($c_photo);

                            $order_price_per_unit = addSpaceForThousands($order_price_per_unit);
                ?>
            <li>
                <a href='<?=$productLink?>' class='history_item_hidden_products_li_image'>
                    <img src='<?=$c_photo?>' />
                </a>

                <a href='<?=$productLink?>' class='history_item_hidden_products_li_name'>
                    <?=$c_product_name_top?>
                </a>

                <p>
                    <?=$order_quantity?>
                </p>

                <p class='history_item_hidden_products_li_price_per_unit'>
                    <span><?="$order_price_per_unit ₴ /$order_unit" ?></span>
                    <span><?="$order_quantity $order_unit. по $order_price_per_unit ₴" ?></span>
                </p>

                <p class='history_item_hidden_products_li_total'>
                    <?=addSpaceForThousands($order_summ_price_per_unit)?> ₴
                </p>
            </li>

            <?endwhile; endif; endwhile;
            
            // Last row with total price ?>
            <li>
                <span></span>
                <span></span>
                <p></p>
                <p></p>
                <p class='history_item_hidden_products_li_summa'>
                    Загалом: <?=$summaWithSpaces?> ₴
                </p>
            </li>
        </ul>

    </div>
</div>