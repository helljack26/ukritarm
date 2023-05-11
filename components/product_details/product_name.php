<div class="breadcrumbs_block">
    <a href='/'>
        Головна
    </a>
    <a href='category/<?=$transCatName?>'>
        <?=$categoryName?>
    </a>
    <a href="sub-category/<?=transliterate($subcat_name)?>">
        <?=$subcat_name?>
    </a>
    <span>
        <?=$c_product_name;?>
    </span>
</div>

<!-- Product name -->
<h1>
    <?= generateProductName($c_product_name , $c_product_articul_name ,$c_product_articul);?>
</h1>