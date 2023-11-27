<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE contracts SET employersid = ?, contractnum = ?, contractname = ?"
			. ", startdate = ?, enddate = ?, requestcount = ? WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$g = "male";
	$stmt->bind_param("ssssssi", $_POST["employersid"], $_POST["contractnum"],
									$_POST["contractname"], $_POST["contractstart"],
									$_POST["contractend"], $_POST["contractrequested"], $_POST["contractid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>