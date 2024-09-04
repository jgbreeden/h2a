
<?php
	header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
	header('Pragma: no-cache');
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Cache-Control: post-check=0, pre-check=0',false);
	header('Content-Type: application/json; charset=utf-8');
	require 'cred.php';
	echo '['; //moved from top line to prevent error warnings in log
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	$query = "SELECT * FROM applicants WHERE firstname LIKE '" . $_POST["search"] 
            . "%' OR lastname LIKE '" . $_POST["search"]
            . "%' OR ppnumber LIKE '" . $_POST["search"]
            . "%' OR phonecell LIKE '" . $_POST["search"]
            . "%' OR phonehome LIKE '" . $_POST["search"] . "%'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $output = "";
        while ($row = $result->fetch_assoc()) {
            $output = $output . '{"id": ' . $row["id"]
                            . ', "firstname": "' . $row["firstname"]
                            . '", "lastname": "' . $row["lastname"]
                            . '", "cellphone": "' . $row["phonecell"]
                            . '", "homephone": "' . $row["phonehome"]
                            . '", "ppnumber": "' . $row["ppnumber"]
                            . '", "status": "' . $row["status"]
                            . '"},';
        }
        $output = substr($output, 0, strlen($output) - 1); //remove trailing comma
        echo $output;
    }
    $conn->close();
?>
]