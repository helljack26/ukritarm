<?php
require_once "includes/config.php";
require_once "includes/config_google.php";

if (isset($_GET['code'])) {
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['id_token_token'] = $token;
    
    // $gClient->revokeToken($token['access_token']);
    // redirect back to the example
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    return;
}
if (
    !empty($_SESSION['id_token_token'])
    && isset($_SESSION['id_token_token']['id_token'])
  ) {
      $gClient->setAccessToken($_SESSION['id_token_token']);
  }

if($gClient->getAccessToken()){
    // get data from google
    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo->get();

    // User Info for sign up
    $googleFirstName = $userData['givenName']; 
    $googleLastName = $userData['familyName']; 
    $googleEmail = $userData['email']; 

    $getEmail=mysqli_query($con,"SELECT * 
                                    FROM users 
                                    WHERE email='$googleEmail'
                                    ");
    $num_row_user = mysqli_num_rows($getEmail);

    $row_user = mysqli_fetch_array($getEmail);

    if($num_row_user > 0){
        // If exist nothing
        $_SESSION['login']=$googleEmail;
        $_SESSION['username']=$googleFirstName;
        $_SESSION['id'] = $row_user['id'];
        
        header('Location: index.php');
    }else{
        // Insert new user
        $insert_user=mysqli_query($con,"INSERT 
                                        INTO `users`(`name`,`last_name`, `email`) 
                                        VALUES ('$googleFirstName','$googleLastName','$googleEmail')
                                        ");
        if($insert_user) {
            $_SESSION['login']=$googleEmail;
            $_SESSION['username']=$googleFirstName;

            $get_user_id = mysqli_query($con,"SELECT id FROM users WHERE email='$googleEmail'");
            $row_user_id = mysqli_fetch_array($get_user_id);
            $_SESSION['id'] = $row_user_id['id'];

            header('Location: index.php');
        } else {
            echo "<script>alert('Не зареєструвались, щось пішло не так...');</script>";
        }
        exit;
    }
}else{
    header('Location: login.php');
    exit;
}
?>