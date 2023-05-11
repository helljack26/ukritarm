<? 
$serviceId = $rowService['id'];
$servicesName = codeToQuote($rowService['servicesName']);
$servicesText = codeToQuote($rowService['servicesShortDescription']);
$imageUrl = $rowService['image_url_index'];
?>

<div class="services_row_results_item wow fadeInUp">
    <!-- Bg image -->
    <div class="services_row_results_item_image">
        <img src="/images/<?= $imageUrl?>" width="100%" height="100%" />
    </div>

    <!-- Name -->
    <a href="services-details/<?=transliterate($servicesName)?>" class="services_row_results_item_name">
        <?= $servicesName; ?>
    </a>

    <!-- Hovered services info -->
    <div class="services_row_results_item_hidden">
        <span>
            <?= html_entity_decode($servicesText); ?>
        </span>

        <a href="services-details/<?=transliterate($servicesName)?>">
            Детальніше
        </a>
    </div>
</div>