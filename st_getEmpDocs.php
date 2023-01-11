[
<?php
	require 'cred.php';
	//echo '{"test": "test value1"}, {"test": "test value2"}';
	$conn = new mysqli("localhost", "root", "", $db);
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	$query = "SELECT DISTINCT applicants.id, firstname, lastname FROM "
			. "applicants INNER JOIN experience ON "
			. "applicants.id = experience.applicantsid INNER "
			. "JOIN skills ON experience.skillsid = skills.id "
			. "AND locate(skillenglish, '" . $_GET["status"] . "') > 0";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		$output = "";
		while ($row = $result->fetch_assoc()) {
			$output = $output . '{"id": ' . $row["id"]
							. ', "firstname": "' . $row["firstname"]
							. '", "lastname": "' . $row["lastname"]
							. '"},';
		}
		$output = substr($output, 0, strlen($output) - 1); //remove trailing comma
		echo $output;
	}
	$conn->close();
?>
]