<?php
	header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
	header('Pragma: no-cache');
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Cache-Control: post-check=0, pre-check=0',false);
	header('Content-Type: application/json; charset=utf-8');
require 'cred.php';
$conn = new mysqli($host, $user, $password, $db);

$date = date("Y/m/d", strtotime($_GET["startdate"]));

$sql = "SELECT applicants.firstname, applicants.lastname, applicants.phonecell"
    . " FROM applicants INNER JOIN assignments ON applicants.id = assignments.applicantsid"
    . " and assignments.employersid=? and startdate=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $_GET["id"], $date);
$stmt->execute();
$result = $stmt->get_result();
$output = "[";
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $output = $output . '{"firstname": "' . $row["firstname"]
                        . '", "lastname": "' . $row["lastname"]
                        . '", "phonecell": "' . $row["phonecell"]
                        . '"},';
    }
    $output = substr($output, 0, strlen($output) - 1); //remove trailing comma
    
}
$output = $output . "]";
echo $output;
$conn->close();
?>