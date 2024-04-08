<?php 
require '../cred.php';
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
  $json =   '{ "id": ' . $row["id"] . ', "firstname": "' . $row["firstname"] . '", "lastname": "'
    . $row["lastname"] . '", "key": "';
  $cname = "id" . $row["id"];
  $cookie = rand(1000, 9999) . $row["id"] . rand(1000, 9999);
  setcookie($cname, $cookie, time() + (3600 * 30), "/");// 1 hour
  $json .= $cookie . '"}';
  echo $json;
} else {
    echo "error";
}
$conn->close();
?>