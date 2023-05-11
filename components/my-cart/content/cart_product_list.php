<aside>
    <a href="all-category" class="aside_header">
        <span>Додати</span>
        <span>ще продукцію</span>
    </a>

    <div class="aside_block">
        <h2>Оформлення замовлення</h2>

        <!-- My cart list -->
        <div class="aside_block_products">
        </div>

        <!-- Quantity -->
        <div class="aside_block_products_row">
            <span>Загальна кількість</span>

            <span class='count aside_block_products_row_count'>0 шт</span>
        </div>

        <!-- Total summ price -->
        <div class="aside_block_products_row">
            <span>Всього до оплати</span>

            <span class='basket_price_sum aside_block_products_row_sum'>
                <?=$price?> ₴
            </span>
        </div>

        <!-- Submit order -->
        <button id="cart-add" class="aside_block_cart_add">
            Оформити замовлення
        </button>

        <!-- Agreement -->
        <span class="aside_block_agreement">
            *Натискаючи оформити замовлення я приймаю умови публічної
            <a href="/information/oferta" target="_blank">оферти</a>
            та надаю згоду на
            <a href="/information/personalDate" target="_blank">обробку персональних даних</a>
        </span>
    </div>
</aside>