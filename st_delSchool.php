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
$query = "DELETE FROM school WHERE id=" . $_GET["sid"];
$result = $conn->query($query);
echo "Deleted:" . $result;
?>