<?php
include('includes/config.php');
include('function.php');
$sessionLogin = isset($_SESSION['login']) ? $_SESSION['login'] : '';
if(strlen($sessionLogin) == 0) {   
    header('location:login');
} else {
    date_default_timezone_set('Europe/Kiev');
    $currentTime = date( 'd-m-Y h:i:s A', time () );
    
    if(isset($_POST['update'])){
        
        $sessionId= $_SESSION['id'];
        $password = md5($_POST['cpass']);

        $sql=mysqli_query($con,"SELECT password 
                                FROM users
                                WHERE password='$password' 
                                AND id='$sessionId'
                                ");

        $num=mysqli_num_rows($sql);

        if($num>0){
            $newPass =md5($_POST['newpass']);
            $con=mysqli_query($con,"UPDATE users 
                                    SET password='$newPass', updationDate='$currentTime' 
                                    WHERE id='$sessionId'
                                    ");

            $_SESSION['successmsg'] = "Пароль успішно змінено!";
        }
    }
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
    <meta name="robots" content="all">

    <title>Зміна пароля | UKRITARM</title>
    <?php include('includes/links.php');?>

    <link rel="stylesheet" href="assets/css/my-account.min.css">
    <link rel="stylesheet" href="assets/css/change_password.min.css">
</head>

<body>
    <!-- Header -->
    <?php include('includes/main-header.php');?>

    <main>
        <!-- Title -->
        <h1>
            Власний кабінет
        </h1>

        <div class="account_row">

            <!-- Зміна пароля -->
            <div class="account_col_left">

                <div class="account_col_left_header">
                    <span>
                        Зміна пароля
                    </span>
                </div>

                <form class="account_col_left_form" method="post" name="update_pass" onSubmit="return valid();"
                    autocomplete="off">

                    <? if(isset($_SESSION['successmsg'])){?>
                    <div class='form_col_success'>
                        <span>
                            <?= htmlentities($_SESSION['successmsg']); ?>
                            <? $_SESSION['successmsg']=""; ?>
                        </span>
                    </div>
                    <?}?>

                    <div class="account_col_left_form_row">
                        <!-- Left sign up column -->
                        <div class="account_col_left_form_col">
                            <!-- Password -->
                            <div class='form_col_item'>
                                <span id='show-pass' class="form_col_item_showpass"></span>

                                <input type="password" id="cpass" name="cpass" class="form_col_item_input" required>

                                <label for="cpass" class='form_col_item_label'>
                                    Поточний пароль
                                </label>
                            </div>
                            <!-- New password -->
                            <div class='form_col_item'>
                                <span id='show-pass3' class="form_col_item_showpass"></span>
                                <input type="password" id="newpass" name="newpass" class="form_col_item_input" required>

                                <label for="newpass" class='form_col_item_label'>
                                    Новий пароль
                                </label>
                            </div>

                            <!-- Confirm password -->
                            <div class='form_col_item'>
                                <span id='show-pass2' class="form_col_item_showpass"></span>
                                <input type="password" id="cnfpass" name="cnfpass" class="form_col_item_input" required>

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

            <!-- Side bar -->
            <?php include('includes/account-sidebar.php');?>
        </div>
    </main>

    <!-- Footer -->
    <?php include('includes/footer.php');?>

    <script type="text/javascript" src="assets/js/account.js"></script>
    <script type="text/javascript" src="assets/js/my-account.js"></script>
</body>

</html>
<?php } ?>