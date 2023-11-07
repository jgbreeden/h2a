[
<?php
	header('Pragma: public');
	header('Cache-Control: maxage=1');
	header('Expires: ' . date('D, d M Y H:i:s'));
	header('Content-Type: application/json; charset=utf-8');
	require 'cred.php';
	//echo '{"test": "test value1"}, {"test": "test value2"}';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	$query = "SELECT DISTINCT applicants.id, firstname, lastname FROM applicants "
			. "INNER JOIN experience ON applicants.id = experience.applicantsid "
			. "INNER JOIN skills ON experience.skillsid = skills.id "
			. "AND locate(skills.skillenglish, '" . $_POST["skills"] . "') > 0 "
			. "WHERE applicants.status = '". $_POST["status"] . "' "
			. "union SELECT DISTINCT applicants.id, firstname, lastname FROM applicants "
			. "INNER JOIN ability ON applicants.id = ability.applicantsid "
			. "INNER JOIN skills as sk ON ability.skillsid = sk.id "
			. "AND locate(sk.skillenglish, '" . $_POST["skills"] . "') > 0 "
			. "WHERE applicants.status ='". $_POST["status"] . "' "
			. "order by lastname, firstname";
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