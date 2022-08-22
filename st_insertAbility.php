<?php
	require 'cred.php';
	$conn = new mysqli("localhost", "root", "", "h2a");
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "INSERT INTO ability (skillsid, applicantsid, years, location, percent, details) VALUES (?, ?, ?, ?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssss", $_POST["skill2"], $_POST["apid2"], $_POST["years2"], $_POST["location2"], $_POST["percent"], $_POST["details2"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>