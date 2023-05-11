<div class="header_hidden_menu header_hidden_menu_services">
    <div class="header_services_menu">
        <?
            $getServices = mysqli_query($con,"SELECT 
                                                servicesName,
                                                image_url_index 
                                                from services
                                                ");  
        while($rowServices = mysqli_fetch_array($getServices)):
            $quotedName = codeToQuote($rowServices['servicesName']);
            $imageUrl = $rowServices['image_url_index'];
        ?>
        <a href="services-details/<?=transliterate($quotedName)?>" class="header_services_menu_item">
            <img src="images/<?= $imageUrl?>" width="162px" height="92px" />

            <span>
                <?=$quotedName?>
            </span>
        </a>
        <?endwhile;?>
    </div>
</div>