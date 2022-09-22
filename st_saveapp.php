<!DOCTYPE html>
<html>
<title>Application</title>
<head>
<link rel="stylesheet" href="mk.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
require 'cred.php';
echo $_POST["fname"];
$conn = new mysqli($host, $user, $password, "h2a");

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
$yumaonly = htmlspecialchars($_POST["yumaonly"]);
$travelwhy = htmlspecialchars($_POST["travelwhy"]);
$stay8mo = htmlspecialchars($_POST["stay8mo"]);
$overtime = htmlspecialchars($_POST["overtime"]);
$extend = htmlspecialchars($_POST["extend"]);
$extendwhynot = htmlspecialchars($_POST["extendwhynot"]);
$dateofbirth = htmlspecialchars($_POST["dateofbirth"]);
$email = htmlspecialchars($_POST["email"]);
$age = htmlspecialchars($_POST["age"]);
$height = htmlspecialchars($_POST["height"]);
$weight = htmlspecialchars($_POST["weight"]);
$maritalstatus = htmlspecialchars($_POST["maritalstatus"]);
$placeofbirth = htmlspecialchars($_POST["placeofbirth"]);




$stmt = $conn->prepare("INSERT INTO applicants (firstname, lastname, phonecell, phonehome, address, city, state, gender, yumaonly, 
    travelwhy, stay8mo, overtime, extend, extendwhynot, dateofbirth, 
    email, age, height, weight, maritalstatus, placeofbirth) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssssssssssss", $fname, $lname, $phonecell, $phonehome, $address, $city, $state, $gender, $yumaonly, 
    $travelwhy, $stay8mo, $overtime, $extend, $extendwhynot, $dateofbirth,
    $email, $age, $height, $weight, $maritalstatus, $placeofbirth);
$result = $stmt->execute();

$id = $conn->insert_id;
$stmt = $conn->prepare("INSERT INTO experience (skillsid, applicantsid, years, location, details) VALUES(?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $skillsid, $id, $years, $location, $details);
$skills = [];

if ($_POST["acelga"] == "yes") array_push($skills, array("acelga", $_POST["acelgaexp"], $_POST["acelgawhere"]));
if ($_POST["alcachofa"] == "yes") array_push($skills, array("alcachofa", $_POST["alcachofaexp"], $_POST["alcachofawhere"]));
if ($_POST["alfalfa"] == "yes") array_push($skills, array("alfalfa", $_POST["alfalfaexp"], $_POST["alfalfawhere"]));
if ($_POST["ajo"] == "yes") array_push($skills, array("ajo", $_POST["ajoaexp"], $_POST["ajowhere"]));
if ($_POST["apio"] == "yes") array_push($skills, array("apio", $_POST["alfalfaexp"], $_POST["alfalfawhere"]));
if ($_POST["arandano"] == "yes") array_push($skills, array("arandano", $_POST["arandanoexp"], $_POST["arandanowhere"]));
if ($_POST["berenjena"] == "yes") array_push($skills, array("berenjena", $_POST["berenjenaexp"], $_POST["berenjenawhere"]));
if ($_POST["betabel"] == "yes") array_push($skills, array("betabel", $_POST["betabelexp"], $_POST["betabelwhere"]));
if ($_POST["brocoli"] == "yes") array_push($skills, array("brocoli", $_POST["brocoliexp"], $_POST["brocoliwhere"]));
if ($_POST["cacahuate"] == "yes") array_push($skills, array("cacahuate", $_POST["cacahuateexp"], $_POST["cacahuatewhere"]));
if ($_POST["cafe"] == "yes") array_push($skills, array("cafe", $_POST["cafeexp"], $_POST["cafewhere"]));
if ($_POST["calabaza"] == "yes") array_push($skills, array("calabaza", $_POST["calabazaexp"], $_POST["calabazawhere"]));
if ($_POST["cana"] == "yes") array_push($skills, array("cana", $_POST["canaexp"], $_POST["canawhere"]));
if ($_POST["cebolla"] == "yes") array_push($skills, array("cebolla", $_POST["cebollaexp"], $_POST["cebollawhere"]));
if ($_POST["cereza"] == "yes") array_push($skills, array("cereza", $_POST["cerezaexp"], $_POST["cerezawhere"]));
if ($_POST["chabacano"] == "yes") array_push($skills, array("chabacano", $_POST["chabacanoexp"], $_POST["chabacanowhere"]));
if ($_POST["chicharo"] == "yes") array_push($skills, array("chicharo", $_POST["chicharoexp"], $_POST["chicharowhere"]));
if ($_POST["col"] == "yes") array_push($skills, array("col", $_POST["colexp"], $_POST["colwhere"]));
if ($_POST["chile"] == "yes") array_push($skills, array("chile", $_POST["chileexp"], $_POST["chilewhere"]));
if ($_POST["cilantro"] == "yes") array_push($skills, array("cilantro", $_POST["cilantroexp"], $_POST["cilantrowhere"]));
if ($_POST["datil"] == "yes") array_push($skills, array("datil", $_POST["datilexp"], $_POST["datilwhere"], $_POST["ec"]));
if ($_POST["durazno"] == "yes") array_push($skills, array("durazno", $_POST["duraznoexp"], $_POST["duraznowhere"]));
if ($_POST["ejote"] == "yes") array_push($skills, array("ejote", $_POST["ejoteexp"], $_POST["ejotewhere"]));
if ($_POST["elote"] == "yes") array_push($skills, array("elote", $_POST["eloteexp"], $_POST["elotewhere"]));
if ($_POST["espinaca"] == "yes") array_push($skills, array("espinaca", $_POST["espinacaexp"], $_POST["espinacawhere"]));
if ($_POST["esparrago"] == "yes") array_push($skills, array("esparrago", $_POST["esparragoexp"], $_POST["esparragowhere"]));
if ($_POST["fresa"] == "yes") array_push($skills, array("fresa", $_POST["fresaexp"], $_POST["fresawhere"]));
if ($_POST["frijol"] == "yes") array_push($skills, array("frijol", $_POST["frijolexp"], $_POST["alfalfawhere"]));
if ($_POST["habas"] == "yes") array_push($skills, array("habas", $_POST["habasexp"], $_POST["habaswhere"]));
if ($_POST["limon"] == "yes") array_push($skills, array("limon", $_POST["limonexp"], $_POST["limonwhere"]));
if ($_POST["lechuga"] == "yes") array_push($skills, array("lechuga", $_POST["lechugaexp"], $_POST["lechugawhere"], $_POST["lechugatype"]));
if ($_POST["naranja"] == "yes") array_push($skills, array("naranja", $_POST["naranjaexp"], $_POST["naranjawhere"]));
if ($_POST["manzana"] == "yes") array_push($skills, array("manzana", $_POST["manzanaexp"], $_POST["manzanawhere"]));
if ($_POST["melon"] == "yes") array_push($skills, array("melon", $_POST["melonexp"], $_POST["melonwhere"]));
if ($_POST["papa"] == "yes") array_push($skills, array("papa", $_POST["papaexp"], $_POST["papawhere"]));
if ($_POST["pera"] == "yes") array_push($skills, array("pera", $_POST["peraexp"], $_POST["perawhere"]));
if ($_POST["pina"] == "yes") array_push($skills, array("pina", $_POST["pina"], $_POST["pinawhere"]));
if ($_POST["pepino"] == "yes") array_push($skills, array("pepino", $_POST["pepinoexp"], $_POST["pepinowhere"]));
if ($_POST["rabano"] == "yes") array_push($skills, array("rabano", $_POST["rabanoexp"], $_POST["rabanowhere"]));
if ($_POST["repollo"] == "yes") array_push($skills, array("repollo", $_POST["repolloexp"], $_POST["repollowhere"]));
if ($_POST["tomate"] == "yes") array_push($skills, array("tomate", $_POST["tomateexp"], $_POST["tomatewhere"]));
if ($_POST["tomatillo"] == "yes") array_push($skills, array("tomatillo", $_POST["tomatilloexp"], $_POST["tomatillowhere"]));
if ($_POST["sandia"] == "yes") array_push($skills, array("sandia", $_POST["sandiaexp"], $_POST["sandiawhere"]));
if ($_POST["zanahoria"] == "yes") array_push($skills, array("zanahoria", $_POST["zanahoriaexp"], $_POST["zanahoriawhere"]));





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

$stmt = $conn->prepare("INSERT INTO ability (skillsid, applicantsid, years, location, details, percent) VALUES(?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissss", $skillsid, $id, $years, $location, $details, $percent);

$skills = [];

if ($_POST["greenhouses"] == "yes") array_push($skills, array("invernaderos", $_POST["greenhouseswhat"], $_POST["greenhouseswhere"]));
if ($_POST["irrigation"] == "yes") array_push($skills, array("sistema de riego", $_POST["irrigationexp"], $_POST["irrigationwhere"], $_POST["irrigationtype"]));
if ($_POST["farm"] == "yes") array_push($skills, array("alguna granja", $_POST["farmwhat"], $_POST["farmwhere"]));
if ($_POST["drive"] == "yes") array_push($skills, array("conducir", $_POST["drivewhat"], $_POST["drivewhere"]));
if ($_POST["mech"] == "yes") array_push($skills, array("mecanica", $_POST["mechexp"], $_POST["mechwhere"], $_POST["mechgas"], $_POST["mechdoc"], $_POST["mechnodoc"], $_POST["mechtype"]));
if ($_POST["welding"] == "yes") array_push($skills, array("soldadura", $_POST["weldingwhat"], $_POST["weldingwhere"], $_POST["weldingexp"]));
if ($_POST["truck"] == "yes") array_push($skills, array("troque y tráiler", $_POST["truckwhat"], $_POST["truckwhere"]));
if ($_POST["tractor"] == "yes") array_push($skills, array("tractor", $_POST["tractorexp"], $_POST["tractorwhere"], $_POST["tracotrcargo"]));
if ($_POST["fork"] == "yes") array_push($skills, array("montacargas", $_POST["forkexp"], $_POST["forkcargo"]));
if ($_POST["electric"] == "yes") array_push($skills, array("electricidad", $_POST["electricexp"], $_POST["electricwhat"]));

$percent = "";

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
$stmt = $conn->prepare("INSERT INTO documents (issuesid, applicantsid, doctype, whengot, location) VALUES(?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $issuesid, $id, $doc, $when1, $where);
$issues = [];

if ($_POST["passport"] == "yes") array_push($issues, array("passport", $_POST["npass"], $_POST["expdate"], $_POST["wherepass"]));


$count = count($issues);
for($i = 0; $i < $count; $i++){
    $issuesid = getissues($issues[$i]);
    $doc = $issues[$i][1];
    $when1 = $issues[$i][2];
    $where = $issues[$i][3];
    $stmt->execute();
}


$stmt = $conn->prepare("INSERT INTO health (issuesid, applicantsid, medtreatment, reason) VALUES(?, ?, ?, ?)");
$stmt->bind_param("iiss", $issuesid, $id, $med, $reason1);
$issues = [];
$empty = "";

if ($_POST["asma"] == "yes") array_push($issues, array("asthma", $_POST["asthmamed"], $empty));
if ($_POST["diabetic"] == "yes") array_push($issues, array("diabetic", $_POST["diabeticmed"], $empty));
if ($_POST["heart"] == "yes") array_push($issues, array("heart", $_POST["heartmed"], $empty));
if ($_POST["backp"] == "yes") array_push($issues, array("back", $empty, $empty));
if ($_POST["injury"] == "yes") array_push($issues, array("fracture", $_POST["injuryoptions"], $empty));
if ($_POST["pressure"] == "yes") array_push($issues, array("high blood pressure", $empty, $_POST["pressureoptions"]));


$count = count($issues);
for($i = 0; $i < $count; $i++){
    $issuesid = getissues($issues[$i]);
    $med = $issues[$i][1];
    $reason1 = $issues[$i][2];
    $stmt->execute();
}

$stmt = $conn->prepare("INSERT INTO status (issuesid, applicantsid, whengot, whyhow, punishtime, punishreason) VALUES(?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissss", $issuesid, $id, $when2, $why1, $punish1, $reason2);
$issues = [];
$empty = "";

if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"], $empty, $empty));
//if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"]));
//if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"]));
//if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"]));
//if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"]));

$count = count($issues);
for($i = 0; $i < $count; $i++){
    $issuesid = getissues($issues[$i]);
    $when2 = $issues[$i][1];
    $why1 = $issues[$i][2];
    $punish1 = $issues[$i][3];
    $reason2 = $issues[$i][4];
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
function getissues($issues){
    global $conn;
    $sql = "SELECT id FROM issues WHERE issueenglish = '" .$issues[0] ."'";
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