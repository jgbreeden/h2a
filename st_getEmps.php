[
<?php
	require 'cred.php';
	//echo '{"test": "test value1"}, {"test": "test value2"}';
	$conn = new mysqli($host, $user, $password);
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	if (isset($_GET["stat"])){
		$query = "SELECT * FROM applicants WHERE status ='" . $_GET["stat"] . "' ORDER BY lastname";
	} else {
		$query = "SELECT * FROM applicants";
	}
	$result = $conn->query($query);
	if ($result->num_rows > 0) {
		$output = "";
		while ($row = $result->fetch_assoc()) {
			$output = $output . '{"id": ' . $row["id"]
							. ', "firstname": "' . $row["firstname"]
							. '", "lastname": "' . $row["lastname"]
							. '", "cellphone": "' . $row["phonecell"]
							. '"},';
		}
		$output = substr($output, 0, strlen($output) - 1); //remove trailing comma
		echo $output;
	}
?>
]