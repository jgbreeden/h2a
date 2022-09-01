<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, "h2a");
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "INSERT INTO documents (issuesid, applicantsid, whengot, whyhow, punishreason, punishtime) VALUES (?, ?, ?, ?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssss",  $_POST["isid5"],  $_POST["apid5"], $_POST["when3"], 
								$_POST["whyhow2"], $_POST["punishreason2"], $_POST["punishtime2"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>