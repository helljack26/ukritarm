<?
// Postfix for id
$index_atricul = str_replace("/", "_", $product_articul);

$index = $c_code_top . $index_atricul;

$index = str_replace(" ", "_", $index);

$subtotal = addSpaceForThousands($subtotal);

$basketItem = "<li class='basket_block_ul_item'>
                    <input id='popup_basket_code_$index' value='$c_code_top' class='popup_basket_code' type='hidden' />
                    <input id='popup_basket_articul_$index' value='$product_articul' class='popup_basket_articul' type='hidden' />
                    <input id='popup_basket_price_$index' value='$price_unit' class='popup_basket_price' type='hidden' />
                    <input id='popup_basket_unit_$index' value='$product_unit' class='popup_basket_unit' type='hidden' />

                    <a href='$productLink' class='basket_block_ul_item_image'>
                        <img src='$c_photo' width='86px' height='86px'/>
                    </a>

                    <div class='basket_block_ul_item_info'>
                        <a href='$productLink' class='basket_block_ul_item_info_name'>
                            $c_product_name_top 
                        </a>

                        <div class='basket_block_ul_item_info_row'>
                            <span id='popup_basket_price_front_$index' 
                                    class='basket_block_ul_item_info_price' 
                                    data-old-price='$price_unit'>
                                $subtotal ₴
                            </span>
                        
                            <div class='basket_block_ul_item_info_row_quantity'>
                                <button class='basket_block_ul_item_info_row_quantity_btn' data-id='$index'>
                                    -
                                </button>

                                <input 
                                    type='number'
                                    id='popup_basket_quantity_$index'
                                    data-id='$index'
                                    value='$quantity'
                                    data-old='$quantity'
                                    min='1'
                                    class='basket_block_ul_item_info_row_quantity_input'
                                />
                                
                                <button class='basket_block_ul_item_info_row_quantity_btn' data-id='$index'>
                                        +
                                </button>
                            </div>
                            
                            <span class='basket_block_ul_item_info_unit'>
                                $product_unit
                            </span>
                        </div>
                    </div>
                    <button class='basket_block_ul_item_remove' data='$index' title='Видалити з кошику'></button>
                </li>";
?>