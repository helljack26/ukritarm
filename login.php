<?php
include('includes/config.php');
include('includes/config_google.php');
require_once 'function.php';

// Real title 15
$page_data = getTitleGoogle();
$title_google = $page_data['title_google'];
// Real title end

?>

<!DOCTYPE html>
<html lang="uk">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta property="og:title" content="<?=$soc_title?>" />
    <meta property="og:image" content="images/information/<?=$soc_image?>" />
    <meta property="og:description" content="<? echo($soc_description);?>" />

    <meta name="description" content="<? echo($soc_description);?>">

    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title><?=$title_google?></title>

    <?php include('includes/links.php');?>

    <link rel="stylesheet" href="assets/css/login.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>

        <div class="account_headers">
            <button type='button' class="account_col_left_header">
                <span class="account_col_left_header_signup">
                    Реєстрація
                </span>
            </button>

            <button type='button' class="account_col_right_header account_headers_active">
                <span class="account_col_right_header_signin">
                    Авторизація
                </span>
            </button>
        </div>

        <div class="account_row">
            <!-- Sign up -->
            <form class="account_col_left_form" method="post" name="register" onSubmit="return valid();"
                autocomplete="off">

                <span class="account_col_left_form_title">
                    <span class='account_col_left_form_title_warn_icon'></span>

                    Після реєстрації Вам будуть доступні такі функції сайту як: «історія замовлень» та детальна
                    інформація про замовлений товар.
                </span>

                <div class="account_col_left_form_row">

                    <!-- Left sign up column -->
                    <div class="account_col_left_form_col">
                        <!-- Name -->
                        <div class='form_col_item'>
                            <input type="text" id="firstname" name="firstname" class="form_col_item_input" required>

                            <label for="firstname" class='form_col_item_label'>
                                Iм'я*
                            </label>
                        </div>

                        <!-- Middle name -->
                        <div class='form_col_item'>
                            <input type="text" id="midlename" name="midlename" class="form_col_item_input">

                            <label for="midlename" class='form_col_item_label'>
                                По батьковi
                            </label>
                        </div>

                        <!-- Last name -->
                        <div class='form_col_item'>
                            <input type="text" id="lastname" name="lastname" class="form_col_item_input" required>

                            <label for="lastname" class='form_col_item_label'>
                                Прiзвище*
                            </label>
                        </div>

                        <!-- Email -->
                        <div class='form_col_item'>
                            <input type="email" id="email" name="emailid" class="form_col_item_input"
                                onBlur="userAvailability()" autocomplete="off" required>

                            <label for="email" class='form_col_item_label'>
                                Email*
                            </label>
                            <span id="form_col_item_availability"></span>
                        </div>

                        <!-- Phone number -->
                        <div class='form_col_item'>
                            <input type="text" id="contactno" name="contactno" class="form_col_item_input"
                                placeholder="+38(___)_______*" maxlength="12" required>
                        </div>
                    </div>


                    <!-- Right sign up column -->
                    <div class="account_col_left_form_col">

                        <!-- Password -->
                        <div class='form_col_item'>
                            <span id='show-pass' class="form_col_item_showpass"></span>

                            <input type="password" id="password" name="password" class="form_col_item_input" required>


                            <label for="password" class='form_col_item_label'>
                                Пароль*
                            </label>
                        </div>
                        <!-- Confirm password -->
                        <div class='form_col_item'>
                            <span id='show-pass2' class="form_col_item_showpass"></span>
                            <input type="password" id="confirmpassword" name="confirmpassword"
                                class="form_col_item_input" required>

                            <label for="confirmpassword" class='form_col_item_label'>
                                Підтвердження пароля*
                            </label>
                            <span id="form_col_item_pass_error"></span>
                        </div>

                        <!-- Hint -->
                        <span class="form_col_hint">
                            Поля з <i> * </i> обов'язкові
                        </span>

                        <div>
                            <button type="submit" name="submit" class="form_col_submit">
                                Зареєструватися
                            </button>
                            <!-- Agreement -->
                            <span class='form_col_agreement'>
                                * Натискаючи кнопку, ви даєте згоду на обробку персональних даних.
                            </span>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Sign in -->
            <form class="account_col_right_form" method="post">

                <!-- Google autentification -->
                <a href='<?= $login_url;?>' class="form_item_google">
                    <span>Увійти через</span>
                    <img src="assets/icon/social/google_logo.svg" alt="Google logo" width='74px'>
                </a>

                <!-- Login error -->
                <? if(strlen($_SESSION['errmsg'])>0){?>
                <div class='form_col_error'>
                    <span>
                        <?= htmlentities($_SESSION['errmsg']); ?>
                        <?= htmlentities($_SESSION['errmsg']=""); ?>
                    </span>
                </div>
                <? } ?>

                <!-- Email -->
                <div class="form_col_item form_col_item_mb">
                    <input type="email" name="email" id="email_login" class='form_col_item_input' required>

                    <label for="email_login" class="form_col_item_label">
                        Email
                    </label>
                </div>

                <!-- Password -->
                <div class="form_col_item">
                    <span id='show-pass3' class="form_col_item_showpass"></span>
                    <input type="password" name="password" class="form_col_item_input pass3" id="pass_login" required>

                    <label for="pass_login" class="form_col_item_label">
                        Пароль
                    </label>
                </div>

                <div class="form_col_link">
                    <button type='button' id='pass_restore_open'>
                        Забули пароль?
                    </button>
                </div>

                <button type="submit" id='submit_login' class="form_col_submit" name="login">
                    Увійти
                </button>
            </form>

        </div>
    </main>

    <div id="pass_restore_popup">
        <div class="pass_restore_popup_bg"></div>

        <div class="pass_restore_popup_wrapper">
            <div class="pass_restore_popup_content">
                <!-- Popup header -->
                <div class="pass_restore_popup_content_header">
                    <span>
                        Відновлення пароля
                    </span>
                    <button type="button" class="pass_restore_popup_content_header_close"></button>
                </div>

                <!-- Pass restore  -->
                <div class="pass_restore_popup_content_form">
                    <!-- Success window -->
                    <div class="pass_restore_popup_content_form_success">
                        <div class="pass_restore_popup_content_form_success_block">
                            <h3>Надіслано!</h3>
                            <p>Перевірте свою почту і перейдіть за посиланням!</p>
                        </div>
                    </div>

                    <!-- Form -->
                    <span>Відправте на свою почту посилання, за яким зможете відновити пароль</span>

                    <input type="text" id='pass_restore_popup_content_form_input' placeholder='Email' />

                    <!-- List of departments -->
                    <span class='pass_restore_popup_content_form_error'></span>

                    <button type='button' class='pass_restore_popup_content_form_button'>Відправити</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('includes/footer.php');?>

    <script type="text/javascript" src="assets/js/account.js"></script>
    <script type="text/javascript" src="assets/js/login.js"></script>

</body>

</html>