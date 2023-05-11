<div class="news_list_item">
    <!-- News image -->
    <a href="single_news/<?=$newsRow['id']?>" class="news_list_item_img">
        <?if($newsRow['image']){?>
        <img src="images/<?= $newsRow['image'];?>" width="100%" />
        <?}?>
    </a>

    <!-- News info -->
    <div class="news_list_item_content">
        <!-- News item title -->
        <a href="single_news/<?=$newsRow['id']?>" class="news_list_item_content_title">
            <?=$newsRow['title']?>
        </a>
        <div class="news_list_item_content_scroll">
            <!-- News item text -->
            <div class="news_list_item_content_scroll_text">
                <?php 
                $text = $newsRow['text'];
                $text = stripslashes($text);
                echo $text
                ?>
            </div>
        </div>

        <!-- News item footer -->
        <div class="news_list_item_content_footer">
            <div class="news_list_item_content_footer_col">
                <!-- Category -->
                <span class="news_list_item_content_footer_category">
                    <?=$newsRow['category']?>
                </span>
                <!-- Date -->
                <span class="news_list_item_content_footer_date">
                    <?php
                        $explodedDate = explode(' ', $newsRow['date']);
                        $date = explode('-', $explodedDate[0]);
                        $cleanDate = array_reverse($date);
                        $cleanDate = implode('.', $cleanDate);
                        echo($cleanDate);
                    ?>
                </span>
            </div>
            <div class="news_list_item_content_footer_col">
                <a href="single_news/<?=$newsRow['id']?>">Читати далі</a>
            </div>

        </div>
    </div>
</div>