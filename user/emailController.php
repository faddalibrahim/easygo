<?php
	$to = "codewiz2019@gmail.com";
	$subject = "Verify your email address";

	$message = '
	<html>
	<head>
	<title>Verification Email</title>
	</head>
	<body>
		<div>
			<p>Thank you for signing up on easy go. Please click on the link below to verify your email</p>
			<a href="http://localhost/easygo/verify.php?token='. $token . '">
				Verify your email address
			</a>
		</div>
	</body>
	</html>
	';

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: faddalibrahim@gmail.com' . "\r\n";
	$headers .= 'Cc: ibrahimfaddal@yahoo.com' . "\r\n";

	mail($to,$subject,$message,$headers);
?>


<?php  ?>