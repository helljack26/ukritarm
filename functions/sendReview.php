
<?php 
include('../includes/config.php');

if(isset($_REQUEST)) {
 	$req = $_REQUEST['submit'];
	$pid=$req['productCode'];
	$value=$req['userStars'];
	$name=$req['userName'];
	$email=$req['userEmail'];
	$review=$req['userMessage'];

	mysqli_query($con,"INSERT 
						INTO productreviews(
							productId,
							value,
							name,
							summary,
							review
						) VALUES (
							'$pid',
							'$value',
							'$name',
							'$email',
							'$review'
						)");
}
?>
