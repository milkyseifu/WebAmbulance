<?php
	
	$db = mysqli_connect('localhost', 'ms','msf12345','ambulancems');
	if (!$db) {
		echo "Database connection failed";
	}

	$sql = "SELECT * FROM incident_info WHERE status = 0";

	$incident_info = array();

	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);

	if ($result) {
		while ($row = mysqli_fetch_assoc($result)) {
			$incident_info[] = $row;
		}
		echo json_encode($incident_info);
		
	}else{
		echo "error";
	}
?>