<?php
	header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
	header('Pragma: no-cache');
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Cache-Control: post-check=0, pre-check=0',false);
	header('Content-Type: application/json; charset=utf-8');
    require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
    $date = date("Y-m-d");
    $sql = "UPDATE assignments SET enddate = ? WHERE employersid = ? AND startdate = ?";
    $stmt = $conn->prepare($sql);
	$stmt->bind_param("sis", $date, $_POST["compid"], $_POST["startdate"]);
    $stmt->execute();
	$results = $stmt->get_result();
    if ($result == 1) {
		echo "<h2>Record Saved</h2>";
	} else {
		echo "There was a problem saving the record, please try again.";
	}
    $sql = "select applicantsid FROM assignments WHERE employersid = ? AND startdate = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $_POST["compid"], $_POST["startdate"]);
    $stmt->execute();
    $results = $stmt->get_result();
    $sql = "UPDATE applicants SET status = 'returning' WHERE id = ?";
    while ($row = $results->fetch_assoc()) {
        $stmt->bind_param("i", $row["applicantsid"]);
        $stmt->execute();
    }
	$conn->close();
    ?>