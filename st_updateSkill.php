<?php
	$conn = new mysqli("localhost", "root", "", "h2a");
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE experience SET skillsid = ?, applicantsid = ?, years = ?, location = ?,"
		. "details = ? WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$g = "male";
	$stmt->bind_param("sssssi", $_POST["skid"], $_POST["apid"],
								$_POST["year"], $_POST["location"],
								$_POST["details"], $_POST["exid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
		echo "Skill: " . $_POST["skill"];
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>