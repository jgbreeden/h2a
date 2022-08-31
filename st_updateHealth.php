<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, "h2a");
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE documents SET issuesid = ?, applicantsid = ?, medtreatment = ?, reason = ?,"
		. "doctype = ? WHERE id=?;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("iissi", $_POST["isid4"], $_POST["apid4"],
								$_POST["treatment2"], $_POST["reason2"],
                                $_POST["healthid2"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>