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
$zipcode = htmlspecialchars($_POST["zipcode"]);
$gender = htmlspecialchars($_POST["gender"]);
$specificarea = htmlspecialchars($_POST["specificarea"]);
$whatarea = htmlspecialchars($_POST["whatarea"]);
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
$whatknowvisa = htmlspecialchars($_POST["whatknowvisa"]);
$howhearcita = htmlspecialchars($_POST["howhearcita"]);
$otherhelp = htmlspecialchars($_POST["otherhelp"]);
$whatknowcita = htmlspecialchars($_POST["whatknowcita"]);

if ($_POST["aware"] == "yes") {
    $whatknowvisa = "Yes, I know it is a work visa" . $whatknowvisa;
} else {
    $whatknowvisa = "No, I didn't know it was a work visa" . $whatknowvisa;
}



$stmt = $conn->prepare("INSERT INTO applicants (firstname, lastname, phonecell, phonehome, address, city, 
    state, zipcode, gender, specificarea, 
    whatarea, stay8mo, overtime, extend, extendwhynot, dateofbirth, 
    email, age, height, weight, maritalstatus, placeofbirth, whatknowvisa, howhearcita, 
    otherhelp, whatknowcita) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssssssssssssssss", $fname, $lname, $phonecell, $phonehome, $address, $city, 
    $state, $zipcode, $gender, $specificarea, 
    $whatarea, $stay8mo, $overtime, $extend, $extendwhynot, $dateofbirth,
    $email, $age, $height, $weight, $maritalstatus, $placeofbirth, $whatknowvisa, $howhearcita, 
    $otherhelp, $whatknowcita);
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
$empty = "";
$skills = [];
$years = 0;

if ($_POST["greenhouses"] == "yes") array_push($skills, array("Invernaderos", $years, $_POST["greenhouseswhat"], $_POST["greenhouseswhere"]));
if ($_POST["irrigation"] == "yes") array_push($skills, array("Sistema de Riego", $_POST["irrigationexp"], $_POST["irrigationwhere"], $_POST["irrigationtype"]));
if ($_POST["farm"] == "yes") array_push($skills, array("Alguna Granja", $years, $_POST["farmwhere"], $_POST["farmwhat"]));
if ($_POST["drive"] == "yes") array_push($skills, array("Conducir", $years, $_POST["drivewhere"], $_POST["drivewhat"]));
if ($_POST["mech"] == "yes") array_push($skills, array("Mecanica", $_POST["mechexp"], $_POST["mechwhere"], $_POST["mechgas"]. "; doc?". $_POST["mechdoc"]. ";" .$_POST["mechnodoc"]. ";" .$_POST["mechtype"]. ";"));
if ($_POST["welding"] == "yes") array_push($skills, array("Soldadura", $years, $_POST["weldingwhere"], $_POST["weldingwhat"], $_POST["weldingexp"]. "%"));
if ($_POST["truck"] == "yes") array_push($skills, array("Troque y Tráiler", $years, $_POST["truckwhere"], $_POST["truckwhat"]));
if ($_POST["tractor"] == "yes") array_push($skills, array("Tractor", $_POST["tractorexp"], $_POST["tractorwhere"], $_POST["tractorcargo"]));
if ($_POST["fork"] == "yes") array_push($skills, array("Montacargas", $_POST["forkexp"], $_POST["forkcargo"]));
if ($_POST["electric"] == "yes") array_push($skills, array("Electricidad", $years, "", $_POST["electricwhat"] . "; " .  $_POST["electricexp"] . "%"));
if ($_POST["english"] == "yes") array_push($skills, array("Ingles", $years, $_POST["whereenglish"], $_POST["speakpercent"]."%sp ".$_POST["writepercent"]."%wr"));
//welding and electricity need percentage
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
$empty = "";

if ($_POST["passport"] == "yes") array_push($issues, array("Passport", $_POST["npass"], $_POST["expdate"], $_POST["wherepass"]));
if ($_POST["touristvisa"] == "yes") array_push($issues, array("Tourist Visa", $_POST["touristvisa"], $empty, $empty));
if ($_POST["mechdoc"] == "yes") array_push($issues, array("Mechanic Certification", $_POST["mechtype"], $empty, $_POST["mechnodoc"]));
if ($_POST["driverlicense"] == "yes") array_push($issues, array("Driver License", $_POST["driverlicensetype"], "", ""));
//if ($_POST["passport"] == "yes") array_push($issues, array("passport", $_POST["npass"], $_POST["expdate"], $_POST["wherepass"]));

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
if ($_POST["injury"] == "yes") array_push($issues, array("fracture", $_POST["injurytype"], $empty));
if ($_POST["pressure"] == "yes") array_push($issues, array("high blood pressure", $empty, $_POST["pressurecause"]));


$count = count($issues);
for($i = 0; $i < $count; $i++){
    $issuesid = getissues($issues[$i]);
    $med = $issues[$i][1];
    $reason1 = $issues[$i][2];
    $stmt->execute();
}

$stmt = $conn->prepare("INSERT INTO status (issuesid, applicantsid, details) VALUES(?, ?, ?)");
$stmt->bind_param("iis", $issuesid, $id, $details2);
$issues = [];
$empty = "";

if ($_POST["deport"] == "yes") array_push($issues, array("Deported", "When: " . $_POST["deportwhen"] . "Why: " . $_POST["deportwhy"]));
if ($_POST["denied"] == "yes") array_push($issues, array("Visa Denied", "Type: " . $_POST["deniedtype"] . "Year: " . $_POST["deniedyear"] . "Reason: " . $_POST["deniedreason"] . "Times Applied: " . $_POST["timesapplied"]));
if ($_POST["detention"] == "yes") array_push($issues, array("Caught Crossing", "#Times" . $_POST["detentiontimes"] . 
        "Last Time: " . $_POST["detentionlast"] . "Punished: " . $_POST["detentionpunish"] . "Length: " . $_POST["detentiontime"] . 
        "Completed: " . $_POST["completed"] . "Pardon: " . $_POST["pardon"]));
if ($_POST["usdetention"] == "yes") array_push($issues, array("Detention US", "yes"));
if ($_POST["police"] == "yes") array_push($issues, array("Police", "Type of Problem: " .  $_POST["policeproblem"]));
if ($_POST["hish2a"] == "yes") array_push($issues, array("Current H2A", "Company: " . $_POST["h2acompany"] . "Month: " . $_POST["h2amonths"]));
if ($_POST["pasth2a"] == "yes") array_push($issues, array("Past H2A", "Count: " . $_POST["h2acount"] . "Companies: " . $_POST["h2apastco"] . "Type: " . $_POST["h2atype"]));
if ($_POST["otherwork"] != "") array_push($issues, array("Other work", "Type: " . $_POST["otherwork"]));
if ($_POST["historywork"] == "yes") array_push($issues, array("Other Farm Work", "Legal: " . $_POST["manner"] . "Tourist Visa: " . $_POST["touristvisa"] . 
        "State: " . $_POST["workstate"]));
if ($_POST["otherworkus"] != "") array_push($issues, array("Other work US", "yes"));
//if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"]));
//if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"]));
//if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"]));

$count = count($issues);
for($i = 0; $i < $count; $i++){
    $issuesid = getissues($issues[$i]);
    $details2 = $issues[$i][1];
    $stmt->execute();
}

if ($result == 1){
    echo " application has been saved";
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