<?php
	header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
	header('Pragma: no-cache');
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Cache-Control: post-check=0, pre-check=0',false);
	header('Content-Type: application/json; charset=utf-8');
	require 'cred.php';
	//echo '{"test": "test value1"}, {"test": "test value2"}';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	$query = "SELECT * FROM contacts WHERE id =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_GET["id"]);
	$stmt->execute();
	$results = $stmt->get_result();
	//echo $results->num_rows;
	//echo mysqli_error($conn);
	$row = $results->fetch_assoc();
	//write person fields, then "skills": [
	echo '{ "id": ' . $row["id"] . ', "employersid": "' . $row["employersid"]
		. '", "contractnum": "' . $row["contractnum"] . '", "contractname": "'
		. $row["contractname"] . '", "startdate": "' . $row["startdate"]
		. '", "enddate": "' . $row["enddate"] . '", "requestcount": "' . $row["requestcount"]
		. '", "applicants": [ ';

	$query = "SELECT id, firstname, lastname FROM applicants" 
		. " inner join contracts on contractid=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_GET["id"]);
	$stmt->execute();
	$comma = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {
		echo $comma . '{ "id": "' . $row["id"] . '", "firstname": "' . $row["firstname"]  . '", "lastname": "' 
		.$row["lastname"] . '"}';
		$comma = ", ";
	}