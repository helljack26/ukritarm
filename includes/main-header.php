<?php 
// Get count items from basket
$get_basketCountItems = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$user_email = isset($_SESSION['login']) ? $_SESSION['login'] : '';
$isLoginedUser = gettype($user_email) === 'NULL';
$base_url = strtok($_SERVER['REQUEST_URI'], '?');
$trim_base_url = trim($base_url, '/');
?>

<!-- Preloader -->
<div id="preloader">
    <img src="assets/loader_screen.svg" width="300px">
</div>

<?php include('header/mobile_menu.php');?>

<header>
    <!-- Logo -->
    <a href="/" class="header_logo">
        <img src="assets/logo.svg" width="230px" alt="Ukritarm logo">
    </a>

    <!-- First row -->
    <div class="header_first">
        <div class="header_first_wrapper">

            <!-- Left empty block -->
            <div class="header_first_left"></div>

            <!-- Right -->
            <div class='header_first_right'>
                <!-- Search -->
                <div class="header_first_right_search">
                    <form class="header_first_right_search_block">

                        <input class="header_first_right_search_block_input" placeholder="Пошук на Ukritarm..."
                            name="search" autocomplete='off' />
                        <button type="submit" class='disabled_search_button'>
                            <span class="header_first_right_search_block_btn_text">
                                Знайти
                            </span>
                            <!-- Mobile icon -->
                            <span class="header_first_right_search_block_btn_icon"></span>
                        </button>
                    </form>
                    <button type="button" class="header_first_right_search_button"></button>

                    <!-- Search results -->
                    <div class="header_first_right_search_results"></div>
                </div>

                <!-- Basket -->
                <div class="header_first_right_basket">
                    <button class="header_first_right_basket_btn">
                        <span class="basket_btn_icon"></span>
                        <span class='header_first_right_basket_btn_icon_badge count' style="display:
                            <?= $get_basketCountItems == 0 ? "none": '';?>">

                            <?= $get_basketCountItems;?>
                        </span>
                    </button>
                    <!-- Basket items -->
                    <div class="header_first_right_basket_block">
                    </div>
                </div>

                <!-- Login / logout icons -->
                <? if($isLoginedUser){ ?>
                <a href="login" class="header_first_log_block_login">
                    <span class="header_first_log_block_login_icon"></span>
                </a>
                <? } else{ ?>
                <a href="my-account" class="header_first_log_block_login">
                    <span class="header_first_log_block_login_icon"></span>
                </a>
                <? } ?>
            </div>
        </div>
    </div>

    <!-- Second row -->
    <div class="header_second">
        <!-- Left -->
        <div class="header_second_col">
            <a href="/" class="header_link header_link_main">Головна</a>

            <button type='button' class="header_link header_link_category" data-type='all-category'>
                <span class="header_link_category_trigger">
                    Продукція
                </span>
                <!-- Category menu -->
                <?php include('header/category_menu.php');?>
            </button>

            <button type='button' class="header_link header_link_services" data-type='services'>
                <span class="header_link_services_trigger">
                    Послуги
                </span>
                <!-- Services menu -->
                <?php include('header/services_menu.php');?>
            </button>
        </div>

        <!-- Right -->
        <div class="header_second_col header_second_col_right">
            <a href="aboutus" class='header_link header_link_aboutus'>Про нас</a>
            <a href="news" class='header_link header_link_news'>Новини</a>
            <a href="contact" class='header_link header_link_contact'>Контакти</a>
        </div>
    </div>

</header>