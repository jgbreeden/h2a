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
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$fname = htmlspecialchars($_POST["fname"]);
$lname = htmlspecialchars($_POST["lname"]);
$phonecell = htmlspecialchars($_POST["phonecell"]);
$phonehome = htmlspecialchars($_POST["phonehome"]);
$address = htmlspecialchars($_POST["address"]);
$address2 = htmlspecialchars($_POST["address2"]);
$city = htmlspecialchars($_POST["city"]);
$state = htmlspecialchars($_POST["state"]);
$zipcode = htmlspecialchars($_POST["zipcode"]);
$gender = htmlspecialchars($_POST["gender"]);
//$specificarea = htmlspecialchars($_POST["specificarea"]);
//$whatarea = htmlspecialchars($_POST["whatarea"]);
//$stay8mo = htmlspecialchars($_POST["stay8mo"]);
//$overtime = htmlspecialchars($_POST["overtime"]);
//$extend = htmlspecialchars($_POST["extend"]);
//$extendwhynot = htmlspecialchars($_POST["extendwhynot"]);
$dateofbirth = htmlspecialchars($_POST["dateofbirth"]);
$email = htmlspecialchars($_POST["email"]);
//$age = htmlspecialchars($_POST["age"]);
//$height = htmlspecialchars($_POST["height"]);
//$weight = htmlspecialchars($_POST["weight"]);
$maritalstatus = htmlspecialchars($_POST["maritalstatus"]);
//$placeofbirth = htmlspecialchars($_POST["placeofbirth"]);
//$whatknowvisa = htmlspecialchars($_POST["whatknowvisa"]);
//$howhearcita = htmlspecialchars($_POST["howhearcita"]);
//$otherhelp = htmlspecialchars($_POST["otherhelp"]);
//$whatknowcita = htmlspecialchars($_POST["whatknowcita"]);
//$kilos = htmlspecialchars($_POST["kilos"]);
//$datesigned = htmlspecialchars($_POST["datesigned"]);
//$signature = htmlspecialchars($_POST["signature"]);
$crimes =  ($_POST["arrested"] == "yes")? "arrested:" . $_POST["arrestedexp"] ."\\n" :  "";
$crimes .= ($_POST["substances"] == "yes")? "substances:" . $_POST["substancesexp"]."\\n" : "";
$crimes .= ($_POST["postitution"] == "yes")? "postitution:" . $_POST["postitutionexp"]."\\n" : "";
$crimes .= ($_POST["laundering"] == "yes")? "laundering:" . $_POST["launderingexp"]."\\n" : "";
$crimes .= ($_POST["trafficking"] == "yes")? "trafficking:" . $_POST["traffickingexp"]."\\n" : "";
$crimes .= ($_POST["aidtrafficking"] == "yes")? "aidtrafficking:" . $_POST["aidtraffickingexp"]."\\n" : "";
$crimes .= ($_POST["famtrafficking"] == "yes")? "famtrafficking:" . $_POST["famtraffickingexp"]."\\n" : "";
$crimes .= ($_POST["severetrafficking"] == "yes")? "severetrafficking:" . $_POST["severetraffickingexp"]."\\n" : "";
$crimes .= ($_POST["famsubstances"] == "yes")? "famsubstances:" . $_POST["famsubstancesexp"]."\\n" : "";
$crimes .= ($_POST["espionage"] == "yes")? "espionage:" . $_POST["espionageexp"]."\\n" : "";
$crimes .= ($_POST["terrorist"] == "yes")? "terrorist:" . $_POST["terroristexp"]."\\n" : "";
$crimes .= ($_POST["financial"] == "yes")? "financial:" . $_POST["financialexp"]."\\n" : "";
$crimes .= ($_POST["genocide"] == "yes")? "genocide:" . $_POST["genocideexp"]."\\n" : "";
$crimes .= ($_POST["torture"] == "yes")? "torture:" . $_POST["tortureexp"]."\\n" : "";
$crimes .= ($_POST["killings"] == "yes")? "killings:" . $_POST["killingsexp"]."\\n" : "";
$crimes .= ($_POST["childsoldiers"] == "yes")? "childsoldiers:" . $_POST["childsoldiersexp"]."\\n" : "";
$crimes .= ($_POST["violatereligions"] == "yes")? "violatereligions:" . $_POST["violatereligionsexp"]."\\n" : "";
$crimes .= ($_POST["personalgain"] == "yes")? "personalgain:" . $_POST["personalgainexp"]."\\n" : "";
$crimes .= ($_POST["fampersonalgain"] == "yes")? "fampersonalgain:" . $_POST["fampersonalgainexp"]."\\n" : "";
$crimes .= ($_POST["confidencial"] == "yes")? "confidencial:" . $_POST["confidencialexp"]."\\n" : "";
$crimes .= ($_POST["famconfidencial"] == "yes")? "famconfidencial:" . $_POST["famconfidencialexp"]."\\n" : "";
$crimes .= ($_POST["popcontrol"] == "yes")? "popcontrol:" . $_POST["popcontrolexp"]."\\n" : "";
$crimes .= ($_POST["humanorgans"] == "yes")? "humanorgans:" . $_POST["humanorgansexp"]."\\n" : "";
$crimes .= ($_POST["felony"] == "yes")? "felony:" . $_POST["felonyexp"]."\\n":"";
$crimes.= $_POST["ocrimes"];  

$status = "ready";
$ppnumber = $_POST["ppnumber"];
$ppcity = $_POST["ppcity"];
$ppstate = $_POST["ppstate"];
$ppdateissue = $_POST["ppissuedate"];
$visas = ($_POST["visas"] == "yes")?  $_POST["visaslist"]. "\\n" . $_POST["ovisas"] : $_POST["ovisas"];
$visaissues =  ($_POST["visaslost"] == "yes")? "LoSt:" . $_POST["visaslostyear"] . "\\n" . $_POST["visaslostexp"] : "";
$visaissues .=  ($_POST["visascancelled"] == "yes")? "CanRev:" . $_POST["visascancelledexp"] . "\\n"  : "";
$visaissues .=  ($_POST["petition"] == "yes")? "petition:" . $_POST["petitionexp"] . "\\n" . $_POST["ovisaissues"]  : $_POST["ovisaissues"];
$visarefused = ($_POST["visarefused"] == "yes")? $_POST["visarefusedexp"] . "\\n:" 
    . $_POST["ovisarefused"] :  $_POST["ovisarefused"];
$license = ($_POST["license"] == "yes")? $_POST["licensenum"]. " - " . $_POST["licensestate"] . "\\n" . $_POST["olicense"] : $_POST["olicense"];
$ustravel = ($_POST["usvisit"] == "yes")? $_POST["usvisitexp"] . "\\n" . $_POST["oustravel"] : $_POST["oustravel"];
$deported = ($_POST["hearing"] == "yes")?  "hearing:" . $_POST["hearingexp"]. "\\n" : "";
$deported .= ($_POST["visafraud"] == "yes")?  "visafraud:" . $_POST["visafraudexp"]. "\\n" : "";
$deported .= ($_POST["failedhearing"] == "yes")?  "failedhearing:" . $_POST["failedhearingexp"]. "\\n" : "";
$deported .= ($_POST["violatedtime"] == "yes")?  "violatedtime:" . $_POST["violatedtimeexp"]. "\\n" : "";
$deported .= ($_POST["INA274C"] == "yes")?  "INA274C:" . $_POST["INA274Cexp"]. "\\n" : "";
$deported .= ($_POST["removed5"] == "yes")?  "removed5:" . $_POST["removed5exp"]. "\\n" : "";
$deported .= ($_POST["removed20"] == "yes")?  "removed20:" . $_POST["removed20exp"]. "\\n" : "";
$deported .= ($_POST["removed10"] == "yes")?  "removed10:" . $_POST["removed10exp"]. "\\n" : "";
$deported .= ($_POST["present180"] == "yes")?  "present180:" . $_POST["present180exp"]. "\\n" : "";
$deported .= ($_POST["present10"] == "yes")?  "present10:" . $_POST["present10exp"]. "\\n" . $_POST["odeported"] : $_POST["odeported"];
$id = $_POST["id"];

//change to an update

$sql = "UPDATE applicants SET firstname = ?, lastname = ?, phonecell = ?, phonehome = ?,"
. "address = ?, address2 = ?, city = ?, state = ?, zipcode = ?, gender = ?, status = ?, ppnumber = ?, ppcity = ?, ppstate = ?,"
. "ppdateissue = ?, visas = ?, visaissues = ?, visarefused = ?, license = ? , crimes = ?, deported = ? WHERE id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssssssssssi", $fname, $lname, $phonecell, $phonehome, $address, $address2, $city, $state, $zipcode, 
                            $gender, $status, $ppnumber, $ppcity, $ppstate, $ppdateissue, $visas, $visaissues,
                            $visarefused, $license, $crimes, $deported, $id);

$result = $stmt->execute();
if ($result == 1) {
    $message = "Registro guardado ";
} else {
    $message = "Hubo un problema al guardar la información del solicitante: " . result.error;
    $conn->close();
    die($message);
}
//insert into app ds160
$marriage = htmlspecialchars($_POST["datedivorce"]) . ": " . htmlspecialchars($_POST["reasondivorce"]);
$nationality = htmlspecialchars($_POST["nationality"]);
$othernations = htmlspecialchars($_POST["othernations"]);
$otherresident = htmlspecialchars($_POST["othernations"]);
$nationid = htmlspecialchars($_POST["nationid"]);
$ssn = htmlspecialchars($_POST["ssn"]);
$othercontact = htmlspecialchars($_POST["otherphones"]) . "\\n" . htmlspecialchars($_POST["otheremail"]);
$socialmedia = htmlspecialchars($_POST["socialmedia"]);
$pploststolen = ""; // htmlspecialchars($_POST["pploststolen"]);
$fatherinfo = htmlspecialchars($_POST["fatherFname"]) . " " . htmlspecialchars($_POST["fatherLname"])
  . "\\ndob:" . htmlspecialchars($_POST["fatherdob"]) . " living: " .  htmlspecialchars($_POST["fatherstatus"]);
$fatherinfo .= ($_POST["fatherstatus"] == "yes")? "\\n" . htmlspecialchars($_POST["Faddress"])
  . " " . htmlspecialchars($_POST["Faddress2"]) . "\\n" . htmlspecialchars($_POST["Fcity"]) . " " . htmlspecialchars($_POST["Fstate"]) 
  . " " . htmlspecialchars($_POST["Fzipcode"]) . " " . htmlspecialchars($_POST["Fcountry"]) 
  . "\\nin US:" . htmlspecialchars($_POST["FinUS"]): ""; 
$fatherinfo .= ($_POST["fatherstatus"] == "no")?  "\\nyear died" . $_POST["Fyeardied"] : "";
$motherinfo = htmlspecialchars($_POST["motherFname"]) . " " . htmlspecialchars($_POST["motherLname"]) . "\\ndob:" . 
  htmlspecialchars($_POST["motherdob"]) . " living: " . htmlspecialchars($_POST["motherstatus"]);
$motherinfo .= ($_POST["motherstatus"] == "yes")?  "\\n" . htmlspecialchars($_POST["Maddress"]) . " " . htmlspecialchars($_POST["Maddress2"]) . "\\n" . 
  htmlspecialchars($_POST["Mcity"]) . " " . htmlspecialchars($_POST["Mstate"]) . " " . htmlspecialchars($_POST["Mzipcode"]) . " " . 
  htmlspecialchars($_POST["Mcountry"]) . "\\nin US:" . htmlspecialchars($_POST["MUSstatus"]): "";
$motherinfo .= ($_POST["motherstatus"] == "no")?  "\\nyear died" . $_POST["Myeardied"] : "";
$relatives = htmlspecialchars($_POST["Otherrelatives"]);
$spouse = htmlspecialchars($_POST["SFname"]) . " " . htmlspecialchars($_POST["SLname"]) . " " . htmlspecialchars($_POST["Sdob"])
  . "\\n" . htmlspecialchars($_POST["Saddress"]) . " " . htmlspecialchars($_POST["Saddress2"]) . "\\n" . htmlspecialchars($_POST["Scity"]) 
  . " " . htmlspecialchars($_POST["Sstate"]) . " " . htmlspecialchars($_POST["Szipcode"]) . " " . htmlspecialchars($_POST["Scountry"]) 
  . "\\nMarried:" . htmlspecialchars($_POST["Dmarriage"]) . " " . htmlspecialchars($_POST["Pmarriage"]);
$groups = ($_POST["organization"] == "yes")? "organization:" . $_POST["organizationexp"]."\\n" : "";
$groups .= ($_POST["taliban"] == "yes")? "taliban:" . $_POST["talibanexp"]."\\n" : "";
$groups .= ($_POST["communist"] == "yes")? "communist:" . $_POST["communistexp"]."\\n" : "";
$groups .= ($_POST["farcelnauc"] == "yes")? "farcelnauc:" . $_POST["farcelnaucexp"]."\\n" : "";
$groups .= ($_POST["terrororg"] == "yes")? "terrororg:" . $_POST["terrororgexp"]."\\n" : "";
$groups .= ($_POST["famterrorist"] == "yes")? "famterrorist:" . $_POST["famterroristexp"]."\\n" : "";
$countries = ($_POST["traveled"] == "yes")? "traveled:" . $_POST["traveledexp"]."\\n" : "";
$countries .= ($_POST["resided"] == "yes")? "resided:" . $_POST["residedexp"]."\\n" : "";
$military = ($_POST["served"] == "yes")? "served:" . $_POST["served"]."\\n" : "";
$military .= ($_POST["armygroup"] == "yes")? "militia:" . $_POST["armygroup"]."\\n" : "";
$issues = ($_POST["exchange"] == "yes")?  "exchange:" . $_POST["exchangeexp"]. "\\n" : "";
$issues .= ($_POST["labor"] == "yes")?  "labor:" . $_POST["laborexp"]. "\\n" : "";
$issues .= ($_POST["medical"] == "yes")?  "medical:" . $_POST["medicalexp"]. "\\n" : "";
$issues .= ($_POST["certification"] == "yes")?  "certification:" . $_POST["certificationexp"]. "\\n" : "";
$issues .= ($_POST["citizenship"] == "yes")?  "citizenship:" . $_POST["citizenshipexp"]. "\\n" : "";
$issues .= ($_POST["military"] == "yes")?  "avoidmilitary:" . $_POST["militaryexp"]. "\\n" : "";

$sql = "INSERT INTO `h2a`.`appds160` (`marriage`,`nationality`,`othernations`,`otherresident`,`nationid`,`ssn`,`othercontact`,"
		."`socialmedia`,`pploststolen`,`ppduedate`, `fatherinfo`,`motherinfo`,`relatives`,`spouse`,`countries`,`groups`,`military`,`issues`,"
		."`applicantsid`) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssi", $marriage, $nationality, $othernations, $otherresident, $nationid, 
                                $ssn, $othercontact, $socialmedia, $pploststolen, $ppdatedue, $fatherinfo, $motherinfo, $relatives,
                                $spouse, $countries, $groups, $military, $issues,
                                $id);
$result = $stmt->execute();
if ($result == 1) {
    $message .= "junto con DS160";
} else {
    $message .= "Hubo un problema al guardar la información del DS160.";
}
echo $message; 								

$stmt = $conn->prepare("INSERT INTO jobhistory (empname, address, address2, city, state, zip, phone, salary,"
    ." jobtitle, datefrom, dateto, duties, supervisor, applicantsid) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssssi", $empname, $address, $address2, $city, $state, $zip, $phone, 
  $salary, $jobtitle, $datefrom, $dateto, $duties, $supervisor, $id);

$jobcount = count($_POST["jcompany"]);
for($i = 0; $i < $jobcount; $i++){
  $empname = htmlspecialchars($_POST["jcompany"][$i]);
  if (trim($empname) == "") continue;
  $address = htmlspecialchars($_POST["jaddress"][$i]);
  $address2 = htmlspecialchars($_POST["jaddress2"][$i]);
  $city = htmlspecialchars($_POST["jcity"][$i]);
  $state = htmlspecialchars($_POST["jstate"][$i]);
  $zip = htmlspecialchars($_POST["jzip"][$i]);
  $phone = htmlspecialchars($_POST["jphone"][$i]);
  $salary = htmlspecialchars($_POST["jsalary"][$i]);
  $jobtitle = htmlspecialchars($_POST["jobtitle"][$i]);
  $datefrom = htmlspecialchars($_POST["jsdate"][$i]);
  $dateto = htmlspecialchars($_POST["jedate"][$i]);
  $duties = htmlspecialchars($_POST["duties"][$i]);
  $supervisor = htmlspecialchars($_POST["supervisor"][$i]);
  $stmt->execute();
}

$stmt = $conn->prepare("INSERT INTO school (schoolname, address, address2, city, state, zip, major, datefrom, dateto, applicantsid) "
      ." VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssi", $schoolname, $address, $address2, $city, $state, $zip, $major, 
  $datefrom, $dateto, $id);

$schoolcount = count($_POST["scname"]);
for($i = 0; $i < $schoolcount; $i++){
  $schoolname = htmlspecialchars($_POST["scname"][$i]);
  if (trim($schoolname) == "") continue;
  $address = htmlspecialchars($_POST["scaddress"][$i]);
  $address2 = htmlspecialchars($_POST["scaddress2"][$i]);
  $city = htmlspecialchars($_POST["sccity"][$i]);
  $state = htmlspecialchars($_POST["scstate"][$i]);
  $zip = htmlspecialchars($_POST["sczip"][$i]);
  $major = htmlspecialchars($_POST["scmajor"][$i]);
  $datefrom = htmlspecialchars($_POST["scdatefrom"][$i]);
  $dateto = htmlspecialchars($_POST["scdateto"][$i]);
  $stmt->execute();
}

$stmt = $conn->prepare("INSERT INTO health (skillsid, applicantsid, medtreatment, reason) VALUES(?, ?, ?, ?)");
$stmt->bind_param("iiss", $skillsid, $id, $med, $reason1);
$issues = [];
$empty = "";

if ($_POST["disease"] == "yes") array_push($issues, array("Disease", $_POST["diseaseexp"], $empty));
if ($_POST["disorder"] == "yes") array_push($issues, array("Mental disorder", $_POST["disorderexp"], $empty));
if ($_POST["druguse"] == "yes") array_push($issues, array("Drug Abuse", $_POST["druguseexp"], $empty));
if ($_POST["vaccinations"] == "yes") array_push($issues, array("Vaccination docs", $_POST["vaccinationsexp"], $empty));
//if ($_POST["skills"] == "yes") array_push($issues, array("Firearms etc.", $_POST["skillsexp"], $empty));

$count = count($issues);
for($i = 0; $i < $count; $i++){
    $skillsid = getHealth($issues[$i]);
    $med = $issues[$i][1];
    $reason1 = $issues[$i][2];
    $stmt->execute();
}

if ($_POST["skills"] == "yes") {
  $stmt = $conn->prepare("INSERT INTO ability (skillsid, applicantsid, details) VALUES(?, ?, ?)");
  $stmt->bind_param("iis", $skillsid, $id, $reason1);
  $skillsid = getHealth("Firearms etc.");
  $reason1 = $_POST["skillsexp"];
  $stmt->execute();
}

if ($result == 1){
  echo " Su solicitud ha sido guardada, CITA se comunicará con usted cuando revisen su solicitud";
} else {
  echo " Hubo un problema al guardar su solicitud por favor contacte a CITA al (928)271-2619";
};

$conn->close();
function getHealth($health){
  global $conn;
  $sql = "SELECT id FROM skills WHERE skillenglish  = '" . $health ."'";
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