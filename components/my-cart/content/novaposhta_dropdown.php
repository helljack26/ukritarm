<div class="my_cart_delivery_block_item_hidden my_cart_delivery_block_item_hidden_np">
    <span class="hidden_novaposhta_header">
        <span
            class="hidden_novaposhta_header_text"><?= isset($order_department_np) ? $order_department_np : 'Оберіть потрібне Вам відділення із списку';?></span>

        <button type='button' class='hidden_novaposhta_header_arrow'></button>
    </span>

    <!-- List of departments -->
    <div id="hidden_novaposhta">
        <input type="text" id='novaposhta_search_department' placeholder='Пошук' autocomplete='false'>
        <ul id="hidden_novaposhta_block"></ul>
    </div>
</div>