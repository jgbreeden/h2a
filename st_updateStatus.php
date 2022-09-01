<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, "h2a");
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE documents SET issuesid = ?, applicantsid = ?, whengot = ?, whyhow = ?, punishreason = ?, punishtime = ?,"
		. "doctype = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("iissssi", $_POST["statuslist"], $_POST["apid5"],
								$_POST["when3"], $_POST["whyhow2"],
								$_POST["punishreason2"], $_POST["punishtime2"], $_POST["statusid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>