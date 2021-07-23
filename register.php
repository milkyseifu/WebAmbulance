<?php
	
	$db = mysqli_connect('localhost', 'ms','msf12345','userdata');
	if (!$db) {
		echo "Database connection failed";
	}
	$f_name = $_POST['fname'];
	$l_name = $_POST['lname'];
	$l_name = $_POST['pnum'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM patients WHERE username = '".$username."' AND password = '".$password."'";

	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);

	if ($count == 1) {
		echo json_encode("Error");
	}else{
		$insert = "INSERT INTO patients (first_name,last_name,phone_number, username, password) VALUES ('".$f_name."','".$l_name."','".$p_num."','".$username."','".$password."')";

		$query = mysqli_query($db, $insert);
		if ($query) {
			echo json_encode("success");
		}
	}
?>