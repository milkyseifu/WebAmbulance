<?php
// session_start();
// include_once('login.php');
	$db = mysqli_connect('localhost', 'ms','msf12345','ambulancems');
	if (!$db) {
		echo "Database connection failed";
	}

	$u_id = $_POST['id'];
	$currentDateTime = date('Y-m-d H:i:s');
	$driver_user = $_POST['user'];

	$sql = "UPDATE incident_info SET status = 1 WHERE id = ".$u_id."";
	$sql2 = "SELECT * FROM incident_info WHERE id = ".$u_id."";
	// $sql3 = "SELECT * FROM drivers WHERE username = '".$username."' AND password = '".$password."'";

	$query = mysqli_query($db, $sql);

		if ($query) {
			echo json_encode("success");
		}

	$result = mysqli_query($db, $sql2);

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$incident_id = $row['id'];
				$incident_name = $row['incident_name'];
				$address = $row['address'];
				$requested_at = $row['requested_at'];
				$requested_by1 = $row['first_name'];
				$requested_by2 = $row['last_name'];
				$requested_by = $requested_by1.' '.$requested_by2;
		}
	}

	// $result2 = mysqli_query($db, $sql3);

	// if ($result2) {
	// 		while ($row = mysqli_fetch_assoc($result2)) {
	// 			$driver_id = $row['id'];
	// 			$driver_firstname = $row['first_name'];
	// 			$driver_lastname = $row['last_name'];
	// 			$driver_username = $row['username'];
	// 	}
	// }

	$insert = "INSERT INTO report (incident_id, incident_name, address, requested_at, requested_by, received_by, received_at) VALUES ('".$incident_id."','".$incident_name."','".$address."','".$requested_at."','".$requested_by."','".$driver_user."', '".$currentDateTime."')";

	$query = mysqli_query($db, $insert);
	if (!$query) {
		echo json_encode("Error");
	}else{
		echo json_encode("Success");
	}
?>