<?php
	require 'cred.php';
	//echo '{"test": "test value1"}, {"test": "test value2"}';
	$conn = new mysqli($host, $user, $password);
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	$query = "SELECT applicants.*, experience.id AS exid, experience.years, experience.location, "
			. "experience.skillsid, experience.details, skills.skillenglish FROM applicants  LEFT "
			. "OUTER JOIN experience ON applicants.id = experience.applicantsid LEFT OUTER JOIN "
			. "skills ON experience.skillsid = skills.id WHERE applicants.id =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_GET["id"]);
	$stmt->execute();
	$results = $stmt->get_result();
	//echo $results->num_rows;
	//echo mysqli_error($conn);
	$row = $results->fetch_assoc();
	//write person fields, then "skills": [
	echo '{ "id": ' . $row["id"] . ', "firstname": "' . $row["firstname"] . '", "lastname": "'
		. $row["lastname"] . '", "cphone": "' . $row["phonecell"] . '", "hphone": "'
		. $row["phonehome"] . '", "address": "' . $row["address"] . '", "city": "'
		. $row["city"] . '", "state": "' . $row["state"] . '", "zip": "' . '0'
		. '", "status": "' . $row["status"] . '", "skills": [ ';
	if (! is_null( $row["skillenglish"])) {
		echo '{ "skillenglish": "' . $row["skillenglish"] . '", "years": ' . $row["years"] 
			. ', "location": "' . $row["location"] . '", "exid": ' . $row["exid"] 
			. ', "skillsid": ' . $row["skillsid"] . ', "details": "' . $row["details"] . '"}';
	}
	while ($row = $results->fetch_assoc()) {
		echo ', { "skillenglish": "' . $row["skillenglish"] . '", "years": ' . $row["years"]
				. ', "location": "' . $row["location"] . '", "exid": ' . $row["exid"]
				. ', "skillsid": ' . $row["skillsid"] . ', "details": "' . $row["details"] . '"}';
	}
	echo '], "ability": [';
	$query = "SELECT ability.id as abid, ability.years, ability.location, ability.percent, "
			. "ability.details, skills.skillenglish as abeng FROM ability INNER JOIN skills ON "
			. "ability.skillsid = skills.id WHERE ability.applicantsid =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_GET["id"]);
	$stmt->execute();
	$comma = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {
		echo $comma . '{ "abid": "' . $row["abid"] . '", "years": ' . $row["years"] . ', "location": "' 
			. $row["location"] . '", "percent": ' . $row["percent"] . ', "abeng": "' . $row["abeng"]
			. '", "details": "' . $row["details"] . '"}';
		$comma = ", ";
	}
	echo ']}';
	//loop through rows, add skill fields
	//end record
?>