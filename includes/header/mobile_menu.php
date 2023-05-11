<div class="mobile_menu">
    <!-- Mobile header -->
    <div class="mobile-navbar-header">

        <div class="mobile-navbar-header_left">
            <!-- Burger button -->
            <button class="mobile-navbar-toggle" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Logo -->
            <a href="/" class="mobile-navbar-header_logo">
                <img src="assets/logo.svg" alt="Ukritarm logo">
            </a>
        </div>

        <!-- Links -->
        <div class="mobile-navbar-header_links">
            <!-- Mobile basket link -->
            <a href="my-cart" class="mobile-navbar-header_links_basket">
                <span class="mobile-navbar-header_links_icon_basket_white_icon"></span>

                <span class='count' style="display:
                    <?
                    if($get_basketCountItems == 0) {
                        echo(" none"); } ?>;">
                    <? echo($get_basketCountItems);?>
                </span>
            </a>
        </div>
    </div>

    <!-- Side menu -->
    <div class="mobile-navbar-collapse" data='0'>

        <div class="mobile-navbar-collapse_login">
            <!-- Login -->
            <? $user_email = $_SESSION['login'];
            if(gettype($user_email) === 'NULL'){?>
            <a href="login">
                <span class="mobile-navbar-collapse_icon_user"></span>
                Увійти | Реєстрація
            </a>
            <?} else{ ?>
            <a href="my-account" style="justify-content: flex-start;">
                <span class="mobile-navbar-collapse_icon_user_login"></span>
                <?php
                    $query=mysqli_query($con,"SELECT * from users where email='$_SESSION[login]'");
                    while($row=mysqli_fetch_array($query)) {
                    ?>
                <div class="mobile-navbar-collapse_login_block">
                    <span>
                        <?php echo $row['name'];?>
                    </span>
                    <span>
                        <?php echo $row['email'];?>
                    </span>
                </div>
                <?php } ?>
            </a>
            <? } ?>
        </div>

        <!-- Side menu search form -->
        <form class="mobile-navbar-collapse_search">
            <input class="mobile-navbar-collapse_search_block_input" placeholder="Пошук на Ukritarm..." name="search"
                autocomplete='off' />

            <button type="submit" class='disabled_search_button'>
                <!-- Mobile icon -->
                <span class="mobile-navbar-collapse_search_block_btn_icon"></span>
            </button>
        </form>

        <!-- Navigation -->
        <div class="mobile-navbar-nav">
            <a class="header_link_main" href="/">Головна</a>
            <a class="header_link_category" href="all-category">Продукція</a>
            <a class="header_link_services" href="services">Послуги</a>
            <a class="header_link_aboutus" href="aboutus">Про нас</a>
            <a class="header_link_news" href="news">Новини</a>
            <a class="header_link_contact" href="contact">Контакти</a>
        </div>

        <!-- Logout -->
        <? $user_email = $_SESSION['login'];
        if(gettype($user_email) !== 'NULL'){?>
        <a href="logout" class="mobile-navbar-collapse_logout">
            <span class="mobile-navbar-collapse_logout_exit"></span>
            Вихід
        </a>
        <?}  ?>
    </div>

    <!-- Mobile bg  -->
    <div class="mobile_menu_bg"></div>
</div>