<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE employers SET company = ?, phone = ?, address = ?"
			. ", city = ?, state = ?, zip = ? WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$g = "male";
	$stmt->bind_param("ssssssi", $_POST["compfname"], $_POST["officphone"],
									$_POST["compaddress"], $_POST["compcity"],
									$_POST["compstate"], $_POST["compzip"], $_POST["compid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
		echo "First name: " . $_POST["compfname"];
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>