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

	$query = "DELETE FROM assignments WHERE id = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["assid"]);
	$result = $stmt->execute();
    if ($result == 1) {
        echo "Assignment deleted.";
    } else {
        echo "Error deleting assignment: " . $result->error_get_last();
    };
    $conn->close();
?>