<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE applicants SET firstname = ?, lastname = ?, phonecell = ?, phonehome = ?,"
		. "address = ?, city = ?, state = ?, zipcode = ?, gender = ?, status = ?, specificarea = ?, whatarea = ?, stay8mo = ?, overtime = ?,"
		. "extend = ?, extendwhynot = ?, dateofbirth = ?, email = ?, age = ?, height = ?, weight = ?, maritalstatus = ?,"
		. "placeofbirth = ?, whatknowvisa = ?, howhearcita = ?, otherhelp = ?, whatknowcita = ? WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssssssssssssssssssssssssssi", $_POST["fname"], $_POST["lname"], $_POST["cphone"],
									$_POST["hphone"], $_POST["address"], $_POST["city"],
									$_POST["state"], $_POST["zip"], $_POST["gender"], $_POST["status"], $_POST["specificarea"], $_POST["whatarea"], 
									$_POST["stay8mo"], $_POST["overtime"], $_POST["extend"],
									$_POST["extendwhynot"], $_POST["dateofbirth"],  $_POST["email"], $_POST["age"],
									$_POST["height"], $_POST["weight"], $_POST["maritalstatus"], $_POST["placeofbirth"],
									$_POST["whatknowvisa"], $_POST["howhearcita"], $_POST["otherhelp"], $_POST["whatknowcita"],
									$_POST["id"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
		echo "First name: " . $_POST["fname"];
	} else {
		echo "There was a problem saving the record, please try again.";
	}
?>