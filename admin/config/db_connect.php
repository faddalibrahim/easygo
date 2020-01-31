<?php 

	/*database variables*/
	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "easygo";

	/*connect to database*/
	$conn = mysqli_connect($host, $username, $password, $db);

	/*check connections*/
	if(!$conn) echo "Connection Error: ".mysqli_connect_error();

 ?>