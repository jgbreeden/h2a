<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE jobhistory SET empname = ?, address = ?, address2 = ?, city = ?, state = ?, zip = ?, phone = ?, salary = ?, jobtitle = ?,
                    datefrom = ?, dateto = ?, duties = ?, supervisor = ? WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssssssssssssi", $_POST["company"], $_POST["adddress"], $_POST["address2"],
								$_POST["city"], $_POST["state"], $_POST["zip"], $_POST["phone"], 
                                $_POST["salary"], $_POST["jobtitle"], $_POST["datefrom"], $_POST["dateto"], 
                                 $_POST["supervisor"], $_POST["jid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>