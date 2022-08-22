[
<?php
	require 'cred.php';
	//echo '{"test": "test value1"}, {"test": "test value2"}';
	$conn = new mysqli($host, $user, $password, "h2a");
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	$query = "SELECT * FROM employers";
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		$output = "";
		while ($row = $result->fetch_assoc()) {
			$output = $output . '{"id": ' . $row["id"]
							. ', "company": "' . $row["company"]
							. '", "phone": "' . $row["phone"]
							. '", "address": "' . $row["address"]
							. '", "city": "' . $row["city"]
							. '", "state": "' . $row["state"]
							. '"},';
		}
		$output = substr($output, 0, strlen($output) - 1); //remove trailing comma
		echo $output;
	}
?>
]