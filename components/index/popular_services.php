<?require_once 'function.php';?>

<div class="popular_services">
    <div class="popular_services_block">

        <h3 class="popular_services_block_header">
            <span data-edit='popular_services_1'>
                <?=html_entity_decode($parsedData['popular_services_1'])?>
            </span>
            <span data-edit='popular_services_2'>
                <?=html_entity_decode($parsedData['popular_services_2'])?>
            </span>
        </h3>

        <!-- Services results -->
        <div class="services_row_results">
            <?php 
                $getServices = mysqli_query($con,"SELECT *  FROM services 
                                                    WHERE index_position > 0
                                                    ORDER BY index_position 
                                                    LIMIT 3");
                while ($rowService = mysqli_fetch_array($getServices)){
                    
                    include('components/services/services_item.php');
                }
            ?>
        </div>
    </div>
</div>