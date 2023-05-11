<?
$sub_product = '';

// Min price
$minValue = 0;
// Get max price and round to 100
$retMax=mysqli_query($con,"SELECT product_price 
                            FROM products 
                            WHERE category='$cat' 
                            AND sub_category='$cid' 
                            ORDER BY product_price DESC
                            ");
$retMaxNum = mysqli_num_rows($retMax);

$maxValue = 100;
if ($retMaxNum > 0) {
    $rowMax=mysqli_fetch_array($retMax);
    $roundMax = round($rowMax[0]);
    $bcmod100 =  100 - ($roundMax % 100);
    $maxValue = round($rowMax[0]) + $bcmod100;
}
// Price range step
$priceRangeStep = 50;
?>

<link rel="stylesheet" href="assets/css/product_filters.min.css" />

<div class="product_filters_mobile_bg"></div>
<div class="product_filters" data="0">
    <button type="button" class="product_filters_container_header">
        <span>
            Фiльтри
        </span>
        <div class="product_filters_container_header_icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- For mobile header close event -->
        <div class="product_filters_container_header_icon_sidefilters">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </button>

    <div class="product_filters_container">
        <!-- Price -->
        <section class="product_filters_container_item">
            <button type="button" class="product_filters_container_item_header" style='pointer-events: none;'>
                <p>
                    Ціна (грн)
                </p>
            </button>

            <div class="product_filters_container_item_hidden">
                <div class="range_slider">
                    <!-- Price range inputs -->
                    <span class="range_slider_row">
                        <input class="range_slider_row_input" id="price_range_min" type="number" value="<?=$minValue?>"
                            min="<?=$minValue?>" max="<?=$maxValue?>" />
                        <input class="range_slider_row_input" id="price_range_max" type="number" value="<?=$maxValue?>"
                            min="<?=$minValue?>" max="<?=$maxValue?>" />

                        <button type="button" class="range_slider_button range_slider_button_disable">OК</button>
                    </span>

                    <!-- Price range slider -->
                    <div class="range_slider_row_track">

                        <div id="slider-range"></div>
                        <input type="hidden" name="min-value" value="">
                        <input type="hidden" name="max-value" value="">

                    </div>
                </div>
            </div>
        </section>

        <? 
        // <!-- Filter for mysql column -->
        $getAllAttributes=mysqli_query($con,"SELECT id, attributes 
                                            from products 
                                            WHERE category='$cat' 
                                            and sub_category='$cid'
                                            and product_price > 1 
                                            GROUP BY product_code
                                            ");
        // name and value
        $tempName = [];
        $tempValue = [];
        // With name and value
        $tempItems = [];
        
        while ($rowAttributes = mysqli_fetch_array($getAllAttributes)) {
            $str = $rowAttributes['attributes'];
            $id = $rowAttributes['id'];   
            
            // Convert the JSON to an associative array
            $someArray = json_decode($str, true);
            // Read the elements of the associative array
            $i = 0;
            foreach($someArray as $key => $value ) {
                $getName=mysqli_query($con,"SELECT attributes->'$.\"$key\".name' AS name, 
                                            (SELECT attributes->'$.\"$key\".value' AS value) 
                                            FROM products 
                                            WHERE id='$id' 
                                            and category='$cat'
                                            and sub_category='$cid' 
                                            and product_price > 1 
                                            GROUP BY product_code
                                            ");
                while ($rowName = mysqli_fetch_array($getName)):
                    // Check in db category should hide

                    $isExistFilters = false;
                    $getExistedFilters = mysqli_query($con,"SELECT * from filters_dont_show");
                    while ($rowExistedFilters = mysqli_fetch_array($getExistedFilters)){
                        if (strpos($rowName[0], $rowExistedFilters['filter_name']) !== false) {
                            $isExistFilters = true;
                        } 
                    }

                    if ( $isExistFilters === true ) {
                        break;
                    }
                    array_push($tempName, $rowName[0]);
                    array_push($tempValue, $rowName[1]);

                    // Option with name and value
                    $tempItem = (object) [
                        'cat_name' => $rowName[0],
                        'hash' => $key,
                        'value' => $rowName[1],
                    ];
                    $tempItems[$rowName[1]] = $tempItem; 
                    $i++;
                endwhile;
            }
        }


        // Names
        $namesValueCount = array_count_values(array_column($tempItems, 'cat_name'));

        $uniqueNames = array_unique($tempName);
        sort($uniqueNames);

        foreach ($uniqueNames as $name) {
            $cleanName = cleanName($name);
        ?>
        <!-- Type -->
        <section class="product_filters_container_item">
            <button type="button" class="product_filters_container_item_header">
                <p>
                    <?= $cleanName; ?>
                </p>
                <span class="product_filters_container_item_header_arrow">
                </span>
            </button>

            <div class="product_filters_container_item_hidden">
                <? $i = 0;?>
                <div class=" ">
                    <?
                    // Get child
                    foreach($tempItems as $name => $value):
                        $cleanItemName = cleanName($value->cat_name);
                        $cleanItemValue = substr($value->value, 1, -1);
                        $itemHash = $value->hash;
                        
                        $cleanCatForNum = substr($value->cat_name, 1, -1);
                        if ($cleanName == $cleanItemName):
                            $getNum=mysqli_query($con,"SELECT * FROM products 
                                                        WHERE attributes->'$.\"$itemHash\".name'='$cleanCatForNum'
                                                        AND attributes->'$.\"$itemHash\".value' LIKE '%$cleanItemValue%'
                                                        AND category='$cat' 
                                                        AND sub_category='$cid' 
                                                        AND product_price > 1 
                                                        GROUP BY product_code
                                                        ");

                        $optionNumbers=mysqli_num_rows($getNum);
                        ++$i; 
                        if($i < 5):
                    ?>

                    <div class="item_hidden_list_row">
                        <input class="item_hidden_list_row_checkbox" type="checkbox" data-hash="<?= $itemHash?>"
                            data-cat="<?= $cleanItemName?>" name="<?= $cleanItemValue?>"
                            id="<?= $cleanItemValue . $itemHash?>">

                        <label class="item_hidden_list_row_label" for="<?= $cleanItemValue . $itemHash?>"
                            data-hash="<?= $itemHash?>" data-cat="<?= $cleanItemName?>" name="<?= $cleanItemValue?>">
                            <?= $cleanItemValue . ' ('. $optionNumbers .')'?>
                        </label>
                    </div>

                    <? endif;    
                    
                    if($i === 5 ): 
                        $numOfMore = 0;
                        $cleanItemName = explode(' ', $cleanItemName );
                        foreach($namesValueCount as $name => $value){
                            $cleanTempName = substr($name, 1, -1);
                            $cleanTempName = explode(' ', $cleanTempName );
                            if($cleanTempName[0] === $cleanItemName[0]) {
                                $numOfMore = $value;
                            }
                        }
                        ?>

                    <button type="button" class="item_hidden_list_more_btn">
                        Ще (<?=$numOfMore % 4?>)
                    </button>

                    <? endif;  endif; endforeach; ?>

                    <div class="item_hidden_list_more_block">
                        <?
                        $i2 = 0;
                        foreach($tempItems as $name => $value):
                            $cleanItemName = cleanName($value->cat_name);
                            $cleanItemValue = substr($value->value, 1, -1);
                            $itemHash = $value->hash;
                            
                            $cleanCatForNum = substr($value->cat_name, 1, -1);
                            if ($cleanName == $cleanItemName):
                                $getNum=mysqli_query($con,"SELECT * FROM products 
                                                            WHERE attributes->'$.\"$itemHash\".name'='$cleanCatForNum'
                                                            AND attributes->'$.\"$itemHash\".value' LIKE '%$cleanItemValue%'
                                                            AND category='$cat' 
                                                            AND sub_category='$cid'
                                                            AND product_price > 1 
                                                            GROUP BY product_code
                                                            ");
                            $optionNumbers=mysqli_num_rows($getNum);
                            
                        ++$i2;
                        if($i2 > 4):
                        ?>

                        <div class="item_hidden_list_row">
                            <input class="item_hidden_list_row_checkbox" type="checkbox" data-hash="<?= $itemHash?>"
                                data-cat="<?= $cleanItemName?>" name="<?= $cleanItemValue?>"
                                id="<?= $cleanItemValue . $itemHash?>">

                            <label class="item_hidden_list_row_label" for="<?= $cleanItemValue . $itemHash?>"
                                data-hash="<?= $itemHash?>" data-cat="<?= $cleanItemName?>"
                                name="<?= $cleanItemValue?>">
                                <?= $cleanItemValue . ' ('.$optionNumbers.')'?>
                            </label>
                        </div>
                        <? endif; endif; endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <? } ?>
    </div>
</div>