<?php 
require '../cred.php';
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connect error: " . $conn->connect_error);
}
/*$sql = "SELECT * FROM appds160 WHERE applicantsid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$results = $stmt->get_result();
if ($row = $results->fetch_assoc()) {
    $conn->close();
    die("completed");
}
*/
$sql = "SELECT * FROM applicants WHERE applicants.id =?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET["id"]);
$stmt->execute();
$results = $stmt->get_result();
if ($row = $results->fetch_assoc()) {
  $json =   '{ "id": ' . $row["id"] . ', "firstname": "' . $row["firstname"] . '", "lastname": "'
    . $row["lastname"] . '", "cphone": "' . $row["phonecell"] . '", "employersid": "' . $row["employersid"] . '", "hphone": "'
    . $row["phonehome"] . '", "address": "' . $row["address"] . '", "address2": "' . $row["address2"] . '", "city": "'
    . $row["city"] . '", "state": "' . $row["state"] . '", "zip": "' . $row["zipcode"] . '", "country": "' . $row["country"]
    . '", "maritalstatus": "' . $row["maritalstatus"] . '", "status": "' . $row["status"] 
    . '", "license": "' . $row["license"] . '", "ppnumber": "' . $row["ppnumber"] . '", "placeofbirth": "'
    . $row["placeofbirth"] . '", "dateofbirth": "' . $row["dateofbirth"] . '", "email": "'
    . $row["email"] . '", "gender": "' . $row["gender"] . '", "ppcity": "' . $row["pplocation"] . '", "pptype": "'
    . $row["pptype"] . '", "ppdateissue": "' . $row["ppdateissue"] . '", "ppdatedue": "' . $row["ppdatedue"] . '", "visas": "'
    . $row["visas"] . '", "visaissues": "' . $row["visaissues"] . '", "visarefused": "'
    . $row["visarefused"] . '", "license": "' . $row["license"] . '", "ustravel": "'
    . $row["ustravel"] . '", "deported": "' . $row["deported"] . '", "farmwork": "'
    . $row["farmwork"] . '", "crimes": "' . $row["crimes"] . '", "notes": "' . $row["notes"] . '"}';
  $json = str_replace(chr(13), "", $json);
  echo str_replace(chr(10), "\\n", $json);
} else {
    echo "{}";
}
$conn->close();
?>