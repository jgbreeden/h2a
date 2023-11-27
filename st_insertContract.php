<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "INSERT INTO contracts (employersid, contractnum, contractname, startdate, enddate, requestcount) VALUES (?, ?, ?, ?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssss", $_POST["employersid"], $_POST["contractnum"], $_POST["contractname"], $_POST["contractstart"],
        $_POST["contractend"], $_POST["contractrequested"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>