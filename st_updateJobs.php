<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE jobhistory SET empname = ?, address = ?, address2 = ?, country = ?, city = ?, state = ?, zip = ?, phone = ?, salary = ?, jobtitle = ?,"
    			.  "datefrom = ?, dateto = ?, duties = ?, whatwork = ? WHERE id = ?"; 
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssssssssssssi",  $_POST["jcompany"], $_POST["jaddress"], 
										 $_POST["jaddress2"],$_POST["jcity"], 
										 $_POST["jstate"], $_POST["jzip"],  
										 $_POST["jphone"], $_POST["jsalary"], 
										 $_POST["jobtitle"], $_POST["jdatefrom"], 
										 $_POST["jdateto"],  $_POST["jcountry"], 
										 $_POST["duties"], $_POST["jwhat"], $_POST["jid"]);
	$result = $stmt->execute();
	if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
	$conn->close();
?>