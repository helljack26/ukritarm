<?php
include('includes/config.php');
include('function.php');

$sessionLogin = isset($_SESSION['login']) ? $_SESSION['login'] : '';
if(strlen($sessionLogin) == 0) {   
    header('location:login');
} else {
    $sessionId= isset($_SESSION['id']) ? $_SESSION['id'] : '';

	if(isset($_POST['update'])){
		$firstname=$_POST['firstname'];
		$midlename=$_POST['midlename'];
		$lastname=$_POST['lastname'];
		$emailid=$_POST['emailid'];
		$contactno=$_POST['contactno'];
        
		$query=mysqli_query($con,"UPDATE users 
                                    set name='$firstname',
                                    midle_name='$midlename',
                                    last_name='$lastname',
                                    email='$emailid',
                                    contactno='$contactno' 
                                    where id='$sessionId'
                                    ");
		if($query){
            $_SESSION['login']=$emailid;
            $_SESSION['successmsg'] = "Ваші дані були оновлені!";
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

    <title>Власний кабінет | UKRITARM</title>
    <?php include('includes/links.php');?>

    <link rel="stylesheet" href="assets/css/my-account.min.css">
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

            <!-- Особиста інформація -->
            <div class="account_col_left">

                <div class="account_col_left_header">
                    <span>
                        Особиста інформація
                    </span>
                </div>

                <form class="account_col_left_form" method="post" name="register" onSubmit="return valid();"
                    autocomplete="off">

                    <? if(isset($_SESSION['successmsg'])){?>
                    <div class='form_col_success'>
                        <span>
                            <?= htmlentities($_SESSION['successmsg']); ?>
                            <? $_SESSION['successmsg']=""; ?>
                        </span>
                    </div>
                    <? } ?>

                    <div class="account_col_left_form_row">
                        <?php
                            $query=mysqli_query($con,"SELECT * from users where id='$sessionId'");
                            $num_user_query = mysqli_num_rows($query);
                            if ($num_user_query > 0) {
                                $row=mysqli_fetch_array($query);
                                $user_name = $row['name'];
                            }
                        ?>
                        <!-- Left sign up column -->
                        <div class="account_col_left_form_col">
                            <!-- Name -->
                            <div class='form_col_item'>
                                <input type="text" id="firstname" name="firstname" class="form_col_item_input"
                                    value="<?= $user_name;?>" required>

                                <label for="firstname" class='form_col_item_label'>
                                    Iм'я*
                                </label>
                            </div>

                            <!-- Last name -->
                            <div class='form_col_item'>
                                <input type="text" id="lastname" name="lastname" class="form_col_item_input"
                                    value="<?= $row['last_name'];?>" required>

                                <label for="lastname" class='form_col_item_label'>
                                    Прiзвище*
                                </label>
                            </div>

                            <!-- Middle name -->
                            <div class='form_col_item'>
                                <input type="text" id="midlename" name="midlename" value="<?= $row['midle_name'];?>"
                                    class="form_col_item_input">

                                <label for="midlename" class='form_col_item_label'>
                                    По батьковi
                                </label>
                            </div>
                        </div>

                        <!-- Right sign up column -->
                        <div class="account_col_left_form_col">

                            <!-- Email -->
                            <div class='form_col_item'>
                                <input type="email" id="email" name="emailid" class="form_col_item_input"
                                    value="<?= $row['email'];?>" required>

                                <label for="email" class='form_col_item_label'>
                                    Email*
                                </label>
                                <span id="form_col_item_availability"></span>
                            </div>

                            <!-- Phone number -->
                            <div class='form_col_item'>
                                <input type="text" id="contactno" name="contactno" class="form_col_item_input"
                                    value="<?= $row['contactno'];?>" placeholder="+38(___)_______*" maxlength="12"
                                    required>

                                <label for="contactno" class='form_col_item_label form_col_item_label_active_phone'>
                                    Номер телефону*
                                </label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" name="update" class="form_col_submit">
                                Оновити дані
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Side bar -->
            <?php include('includes/account-sidebar.php');?>
        </div>
    </main>

    <div class='success_password_update'>
        Пароль успішно оновлено!
    </div>
    <!-- Footer -->
    <?php include('includes/footer.php');?>

    <script type="text/javascript" src="assets/js/account.js"></script>
    <script type="text/javascript" src="assets/js/my-account.js"></script>

</body>

</html>
<?php } ?>