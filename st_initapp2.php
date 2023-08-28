<?php 
require 'cred.php';
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connect error: " . $conn->connect_error);
}
$sql = "SELECT * FROM applicants, WHERE applicants.id =?";
$result = $conn->prepare($query);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$results = $stmt->get_result();

?>