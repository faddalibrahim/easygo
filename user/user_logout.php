<?php 

	// if(isset($_POST['logout'])){
		session_start();
		session_unset();
		session_destroy();
		header('location: user_signin.php');
	// }


 ?>