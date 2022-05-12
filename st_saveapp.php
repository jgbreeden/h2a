<!DOCTYPE html>
<html>
<title>Application</title>
<head>
<link rel="stylesheet" href="mk.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
echo $_POST["fname"];
$conn = new mysqli("localhost", "root", "", "h2a");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$fname = htmlspecialchars($_POST["fname"]);
$lname = htmlspecialchars($_POST["lname"]);
$phonecell = htmlspecialchars($_POST["phonecell"]);
$phonehome = htmlspecialchars($_POST["phonehome"]);
$address = htmlspecialchars($_POST["address"]);
$city = htmlspecialchars($_POST["city"]);
$state = htmlspecialchars($_POST["state"]);
$gender = htmlspecialchars($_POST["gender"]);
$dateofbirth = htmlspecialchars($_POST["dateofbirth"]);
$email = htmlspecialchars($_POST["email"]);
$age = htmlspecialchars($_POST["age"]);
$height = htmlspecialchars($_POST["height"]);
$weight = htmlspecialchars($_POST["weight"]);
$martialstatus = htmlspecialchars($_POST["martialstatus"]);
$placeofbirth = htmlspecialchars($_POST["placeofbirth"]);




$stmt = $conn->prepare("INSERT INTO applicants (fname, lname, phonecell, phonehome, address, city, state, gender, dateofbirth, 
    email, age, height, weight, martialstatus, placeofbirth) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssssss", $fname, $lname, $phonecell, $phonehome, $address, $city, $state, $gender, $dateofbirth, $email, $age, $height, $martialstatus, $placeofbirth);
$result = $stmt->execute();

$id = $conn->insert_id;
$stmt = $conn->prepare("INSERT INTO experience (skillsid, applicantsid, years, location, details) VALUES(?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $skillsid, $id, $years, $location, $details);
$skills = [];
if ($_POST["acelga"] == "yes") array_push($skills, array("acelga", $_POST["acelgaexp"], $_POST["acelgawhere"]));
if ($_POST["alcachofa"] == "yes") array_push($skills, array("alcachofa", $_POST["alcachofaexp"], $_POST["alcachofawhere"]));

$count = count($skills);
for($i = 0; $i < $count; $i++){
    $skillsid = getskill($skills[$i]);
    $years = $skills[$i][1];
    $location = $skills[$i][2];
    if (isset($skills[$i][3])){
        $details = $skills[$i][3];
    } else {
        $details = "";
    }
    $stmt->execute();
} 




if ($result == 1){
    echo "application has been saved";
} else {
    echo "problem saving application";
};

function getskill($skill){
    global $conn;
    $sql = "SELECT id FROM skills WHERE skillspanish  = '" .$skill[0] ."'";
    $records = $conn->query($sql);
    if ($row = $records->fetch_assoc()){
        return $row["id"];
    } else {
        return 0;
    }
}

?>
</body>
</html>