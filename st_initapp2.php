<?php 
require 'cred.php';
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connect error: " . $conn->connect_error);
}
$sql = "SELECT * FROM applicants WHERE applicants.id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$results = $stmt->get_result();
if ($row = $results->fetch_assoc()) {
  echo '{ "id": ' . $row["id"] . ', "firstname": "' . $row["firstname"] . '", "lastname": "'
    . $row["lastname"] . '", "cphone": "' . $row["phonecell"] . '", "hphone": "'
    . $row["phonehome"] . '", "address": "' . $row["address"] . '", "city": "'
    . $row["city"] . '", "state": "' . $row["state"] . '", "zip": "' . $row["zipcode"]
    . '", "status": "' . $row["status"] . '", "specificarea": "' . $row["specificarea"] . '", "whatarea": "' 
    . $row["whatarea"] . '", "stay8mo": "' . $row["stay8mo"] . '", "overtime": "' 
    . $row["overtime"] . '", "extend": "' . $row["extend"] . '", "extendwhynot": "'
    . $row["extendwhynot"] . '", "dateofbirth": "' . $row["dateofbirth"] . '", "email": "'
    . $row["email"] . '", "gender": "' . $row["gender"] . '"}';
} else {
    echo "{}";
}
$conn->close();
?>