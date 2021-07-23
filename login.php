<?php 
// session_start();
	$db = mysqli_connect('localhost','ms','msf12345','ambulancems');

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM drivers WHERE username = '".$username."' AND password = '".$password."'";

	$result = mysqli_query($db,$sql);
	$count = mysqli_num_rows($result);

	if ($count == 1) {
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		echo json_encode("Success");
	}
	else{
		echo json_encode("Error");
	}
	// $user = $_SESSION['username'];
?>