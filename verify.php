<?php 


	if(isset($_GET['token'])){
		include 'admin/config/db_connect.php';
		// include 'emailController.php';
		
		$token = $_GET['token'];
		$sql = "SELECT * FROM user WHERE token='$token'";
		$result = mysqli_query($conn,$sql);

		if(mysqli_fetch_row($result) > 0){
			$user = mysqli_fetch_assoc($result);
			$update_query = "UPDATE user SET verified='1' WHERE token='$token'";

			if(mysqli_query($conn,$update_query)){
				//log user in
				$_SESSION['user'] = $user['fullname'];
				$_SESSION['verified'] = $user['verified'];
				header('location: user/user_dashboard.php#bookings');
			}
		}
	}else{
		header('location: user_signin.php');
	}

?>


