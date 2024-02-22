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
    $query = "SELECT firstname, lastname FROM applicants WHERE id = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$results = $stmt->get_result();
    if ($row = $results->fetch_assoc()) {
        $first = $row["firstname"];
        $last = $row["lastname"];
    } else {
        $first = "Not ";
        $last = "Found";
    }

	$query = "DELETE FROM ability WHERE applicantsid = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
    $query = "DELETE FROM experience WHERE applicantsid = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
    $query = "DELETE FROM health WHERE applicantsid = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
    $query = "DELETE FROM jobhistory WHERE applicantsid = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
    $query = "DELETE FROM school WHERE applicantsid = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
    $query = "DELETE FROM appds160 WHERE applicantsid = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
    $query = "DELETE FROM applicants WHERE id = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
    echo $first . " " . $last . " has been deleted along with any linked skills and history records.";
    $conn->close();
?>
    