<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, "h2a");
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "INSERT INTO experience (skillsid, applicantsid, years, location, details) VALUES (?, ?, ?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssss", $_POST["skill"], $_POST["apid"], $_POST["years"], $_POST["location"], $_POST["details"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>