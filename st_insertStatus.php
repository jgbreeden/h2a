<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "INSERT INTO h2a.status (issuesid, applicantsid, details) VALUES (?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("iis",  $_POST["statuslist"],  $_POST["apid5"], $_POST["details5"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>