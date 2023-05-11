<?php
include('../includes/config.php');
include('../function.php');

// Main header search field
if($_POST['search']=="1"):
    $q = htmlspecialchars($_POST["q"]);
    if(!empty($q)):
    $getLikeProducts = mysqli_query($con,"SELECT product_name, product_articul, product_articul_name
                                            FROM products 
                                            WHERE product_name LIKE '%{$q}%' OR product_articul_name LIKE '%{$q}%'  
                                            LIMIT 5
                                            ");
    
    while($rowLikeProducts = mysqli_fetch_array($getLikeProducts)):
        $c_product_name = $rowLikeProducts['product_name'];
        $product_articul_name = $rowLikeProducts['product_articul_name'];
        $product_articul = $rowLikeProducts['product_articul'];
        
        $productLink = generateProductDetailsUrl($c_product_name, $product_articul);
        $c_product_name = generateProductName($c_product_name, $product_articul_name, $product_articul);
    ?>
<p>
    <a href="<?=$productLink?>">
        <?=$c_product_name?>
    </a>
</p>
<?endwhile; endif; exit; endif; ?>


<? // Search page 


if($_POST['search']=="2"):
    $q = htmlspecialchars($_POST["q"]);
    if(!empty($q)):
        $getLikeProducts = mysqli_query($con,"SELECT *
                                                FROM products 
                                                WHERE product_name LIKE '%{$q}%' OR product_articul_name LIKE '%{$q}%'  
                                                ");
                                                // -- LIMIT 30
        $numLikeProducts = mysqli_num_rows($getLikeProducts);
        
        if($numLikeProducts>0):
            while($rowDisctinct = mysqli_fetch_array($getLikeProducts)):   

                    $ret=mysqli_query($con,"SELECT * 
                                            FROM products 
                                            WHERE product_code='$rowDisctinct[product_code]' 
                                            AND product_articul='$rowDisctinct[product_articul]'
                                            ");
                    $row_product_card_item=mysqli_fetch_array($ret);
                    include('../components/common/product_small_card.php');
                
            endwhile;

        endif;
    endif; 
endif;
exit;
?>