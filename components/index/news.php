<div class="news">
    <div class="news_block">

        <h3 class="news_block_header">
            <span data-edit='news_block_header_1'>
                <?=html_entity_decode($parsedData['news_block_header_1'])?>
            </span>
            <span data-edit='news_block_header_2'>
                <?=html_entity_decode($parsedData['news_block_header_2'])?>
            </span>
        </h3>

        <div class="news_list">
            <?  $getNews = mysqli_query($con,"SELECT * from news ORDER BY date DESC LIMIT 1");
                while($newsRow = mysqli_fetch_array($getNews)){
                    include('components/news/news_item.php');
                }
            ?>
        </div>

        <a href="news.php" class="news_block_link">
            Перейти до новин
        </a>
    </div>
</div>