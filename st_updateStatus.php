<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE status SET issuesid = ?, applicantsid = ?, details = ?"
		. " WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssss", $_POST["statuslist"], $_POST["apid5"],
								$_POST["details5"], $_POST["statusid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>