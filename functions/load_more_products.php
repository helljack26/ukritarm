<?php
include('../includes/config.php');
include('../function.php');

$searchQuery= $_POST['searchQuery'];
$startId=$_POST['start'];
$endId=$_POST['end'];

$retDistinct=mysqli_query($con,"SELECT product_code, product_articul, product_work_name
                                FROM products
                                WHERE product_price > 1
                                $searchQuery
                                ORDER BY product_availability DESC
                                ");
$numDistinct = 0;
if ($retDistinct) {   
    $numDistinct=mysqli_num_rows($retDistinct);
}

// For set in scripts max num of rows
if (isset($_POST['isGetNum']) == true) {
    echo($numDistinct);
    exit;
}

if($numDistinct>0):
    $i=0;
    $iLoadMoreItem = 0;
    $existedNames = [];
    
    while($rowDisctinct=mysqli_fetch_array($retDistinct)):   
        $isExist = array_search($rowDisctinct['product_work_name'], $existedNames);
        
        if ($isExist === false):                            
            
            ++$iLoadMoreItem;

            if($iLoadMoreItem > $startId && $iLoadMoreItem < $endId){
                array_push($existedNames, $rowDisctinct['product_work_name']);
                $ret=mysqli_query($con,"SELECT * 
                                        from products 
                                        where organization='Вікар' 
                                        and product_code='$rowDisctinct[product_code]' 
                                        and product_articul='$rowDisctinct[product_articul]'
                                        ");
                $row=mysqli_fetch_array($ret);

                include('../includes/display_product_card_item.php');
            };
    endif;
endwhile;
endif;
?>