<?php

require 'cred.php';
$conn = new mysqli($host, $user, $password, $db);
$new_assignstart = date('Y-m-d', strtotime(str_replace('/', '-', $_POST["assignstart"])));
$new_assignend = date('Y-m-d', strtotime(str_replace('/', '-', $_POST["assignend"])));

//save ability record
$sql = "insert into assignments (applicantsid, employersid, startdate, enddate, assignedby) values (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iidds", $_POST["assignappid"], $_POST["assigncomp"], $new_assignstart, $new_assignend, $_POST["assignedby"]);
$result = $stmt->execute();
if ($result == 1) {
    echo "record saved";
} else {
    echo "error";
}

//update applicant record to status=assigned
$sql = "UPDATE applicants SET status = 'assigned' WHERE id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST["assignappid"]);
$result = $stmt->execute();







$conn->close();
?>
