[
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
	if (isset($_POST["stat"])){
		$query = "SELECT * FROM applicants WHERE status ='" . $_POST["stat"];
		if ($_POST["comp"] != 'all') {
			$query .= "' AND employersid = '" . $_POST["comp"];
		}
	} else {
		$query = "SELECT * FROM applicants";
		if ($_POST["comp"] != 'all') {
			$query .= "' WHERE employersid = '" . $_POST["comp"];
		}
	}
	$query .= "' ORDER BY lastname";
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
	$conn->close();
?>
]