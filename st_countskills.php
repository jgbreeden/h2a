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

    $query = "SELECT skillenglish, count(skillsid) as qty from ability
            inner join skills on ability.skillsid = skills.id
            inner join assignments on assignments.applicantsid = ability.applicantsid
            and assignments.contractsid = ?
            group by skillenglish
            union
            SELECT skillenglish, count(skillsid) as qty from experience
            inner join skills on experience.skillsid = skills.id
            inner join assignments on assignments.applicantsid = experience.applicantsid
            and assignments.contractsid = ?
            group by skillenglish";
    
    $stmt = $conn->prepare($query);
	$stmt->bind_param("ii", $_GET["cid"], $_GET["cid"]);
	$stmt->execute();
    $result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$output = "[";
		while ($row = $result->fetch_assoc()) {
            $output.= '{"skillenglish": "' . $row["skillenglish"] . '", "qty": "' . $row["qty"]
                . '"},';
        }
        $output = substr($output, 0, strlen($output) - 1); //remove trailing comma
        echo $output . "]";

    } else {
        echo "[]";
    }
    $conn->close();
    
?>