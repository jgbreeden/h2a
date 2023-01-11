<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE documents SET issuesid = ?, applicantsid = ?, whengot = ?, location = ?,"
		. "doctype = ? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssssi", $_POST["doclist"], $_POST["apid3"],
								$_POST["when2"], $_POST["locationdoc2"],
								$_POST["doctype2"], $_POST["docid2"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>