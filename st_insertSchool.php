<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "INSERT INTO school(schoolname, address, address2, country, city, state, datefrom, zip,
    dateto, grade, applicantsid ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssssssss",  $_POST["school"],  $_POST["saddress"], 
									 $_POST["saddress2"], $_POST["scountry"], $_POST["scity"], 
									 $_POST["sstate"],   $_POST["sdatefrom"], 
									 $_POST["szip"], $_POST["sdateto"],
								     $_POST["grade"],  $_POST["schapid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>