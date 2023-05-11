<? require_once("../includes/config.php");

if(!empty($_POST["email"])) {
	$email= $_POST["email"];
	$result =mysqli_query($con,"SELECT email FROM  users WHERE  email='$email'");
	$count=mysqli_num_rows($result);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo("Невiрний формат");
		exit;
	}

	if($count>0) {
		echo "Email вже існує";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	} else{
		echo "Email доступний для реєстрації";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}
?>