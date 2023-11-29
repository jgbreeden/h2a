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
    for ($i = 0; $i < nums.length; $i++) {
        $query = "select id from applicants where ppnumber = ".$nums[$i];
        $result = $conn->query($query)
        if ($row = $result->fetch_assoc()) {
            $appid = row["id"];
            $result = $stmt->execute();
        }
        else {
            $msg.="not found:".num[$i]."\n";
        }
    }
    $conn->close();
    ?>