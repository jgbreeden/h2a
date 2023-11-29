<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
    $msg = "";
    $sql = "INSERT INTO assignments (applicantsid, contractsid, startdate, enddate, assignedby) VALUES (?, ?, ?, ?, ?);";
	$stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $appid, $contid, $start, $end, $by);
    $by = 0;
    $contid = $_POST["contractid"];
    $start = $_POST["contractstart"];
    $end = $_POST["contractend"];
    $nums = explode("\n", $_POST["contractppnums"]);
    for ($i = 0; $i < count($nums); $i++) {
        $query = "select id from applicants where ppnumber = '" . $nums[$i] . "'";
        $result = $conn->query($query);
        if ($row = $result->fetch_assoc()) {
            $appid = $row["id"];
            $result = $stmt->execute();
            //update applicant record to status=assigned
            $sql = "UPDATE applicants SET status = 'assigned' WHERE id = ?;";
            $stmt2 = $conn->prepare($sql);
            $stmt2->bind_param("i", $appid);
            $result = $stmt2->execute();
            //make sure there is a ds160 record
            $sql = "SELECT * FROM appds160 WHERE applicantsid = ?";
            $stmt2 = $conn->prepare($sql);
            $stmt2->bind_param("i", $appid);
            $stmt2->execute();
            $results = $stmt->execute();
            if (!($row = $results->fetch_assoc())) {
                $sql = "INSERT INTO appds160 (applicantsid) values(?)";
                $stmt2 = $conn->prepare($sql);
                $stmt2->bind_param("i", $appid);
                $stmt2->execute();
            }
        }
        else {
            $msg .= "not found:" . $nums[$i] . "\n";
        }
    }
    $conn->close();
    ?>