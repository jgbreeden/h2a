<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "INSERT INTO health (skillsid, applicantsid, medtreatment, reason) VALUES (?, ?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("iiss",  $_POST["healthlist"],  $_POST["apid4"], $_POST["treatment2"], $_POST["reason2"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>