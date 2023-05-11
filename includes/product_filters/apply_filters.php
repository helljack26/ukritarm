<?php
include('../../includes/config.php');
include('../../function.php');

$sqlQuery = $_POST['sqlQuery'];
$isPopularSort = $_POST['isPopularSort'];

$category = $_POST['category'];
$sub_сategory = $_POST['sub_сategory'];


if(isset($sub_сategory) && isset($sqlQuery)){ 
    $ret=mysqli_query($con,"SELECT * 
                            FROM products 
                            WHERE category='$category' 
                            AND sub_category='$sub_сategory' 
                            $sqlQuery
                            ");
    
    if ($ret) {
        $num=mysqli_num_rows($ret);
        // New array with field reviewsCount  
        $popularSortedItems = [];
        
        if($num>0){
            if ($isPopularSort == 'true') { 
                while ($row=mysqli_fetch_array($ret)): 
                    // Get reviews count from product reviews
                    $reviewRow = mysqli_query($con,"SELECT * 
                                                    FROM productreviews 
                                                    WHERE productId='$row[product_code]'
                                                    ");
                    $numReview = mysqli_num_rows($reviewRow);
                    if($numReview > 0){
                        $newRow = $row ;
                        $newRow += ["reviewsCount" => $numReview];
                        array_push($popularSortedItems, $newRow);
                    }else{
                        $newRow = $row;
                        $newRow += ["reviewsCount" => 0];
                        array_push($popularSortedItems, $newRow);
                    }
                endwhile; 
                usort($popularSortedItems, function($a, $b){
                    return ($b['reviewsCount'] - $a['reviewsCount']);
                });
                $i = 0;
                while ($i < count($popularSortedItems)): 
                    $row_product_card_item = $popularSortedItems[$i];
                    include('../../components/common/product_small_card.php');
                    $i++;
                endwhile; 
            }else{
                while ($row_product_card_item=mysqli_fetch_array($ret)): 
                    include('../../components/common/product_small_card.php');
                endwhile; 
            }
        } else {
            echo('<h2 class="product_category_row_results_block_empty">За цим запитом товари не знайдені.</h2>');
        } 
    }
}
?>