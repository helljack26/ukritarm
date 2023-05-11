<? require_once("../includes/config.php");

if(!empty($_POST["email"])) {
	$email= $_POST["email"];
	$isMyCart= $_POST["isMyCart"];

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo("Невiрний формат");
		exit;
	};

	if ($isMyCart == 'true') {
		exit;
	}

	$result =mysqli_query($con,"SELECT email 
								FROM users 
								WHERE email='$email'
								");

	$count=mysqli_num_rows($result);

	if($count>0) {
		echo 'Email вже існує';
	} else{
		echo 'Email доступний для реєстрації';
	}
}
?>