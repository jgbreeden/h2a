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

    $query = "SELECT applicantsid, applicants.firstname, count(applicantsid) as qty FROM h2a.assignments
        inner join applicants on assignments.applicantsid = applicants.id
        where contractsid = ?
        group by applicantsid, firstname";
    
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
    $result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$output = "[";
		while ($row = $result->fetch_assoc()) {
            $output.= '{"id": ' . $row["id"]
                . ', "firstname": "' . $row["firstname"] . ', "qty": "' . $row["qty"]
                . '"},';
        }
        $output = substr($output, 0, strlen($output) - 1); //remove trailing comma
        echo $output . "]";
        
    } else {
        echo "[]";
    }
    $conn->close();
    
?>