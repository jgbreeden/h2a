[
<?php
	require 'cred.php';
	//echo '{"test": "test value1"}, {"test": "test value2"}';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	$query = "SELECT * FROM issues ORDER BY issuetype, issueenglish";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		$output = "";
		while ($row = $result->fetch_assoc()) {
			$output = $output . '{"id": ' . $row["id"]
							. ', "issueenglish": "' . $row["issueenglish"]
							. '", "issuetype": "' . $row["issuetype"] . '"},';
		}
		$output = substr($output, 0, strlen($output) - 1); //remove trailing comma
		echo $output;
	}
	$conn->close();
?>
]