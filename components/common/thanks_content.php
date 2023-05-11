<? $isEditThanks = $_SERVER['PHP_SELF'] === '/components/common/thanks_content.php';
if ($isEditThanks =='1') {
    include('../../includes/config.php');
    include('../../function.php');
    echo('<link rel="stylesheet" href="../../assets/css/style.min.css">');
    $order_id = 999;
}

$isCartActionThanks = $_SERVER['PHP_SELF'] === '/components/my-cart/cart-action.php';

$isEditThanksPrefix = $isEditThanks == true || $isCartActionThanks == true ? '../../' : './';

$getPageContent = mysqli_query($con,"SELECT * from page_content where newid='8'");
$rowPageContent = mysqli_fetch_array($getPageContent);
$thanksContent = unserialize($rowPageContent['text']);
?>

<link rel="stylesheet" href="<?=$isEditThanksPrefix?>assets/css/thanks.min.css" />

<main>
    <div class="thanks">
        <div class="thanks_icon">
            <img src="<?=$isEditThanksPrefix?>assets/icon/my_cart_check_icon.svg" alt="">
        </div>

        <h1 data-edit='thanks_header_main'>
            <?= html_entity_decode($thanksContent['thanks_header_main'])?>
        </h1>

        <h2>
            <span data-edit='thanks_header_second_1'>
                <?= html_entity_decode($thanksContent['thanks_header_second_1'])?>
            </span>
            <?=$order_id;?>
            <span data-edit='thanks_header_second_2'>
                <?= html_entity_decode($thanksContent['thanks_header_second_2'])?>
            </span>
        </h2>

        <div class="thanks_texts">
            <span data-edit='thanks_header_text_1'>
                <?= html_entity_decode($thanksContent['thanks_header_text_1'])?>
            </span>
            <span data-edit='thanks_header_text_2'>
                <?= html_entity_decode($thanksContent['thanks_header_text_2'])?>
            </span>
        </div>

        <a href="/" data-edit='thanks_link'>
            <?= html_entity_decode($thanksContent['thanks_link'])?>
        </a>
    </div>
</main>