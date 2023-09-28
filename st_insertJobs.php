<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "INSERT INTO jobhistory (empname, address, address2, city, state, zip, phone, salary, jobtitle,
    datefrom, dateto, applicantsid, duties, supervisor ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssssssssssss",  $_POST["comapny"],  $_POST["salary"], $_POST["address"], $_POST["address2"], 
                        $_POST["city"], $_POST["state"], $_POST["supervisor"], $_POST["jobtitle"], $_POST["datefrom"] $_POST["dateto"]
                        $_POST["phone"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>