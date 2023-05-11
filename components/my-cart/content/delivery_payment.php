<div class="mycart_row_left_delivery_payment">

    <!-- Delivery -->
    <section class="my_cart_delivery">
        <div class="my_cart_delivery_header">
            <h2>Доставка</h2>

            <div class="my_cart_delivery_header_col">
                <span>
                    Ваше місто:
                </span>
                <span class="nova_poshta_city_btn" data="8d5a980d-391c-11dd-90d9-001a92567626">
                    Київ
                </span>
            </div>
        </div>

        <div class="my_cart_delivery_block">
            <!-- Самовивіз -->
            <div class="my_cart_delivery_block_item my_cart_delivery_block_item_active">
                <div class="my_cart_delivery_block_item_row">
                    <button type='button' data-id='1' data-is-open='true' class="my_cart_delivery_block_item_radiobox">
                        <i></i>
                        <div>
                            <span class="delivery_type">Самовивіз зі складу</span>
                            <span>
                                <nobr>&nbsp;(1 - 2 дні)</nobr>
                            </span>
                        </div>
                    </button>
                </div>

                <span class='my_cart_delivery_block_item_address'>
                    Вулиця Київський шлях, 117і, с. Велика Олександрівка, Київська область, 08370.
                </span>
            </div>


            <!-- Nova post -->
            <div class="my_cart_delivery_block_item">
                <div class="my_cart_delivery_block_item_row">
                    <button type='button' data-id='2' data-is-open='false' class="my_cart_delivery_block_item_radiobox">
                        <i></i>
                        <div>
                            <span class="delivery_type">Самовивіз із відділення Нової Пошти</span>
                            <span>
                                <nobr>&nbsp;(2 - 3 дні)</nobr>
                            </span>
                        </div>
                    </button>
                </div>

                <!-- Department list -->
                <?php include('novaposhta_dropdown.php');?>
            </div>


            <!-- Адресна доставка Нової почти -->
            <div class='my_cart_delivery_block_item'>
                <div class="my_cart_delivery_block_item_row">
                    <button type='button' data-id='3' data-is-open='false' class="my_cart_delivery_block_item_radiobox">
                        <i></i>
                        <div>
                            <span class="delivery_type">Адресна доставка Нової почти</span>
                            <span>
                                <nobr>&nbsp;(2 - 3 дні)</nobr>
                            </span>
                        </div>
                    </button>
                </div>

                <div class="my_cart_delivery_block_item_hidden">

                    <div class="my_cart_delivery_block_item_hidden_row">
                        <!-- Street -->
                        <div class='form_col_item'>
                            <input type="text" id="street" class="form_col_item_input">
                            <label for="street" class='form_col_item_label'>Вулиця*</label>
                        </div>

                        <!-- House number -->
                        <div class='form_col_item'>
                            <input type="text" id="house" class="form_col_item_input">
                            <label for="house" class='form_col_item_label'>Будинок*</label>
                        </div>

                        <!-- Appartment Number -->
                        <div class='form_col_item'>
                            <input type="text" id="apartment" class="form_col_item_input">
                            <label for="apartment" class='form_col_item_label'>Квартира</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment -->
    <section class="my_cart_payment">
        <h2>Спосіб оплати</h2>

        <div class="my_cart_payment_block">
            <button type='button' data-id='1' data-is-open='true'
                class="my_cart_payment_block_radiobox my_cart_payment_block_radiobox_active">
                <i></i>
                Готівкою або картою при отриманні
            </button>

            <p class='nova_poshta_payment_message'>
                Вартість доставки за тарифами Нової Пошти від 65 грн та
                комісія за післяплату 20 грн. + 2% від суми замовлення
            </p>
            <button type='button' data-id='2' data-is-open='false' class="my_cart_payment_block_radiobox">
                <i></i>
                Онлайн оплата карткою (LiqPay)
            </button>

            <p class='nova_poshta_payment_message'>
                Вартість доставки за тарифами Нової Пошти від 65 грн
            </p>

            <button type='button' data-id='3' data-is-open='false' class="my_cart_payment_block_radiobox">
                <i></i>
                <span>
                    По безготівковому розрахунку (рахунок-фактура)
                </span>
            </button>

            <div class="my_cart_payment_block_payment">
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
            </div>
        </div>
    </section>

    <!-- Comment -->
    <section class="my_cart_comment">
        <h2>Коментар до замовлення</h2>

        <div class="my_cart_comment_block">
            <textarea name="comment" id="comment" rows='5'></textarea>
        </div>
    </section>
</div>