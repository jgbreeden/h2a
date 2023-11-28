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
$query = "SELECT * FROM contracts" 
. " where employersid=?" ;
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$comma = "";
$results = $stmt->get_result();
echo "[";
while ($row = $results->fetch_assoc()) {
    echo $comma . '{ "id": "' . $row["id"] . '", "contractnum": "' .$row["contractnum"] . '", "contractname": "' .$row["contractname"] . '"}';
    $comma = ", ";
}
echo "]";
?>