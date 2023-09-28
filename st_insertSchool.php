<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "INSERT INTO school(schoolname, address, address2, city, state, zip, major,
    datefrom, dateto, applicantsid ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssssssss",  $_POST["school"],  $_POST["major"],
                                         $_POST["saddress"], $_POST["saddress2"], 
                                         $_POST["city"], $_POST["sstate"],  
                                         $_POST["datefrom"] $_POST["dateto"],
                                        $_POST["apid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>