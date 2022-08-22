<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, "h2a");
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE experience SET skillsid = ?, applicantsid = ?, years = ?, location = ?,"
		. "details = ? WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssssi", $_POST["skill"], $_POST["apid"],
								$_POST["years"], $_POST["location"],
								$_POST["details"], $_POST["exid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>