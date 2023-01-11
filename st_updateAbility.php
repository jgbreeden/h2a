<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE ability SET skillsid = ?, applicantsid = ?, years = ?, location = ?, percent = ?,"
		. "details = ? WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssssi", $_POST["abilities"], $_POST["apid2"],
								$_POST["years2"], $_POST["location2"], $_POST["percent"],
								$_POST["details2"], $_POST["exid2"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>