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
setlocale(LC_ALL, "en_US.utf8"); //needed for iconv below
echo $_POST["fname"];
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$fname = clean($_POST["fname"]);
$lname = clean($_POST["lname"]);
$phonecell = clean($_POST["phonecell"]);
$phonehome = clean($_POST["phonehome"]);
$address = clean($_POST["address"]);
$address2 = clean($_POST["address2"]);
$city = clean($_POST["city"]);
$state = clean($_POST["state"]);
$country = clean($_POST["country"]);
$zipcode = clean($_POST["zipcode"]);
$gender = clean($_POST["gender"]);
$specificarea = clean($_POST["specificarea"]);
$whatarea = clean($_POST["whatarea"]);
$stay8mo = clean($_POST["stay8mo"]);
$overtime = clean($_POST["overtime"]);
$extend = clean($_POST["extend"]);
//$extendwhynot = htmlspecialchars($_POST["extendwhynot"]);
$dateofbirth = clean($_POST["dateofbirth"]);
$email = clean($_POST["email"]);
//$age = htmlspecialchars($_POST["age"]);
//$height = htmlspecialchars($_POST["height"]);
//$weight = htmlspecialchars($_POST["weight"]);
$maritalstatus = clean($_POST["maritalstatus"]);
$placeofbirth = clean($_POST["placeofbirth"]);
$whatknowvisa = clean($_POST["whatknowvisa"]);
//$howhearcita = htmlspecialchars($_POST["howhearcita"]);
//$otherhelp = htmlspecialchars($_POST["otherhelp"]);
//$whatknowcita = htmlspecialchars($_POST["whatknowcita"]);
$kilos = clean($_POST["kilos"]);
$datesigned = clean($_POST["datesigned"]);
$signature = clean($_POST["signature"]);
$status = "new";
$ppnumber = clean($_POST["npass"]);
$ppnumber = ($_POST["readypass"] == "yes")? "ready:" . clean($_POST["readypass"]) : $ppnumber;
$ppcity = clean($_POST["ppcity"]);// . ", " .  $_POST["ppstate"] . ", " .  $_POST["ppgotcountry"]; 
$ppcountry = clean($_POST["ppcountry"]);
$ppdateissue = clean($_POST["ppdateissue"]);
$ppduedate = clean($_POST["ppduedate"]);
$pptype = clean($_POST["pptype"]);
//$ppdatedue = "";
$visas = ($_POST["hish2a"] == "yes")? "H-2a:" . clean($_POST["h2acompany"]) . " - " . clean($_POST["h2amonths"]) . "\\n" : "";
$visas .= ($_POST["pasth2a"] == "yes")? "Past count:" . $_POST["h2acount"] 
    . " companies:" . $_POST["h2apastco"] . " type:" . clean($_POST["h2atype"]) . "\\n":  "";
$visas .= ($_POST["visa"] == "yes")? "Has toursit visa." : "";
$deported = ($_POST["deport"] == "yes")? "Deported:" . clean($_POST["deportwhen"]) . " why:" . clean($_POST["deportwhy"]): "";
$deported .= ($_POST["detdeport"] == "yes")? " punished time:" . clean($_POST["howmuchtime"]) . " reason:" . clean($_POST["whatreason"]): "";
$visaissues = ($_POST["migrate"] == "yes")? "In migration(how long):" . clean($_POST["howlong"]): "";
$visarefused =  ($_POST["denied"] == "yes")? "Type:" . clean($_POST["deniedtype"]) . " Year:" . clean($_POST["deniedyear"]) . 
    " Reason:" . clean($_POST["deniedreason"]) : "";// . " Times Applied:" . $_POST["timesapplied"] : "";
$license = clean($_POST["driverlicensetype"]. " state: " . clean($_POST["driverlicensestate"]));

$farmwork = ($_POST["historywork"] == "yes")? "Farm work:" . clean($_POST["manner"]) . " Tourist Visa:" 
    . clean($_POST["touristvisa"]) . " State:" . clean($_POST["workstate"]) . "\\n": "";
/*$farmwork .= ($_POST["otherwork"] != "")? "Other work:" 
    . $_POST["otherwork"] . "\\n": "";
$farmwork .= ($_POST["otherworkus"] != "")? "Non-ag work:" 
    . $_POST["otherworkus"] . "\\n": "";*/
$farmwork .= (trim($_POST["othercompany"]) != "")? "Sponsor co:"
    . clean($_POST["othercompany"]) . " Phone:" . clean($_POST["othercophone"]): "";
$crimes = ""; //($_POST["police"] == "yes")? "Police issue:" . $_POST ["policeproblem"] :"";

$ustravel = "";
$crimes = ($_POST["detention"] == "yes")? "Caught Crossing #Times:" . clean($_POST["detentiontimes"]) . 
        "\\nPunished:" . clean($_POST["detentionpunish"]) . "\\nPardon:" . clean($_POST["pardon"]):"";
        //Last Time:" . $_POST["detentionlast"] . " 
        //"\\nLength:" . $_POST["detentiontime"] . " Completed:" . $_POST["completed"] . 
       // . " Reason:" . $_POST["telltruthdet"] . "\\n":"";
$crimes .= ($_POST["usdetention"] == "yes")? "Detained entering US:yes": "";
if ($_POST["aware"] == "yes") {
    $whatknowvisa = "Knows it's a work visa. " . $whatknowvisa;
} else {
    $whatknowvisa = "Didn't know it's a work visa. " . $whatknowvisa;
}
$notes = ($_POST["otherskill"] == "yes")? clean($_POST["otherskillwhat"]) : "";

$stmt = $conn->prepare("INSERT INTO applicants (firstname, lastname, phonecell, phonehome, address, address2, city, 
    state, country, zipcode, gender, specificarea, 
    whatarea, stay8mo, overtime, extend, dateofbirth, 
    email, maritalstatus, placeofbirth, status, lift25to40, datesigned, signature, ppnumber, pptype,  
    pplocation, ppcountry, ppdateissue, ppdatedue, visas, visaissues, visarefused, license, deported, 
    farmwork, ustravel, crimes, notes) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssssssssssssssssssssssssssssss", $fname, $lname, $phonecell, $phonehome, $address, $address2, $city, 
    $state, $country, $zipcode, $gender, $specificarea, 
    $whatarea, $stay8mo, $overtime, $extend, $dateofbirth,
    $email, $maritalstatus, $placeofbirth, $status, $kilos, $datesigned, $signature, $ppnumber, $pptype, $pplocation, $ppcountry, 
    $ppdateissue, $ppduedate, $visas, $visaissues, $visarefused, $license, $deported, $farmwork, $ustravel, $crimes, $notes);
$result = $stmt->execute();

$id = $conn->insert_id;
$stmt = $conn->prepare("INSERT INTO experience (skillsid, applicantsid, years, location, details) VALUES(?, ?, ?, ?, ?)");
$stmt->bind_param("iisss", $skillsid, $id, $years, $location, $details);
$skills = [];

if ($_POST["acelga"] == "yes") array_push($skills, array("acelga", $_POST["acelgaexp"], clean($_POST["acelgawhere"])));
if ($_POST["aguacate"] == "yes") array_push($skills, array("aguacate", $_POST["aguacateexp"], clean($_POST["aguacatewhere"])));
if ($_POST["alcachofa"] == "yes") array_push($skills, array("alcachofa", $_POST["alcachofaexp"], clean($_POST["alcachofawhere"])));
if ($_POST["alfalfa"] == "yes") array_push($skills, array("alfalfa", $_POST["alfalfaexp"], clean($_POST["alfalfawhere"])));
if ($_POST["ajo"] == "yes") array_push($skills, array("ajo", $_POST["ajoexp"], clean($_POST["ajowhere"])));
if ($_POST["apio"] == "yes") array_push($skills, array("apio", $_POST["alfalfaexp"], clean($_POST["alfalfawhere"])));
if ($_POST["arandano"] == "yes") array_push($skills, array("arandano", $_POST["arandanoexp"], clean($_POST["arandanowhere"])));
if ($_POST["berenjena"] == "yes") array_push($skills, array("berenjena", $_POST["berenjenaexp"], clean($_POST["berenjenawhere"])));
if ($_POST["betabel"] == "yes") array_push($skills, array("betabel", $_POST["betabelexp"], clean($_POST["betabelwhere"])));
if ($_POST["brocoli"] == "yes") array_push($skills, array("brocoli", $_POST["brocoliexp"], clean($_POST["brocoliwhere"])));
if ($_POST["cacahuate"] == "yes") array_push($skills, array("cacahuate", $_POST["cacahuateexp"], clean($_POST["cacahuatewhere"])));
if ($_POST["cafe"] == "yes") array_push($skills, array("cafe", $_POST["cafeexp"], clean($_POST["cafewhere"])));
if ($_POST["calabaza"] == "yes") array_push($skills, array("calabaza", $_POST["calabazaexp"], clean($_POST["calabazawhere"])));
if ($_POST["cana"] == "yes") array_push($skills, array("cana", $_POST["canaexp"], clean($_POST["canawhere"])));
if ($_POST["cebolla"] == "yes") array_push($skills, array("cebolla", $_POST["cebollaexp"], clean($_POST["cebollawhere"])));
if ($_POST["cereza"] == "yes") array_push($skills, array("cereza", $_POST["cerezaexp"], clean($_POST["cerezawhere"])));
if ($_POST["chabacano"] == "yes") array_push($skills, array("chabacano", $_POST["chabacanoexp"], clean($_POST["chabacanowhere"])));
if ($_POST["chicharo"] == "yes") array_push($skills, array("chicharo", $_POST["chicharoexp"], clean($_POST["chicharowhere"])));
if ($_POST["col"] == "yes") array_push($skills, array("col", $_POST["colexp"], clean($_POST["colwhere"])));
if ($_POST["chile"] == "yes") array_push($skills, array("chile", $_POST["chileexp"], clean($_POST["chilewhere"])));
if ($_POST["cilantro"] == "yes") array_push($skills, array("cilantro", $_POST["cilantroexp"], clean($_POST["cilantrowhere"])));
if ($_POST["datil"] == "yes") array_push($skills, array("datil", $_POST["datilexp"], clean($_POST["datilwhere"]), $_POST["ec"]));
if ($_POST["durazno"] == "yes") array_push($skills, array("durazno", $_POST["duraznoexp"], clean($_POST["duraznowhere"])));
if ($_POST["ejote"] == "yes") array_push($skills, array("ejote", $_POST["ejoteexp"], clean($_POST["ejotewhere"])));
if ($_POST["elote"] == "yes") array_push($skills, array("elote", $_POST["eloteexp"], clean($_POST["elotewhere"])));
if ($_POST["espinaca"] == "yes") array_push($skills, array("espinaca", $_POST["espinacaexp"], clean($_POST["espinacawhere"])));
if ($_POST["esparrago"] == "yes") array_push($skills, array("esparrago", $_POST["esparragoexp"], clean($_POST["esparragowhere"])));
if ($_POST["fresa"] == "yes") array_push($skills, array("fresa", $_POST["fresaexp"], clean($_POST["fresawhere"])));
if ($_POST["frijol"] == "yes") array_push($skills, array("frijol", $_POST["frijolexp"], clean($_POST["alfalfawhere"])));
if ($_POST["habas"] == "yes") array_push($skills, array("habas", $_POST["habasexp"], clean($_POST["habaswhere"])));
if ($_POST["limon"] == "yes") array_push($skills, array("limon", $_POST["limonexp"], clean($_POST["limonwhere"])));
if ($_POST["lechuga"] == "yes") array_push($skills, array("lechuga", $_POST["lechugaexp"], clean($_POST["lechugawhere"]), clean($_POST["lechugatype"])));
if ($_POST["naranja"] == "yes") array_push($skills, array("naranja", $_POST["naranjaexp"], clean($_POST["naranjawhere"])));
if ($_POST["manzana"] == "yes") array_push($skills, array("manzana", $_POST["manzanaexp"], clean($_POST["manzanawhere"])));
if ($_POST["melon"] == "yes") array_push($skills, array("melon", $_POST["melonexp"], clean($_POST["melonwhere"])));
if ($_POST["papa"] == "yes") array_push($skills, array("papa", $_POST["papaexp"], clean($_POST["papawhere"])));
if ($_POST["pera"] == "yes") array_push($skills, array("pera", $_POST["peraexp"], clean($_POST["perawhere"])));
if ($_POST["pina"] == "yes") array_push($skills, array("pina", $_POST["pina"], clean($_POST["pinawhere"])));
if ($_POST["pepino"] == "yes") array_push($skills, array("pepino", $_POST["pepinoexp"], clean($_POST["pepinowhere"])));
if ($_POST["rabano"] == "yes") array_push($skills, array("rabano", $_POST["rabanoexp"], clean($_POST["rabanowhere"])));
if ($_POST["repollo"] == "yes") array_push($skills, array("repollo", $_POST["repolloexp"], clean($_POST["repollowhere"])));
if ($_POST["tomate"] == "yes") array_push($skills, array("tomate", $_POST["tomateexp"], clean($_POST["tomatewhere"])));
if ($_POST["tomatillo"] == "yes") array_push($skills, array("tomatillo", $_POST["tomatilloexp"], clean($_POST["tomatillowhere"])));
if ($_POST["sandia"] == "yes") array_push($skills, array("sandia", $_POST["sandiaexp"], clean($_POST["sandiawhere"])));
if ($_POST["zanahoria"] == "yes") array_push($skills, array("zanahoria", $_POST["zanahoriaexp"], clean($_POST["zanahoriawhere"])));





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

if ($_POST["greenhouses"] == "yes") array_push($skills, array("Invernaderos", $years, clean($_POST["greenhouseswhat"]), clean($_POST["greenhouseswhere"])));
if ($_POST["irrigation"] == "yes") array_push($skills, array("Sistema de Riego", $_POST["irrigationexp"], clean($_POST["irrigationwhere"]), clean($_POST["irrigationtype"])));
if ($_POST["farm"] == "yes") array_push($skills, array("Alguna Granja", $years, clean($_POST["farmwhere"]), clean($_POST["farmwhat"])));
if ($_POST["drive"] == "yes") array_push($skills, array("Conducir", $years, clean($_POST["drivewhere"]), clean($_POST["drivewhat"])));
if ($_POST["mech"] == "yes") array_push($skills, array("Mecanica", $_POST["mechexp"], clean($_POST["mechwhere"]), 
        "gas?". ((isset($_POST["mechgas"])) ? $_POST["mechgas"]: "no") . 
        "; diesel?". ((isset($_POST["mechdiesel"])) ? $_POST["mechdiesel"]: "no") . 
        "; " . clean($_POST["mechtype"]) . "; doc?" . clean($_POST["mechdoc"]) . ";" . clean($_POST["mechnodoc"]) . ";"));
        //"; doc?". $_POST["mechdoc"]. ";" .$_POST["mechnodoc"]. 
if ($_POST["welding"] == "yes") array_push($skills, array("Soldadura", $years, clean($_POST["weldingwhere"]), clean($_POST["weldingwhat"]), $_POST["weldingexp"] . "%"));
if ($_POST["truck"] == "yes") array_push($skills, array("Troque y Tráiler", $years, clean($_POST["truckwhere"]), clean($_POST["truckwhat"])));
if ($_POST["tractor"] == "yes") array_push($skills, array("Tractor", $_POST["tractorexp"], clean($_POST["tractorwhere"]), clean($_POST["tractorcargo"])));
if ($_POST["fork"] == "yes") array_push($skills, array("Montacargas", $_POST["forkexp"], clean($_POST["forkcargo"])));
if ($_POST["electric"] == "yes") array_push($skills, array("Electricidad", $years, "", clean($_POST["electricwhat"]) . "; " .  $_POST["electricexp"] . "%"));
if ($_POST["english"] == "yes") array_push($skills, array("Ingles", $years, clean($_POST["whereenglish"]), $_POST["speakpercent"] ."%sp " . $_POST["writepercent"]."%wr"));
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
/*
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
*/

$stmt = $conn->prepare("INSERT INTO health (skillsid, applicantsid, medtreatment, reason) VALUES(?, ?, ?, ?)");
$stmt->bind_param("iiss", $skillsid, $id, $med, $reason1);
$issues = [];
$empty = "";

if ($_POST["asma"] == "yes") array_push($issues, array("Asthma", clean($_POST["asthmamed"]), $empty));
if ($_POST["diabetic"] == "yes") array_push($issues, array("Diabetic", clean($_POST["diabeticmed"]), $empty));
if ($_POST["heart"] == "yes") array_push($issues, array("Heart problem", clean($_POST["heartmed"]), $empty));
if ($_POST["backp"] == "yes") array_push($issues, array("Back", $empty, $empty));
if ($_POST["injury"] == "yes") array_push($issues, array("Fracture", clean($_POST["injurytype"]), $empty));
if ($_POST["pressure"] == "yes") array_push($issues, array("High blood pressure", clean($_POST["pressurecause"]), $empty));
if ($_POST["disability"] == "yes") array_push($issues, array("Disability", clean($_POST["disabilityexp"]), $empty));


$count = count($issues);
for($i = 0; $i < $count; $i++){
    $skillsid = getissues($issues[$i]);
    $med = $issues[$i][1];
    $reason1 = $issues[$i][2];
    $stmt->execute();
}
/*
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
if ($_POST["otherworkus"] != "") array_push($issues, array("Other work US", $_POST["otherworkus"]));
if ($_POST["migrate"] == "yes") array_push($issues, array("In Migration", "How long ago:". $_POST["howmuchtime"]));
//if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"]));
//if ($_POST["deport"] == "yes") array_push($issues, array("deport", $_POST["deportwhen"], $_POST["deportwhy"]));

$count = count($issues);
for($i = 0; $i < $count; $i++){
    $issuesid = getissues($issues[$i]);
    $details2 = $issues[$i][1];
    $stmt->execute();
}
*/
if ($result == 1){
    echo " Su solicitud ha sido enviada. CITA se comunicará con usted cuando revisen su solicitud.";
} else {
    echo " Hubo un problema al guardar su solicitud por favor contacte a CITA al (928)271-2619";
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
    $sql = "SELECT id FROM skills WHERE skillenglish = '" .$issues[0] ."'";
    $records = $conn->query($sql);
    if ($row = $records->fetch_assoc()){
        return $row["id"];
    } else {
        return 0;
    }

}
function clean($val) {
    $new = $val; //accent character cleanup moved to client side
    return htmlspecialchars(trim($new));
}
$conn->close();

?>
</body>
</html>