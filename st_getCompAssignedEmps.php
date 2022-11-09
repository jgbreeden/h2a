<?php

require 'cred.php';
$conn = new mysqli($host, $user, $password, $db);


$sql = "SELECT applicants.firstname, applicants.lastname, applicants.phonecell"
    . " FROM applicants INNER JOIN assignments ON applicants.id = assignments.applicantsid"
    . " and employersid=? and startdate=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("id", $_GET["id"], $_GET["startdate"]);
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