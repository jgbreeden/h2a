<?php

require 'cred.php';
$conn = new mysqli($host, $user, $password, $db);
$new_assignstart = date('Y-m-d', strtotime(str_replace('/', '-', $_POST["assignstart"])));
$new_assignend = date('Y-m-d', strtotime(str_replace('/', '-', $_POST["assignend"])));
//echo $new_assignstart;
$appid = (int)$_POST["assignappid"];
$contractid = (int)$_POST["assigncontract"];

if(isset($_POST["setassign"])){
    //save ability record
    $sql = "insert into assignments (applicantsid, contractid, startdate, enddate, assignedby) values (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $appid, $contractid, $new_assignstart, $new_assignend, $_POST["assignedby"]);
    $result = $stmt->execute();
    if ($result == 1) {
        echo "record saved";
    } else {
        echo "error";
    }

    //update applicant record to status=assigned
    $sql = "UPDATE applicants SET status = 'assigned' WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appid);
    $result = $stmt->execute();

    $sql = "SELECT * FROM appds160 WHERE applicantsid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appid);
    $stmt->execute();
    $results = $stmt->get_result();
    if (!($row = $results->fetch_assoc())) {
        $sql = "INSERT INTO appds160 (applicantsid) values(?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $appid);
        $stmt->execute();
    }
}
if(isset($_POST["linkcompany"])){
    $sql = "UPDATE applicants SET employersid = ? WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $compid, $appid);
    $result = $stmt->execute();
}
$conn->close();
?>
