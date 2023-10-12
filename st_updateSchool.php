<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE school SET schoolname = ?, address = ?, address2 = ?, city = ?, state = ?, zip = ?, major = ?, 
    	datefrom = ?, dateto = ?, applicantsid = ? WHERE id = ?";
		
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssssssssssi",  $_POST["school"], $_POST["saddress"], 
									 $_POST["saddress2"],  $_POST["scity"], 
									 $_POST["sstate"],  ,$_POST["szip"],
									 $_POST["major"],  $_POST["sdatefrom"], 
									 $_POST["sdateto"], $_POST["schapid"] 
									 $_POST["scid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>