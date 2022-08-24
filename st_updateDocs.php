<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, "h2a");
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE documents SET issuesid = ?, applicantsid = ?, when = ?, location = ?,"
		. "doctype = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssss", $_POST["isid"], $_POST["apid3"],
								$_POST["when2"], $_POST["locationdoc2"],
								$_POST["doctype2"];
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>