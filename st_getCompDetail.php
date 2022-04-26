<?php
	//echo '{"test": "test value1"}, {"test": "test value2"}';
	$conn = new mysqli("localhost", "root", "", "h2a");
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	$query = "SELECT * FROM employers WHERE id =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_GET["id"]);
	$stmt->execute();
	$results = $stmt->get_result();
	//echo $results->num_rows;
	//echo mysqli_error($conn);
	$row = $results->fetch_assoc();
	//write person fields, then "skills": [
	echo '{ "id": ' . $row["id"] . ', "company": "' . $row["company"]
		. '", "phone": "' . $row["phone"] . '", "address": "'
		. $row["address"] . '", "citty": "' . $row["citty"]
		. '", "state": "' . $row["state"] . '"}';
	//loop through rows, add skill fields
	//end record
?>