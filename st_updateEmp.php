<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, "h2a");
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE applicants SET firstname = ?, lastname = ?, phonecell = ?, phonehome = ?,"
		. "address = ?, city = ?, state = ?, gender = ? WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$g = "male";
	$stmt->bind_param("ssssssssi", $_POST["fname"], $_POST["lname"], $_POST["cphone"],
									$_POST["hphone"], $_POST["address"], $_POST["city"],
									$_POST["state"], $g, $_POST["id"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
		echo "First name: " . $_POST["fname"];
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>