<?php
include('includes/config.php');
include('function.php');

date_default_timezone_set('Europe/Kiev');
$currentTime = date( 'd-m-Y h:i:s A', time () );

$currentEmail = '';
?>
<!DOCTYPE html>
<html lang="uk">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>Вiдновлення пароля | Ukritarm</title>

    <?php include('includes/links.php');?>

    <link rel="stylesheet" href="assets/css/my-account.min.css">
    <link rel="stylesheet" href="assets/css/forgot_password.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <!-- Title -->
        <h1>
            Вiдновлення пароля
        </h1>
        <span class='main_subtext'>для користувача '<?=$currentEmail?>'</span>

        <div class="account_row">

            <!-- Зміна пароля -->
            <div class="account_col_left">

                <form class="account_col_left_form" method="post" name="update_pass" onSubmit="return valid();"
                    autocomplete="off">
                    <input type="hidden" name='key' value='<?=$_GET['key']?>'>
                    <input type="hidden" name='name' value='<?=$_GET['reset']?>'>
                    <input type="hidden" name='current_email' value='<?=$currentEmail?>'>

                    <div class="account_col_left_form_row">
                        <!-- Left sign up column -->
                        <div class="account_col_left_form_col">

                            <!-- New password -->
                            <div class='form_col_item'>
                                <span id='show-pass3' class="form_col_item_showpass"></span>
                                <input type="password" id="cpass" name="newpass" class="form_col_item_input" required
                                    autocomplete='off'>

                                <label for="newpass" class='form_col_item_label'>
                                    Новий пароль
                                </label>
                            </div>

                            <!-- Confirm password -->
                            <div class='form_col_item'>
                                <span id='show-pass2' class="form_col_item_showpass"></span>
                                <input type="password" id="cnfpass" name="cnfpass" class="form_col_item_input" required
                                    autocomplete='off'>

                                <label for="newpass" class='form_col_item_label'>
                                    Підтвердження пароля
                                </label>
                                <span id="form_col_item_pass_error"></span>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" name="update" class="form_col_submit">
                                Змінити пароль
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>
    <script type="text/javascript" src="assets/js/account.js"></script>
    <script type="text/javascript" src="assets/js/my-account.js"></script>

</body>

</html>