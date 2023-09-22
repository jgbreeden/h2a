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
$status = "ready";
$id = $_POST["id"];

//change to an update

$sql = "UPDATE applicants SET firstname = ?, lastname = ?, phonecell = ?, phonehome = ?,"
. "address = ?, city = ?, state = ?, zipcode = ?, gender = ?, status = ?, ppnumber = ?, ppcity = ?, ppstate = ?,"
. "ppdateissue = ?, visas = ?, visaissues = ?, visarefused = ?, license = ? WHERE id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssi", $fname, $lname, $phonecell, $phonehome, $address, $city, $state, $zipcode, 
                            $gender, $status, $ppnumber, $ppcity, $ppstate, $ppdateissue, $visas, $visaissues,
                            $visarefused, $license, $id);

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
$otherresident = ""; //htmlspecialchars($_POST["otherresident"]);
$nationid = htmlspecialchars($_POST["nationid"]);
$ssn = htmlspecialchars($_POST["ssn"]);
$othercontact = htmlspecialchars($_POST["otherphones"]) . "\n" . htmlspecialchars($_POST["otheremail"]);
$socialmedia = htmlspecialchars($_POST["socialmedia"]);
$pploststolen = ""; // htmlspecialchars($_POST["pploststolen"]);
$fatherinfo = htmlspecialchars($_POST["fatherFname"]) . " " . htmlspecialchars($_POST["fatherLname"])
. " " . htmlspecialchars($_POST["fatherdob"]);
$motherinfo = htmlspecialchars($_POST["motherFname"]) . " " . htmlspecialchars($_POST["motherLname"])
. " " . htmlspecialchars($_POST["motherdob"]);
$relatives = htmlspecialchars($_POST["Otherrelatives"]);
$spouse = htmlspecialchars($_POST["SFname"]). " " . htmlspecialchars($_POST["SLname"]);
$countries = ""; // htmlspecialchars($_POST["countries"]);
$groups = ($_POST["communist"] == "yes")? " communist:" . $_POST["communistexp"]."\n" : ""; // htmlspecialchars($_POST["groups"]);
//$groups .= ($_POST["communist"] == "yes")? " communist:" . $_POST["communistexp"]."\n" : "";
$military = htmlspecialchars($_POST["military"]);
$issues = ""; // htmlspecialchars($_POST["issues"]);
$crimes =  ($_POST["arrested"] == "yes")? " arrested:" . $_POST["arrestedexp"] ."\n" :  "";
$crimes .= ($_POST["substances"] == "yes")? " substances:" . $_POST["substancesexp"]."\n" : "";
$crimes .= ($_POST["postitution"] == "yes")? " postitution:" . $_POST["postitutionexp"]."\n" : "";
$crimes .= ($_POST["laundering"] == "yes")? " laundering:" . $_POST["launderingexp"]."\n" : "";
$crimes .= ($_POST["trafficking"] == "yes")? " trafficking:" . $_POST["traffickingexp"]."\n" : "";
$crimes .= ($_POST["aidtrafficking"] == "yes")? " aidtrafficking:" . $_POST["aidtraffickingexp"]."\n" : "";
$crimes .= ($_POST["famtrafficking"] == "yes")? " famtrafficking:" . $_POST["famtraffickingexp"]."\n" : "";
$crimes .= ($_POST["severetrafficking"] == "yes")? " severetrafficking:" . $_POST["severetraffickingexp"]."\n" : "";
$crimes .= ($_POST["famsubstances"] == "yes")? " famsubstances:" . $_POST["famsubstancesexp"]."\n" : "";
$crimes .= ($_POST["espionage"] == "yes")? " espionage:" . $_POST["espionageexp"]."\n" : "";
$crimes .= ($_POST["terrorist"] == "yes")? " terrorist:" . $_POST["terroristexp"]."\n" : "";
$crimes .= ($_POST["financial"] == "yes")? " financial:" . $_POST["financialexp"]."\n" : "";
$crimes .= ($_POST["terrororg"] == "yes")? " terrororg:" . $_POST["terrororgexp"]."\n" : "";
$crimes .= ($_POST["famterrorist"] == "yes")? " famterrorist:" . $_POST["famterroristexp"]."\n" : "";
$crimes .= ($_POST["genocide"] == "yes")? " genocide:" . $_POST["genocideexp"]."\n" : "";
$crimes .= ($_POST["torture"] == "yes")? " torture:" . $_POST["tortureexp"]."\n" : "";
$crimes .= ($_POST["killings"] == "yes")? " killings:" . $_POST["killingsexp"]."\n" : "";
$crimes .= ($_POST["childsoldiers"] == "yes")? " childsoldiers:" . $_POST["childsoldiersexp"]."\n" : "";
$crimes .= ($_POST["violatereligions"] == "yes")? " violatereligions:" . $_POST["violatereligionsexp"]."\n" : "";
//$crimes .= ($_POST[""] == "yes")? " :" . $_POST["exp"]."\n" : "";

$deportation = ($_POST["deported"] == "yes")? "deported:" . htmlspecialchars($_POST["deportedexp"])."\n" : "";
//$applicantsid = htmlspecialchars($_POST["applicantsid"]);

$sql = "INSERT INTO `h2a`.`appds160` (`marriage`,`nationality`,`othernations`,`otherresident`,`nationid`,`ssn`,`othercontact`,"
		."`socialmedia`,`pploststolen`,`ppduedate`, `fatherinfo`,`motherinfo`,`relatives`,`spouse`,`countries`,`groups`,`military`,`issues`,`crimes`,"
		."`deportation`,`applicantsid`) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssssi", $marriage, $nationality, $othernations, $otherresident, $nationid, 
                                $ssn, $othercontact, $socialmedia, $pploststolen, $ppdatedue, $fatherinfo, $motherinfo, $relatives,
                                $spouse, $countries, $groups, $military, $issues, $crimes, $deportation,
                                $id);
$result = $stmt->execute();
if ($result == 1) {
    $message .= "junto con DS160";
} else {
    $message .= "Hubo un problema al guardar la información del DS160.";
}
echo $message; 								

$stmt = $conn->prepare("INSERT INTO jobhistory (empname, address, address2, city, state, zip, phone, salary,"
    ." jobtitle, datefrom, dateto, applicantsid) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssssi", $empname, $address, $address2, $city, $state, $zip, $phone, 
  $salary, $jobtitle, $datefrom, $dateto, $id);

$jobcount = count($_POST["jcompany"]);
for($i = 0; $i < $jobcount; $i++){
  $empname = htmlspecialchars($_POST["jcompany"][$i]);
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
  $stmt->execute();
}

$stmt = $conn->prepare("INSERT INTO school (schoolname, address, address2, city, state, zip, major, datefrom, dateto, applicantsid) "
      ." VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssi", $schoolname, $address, $address2, $city, $state, $zip, $major, 
  $datefrom, $dateto, $id);

$schoolcount = count($_POST["scname"]);
for($i = 0; $i < $schoolcount; $i++){
  $schoolname = htmlspecialchars($_POST["scname"][$i]);
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

if ($result == 1){
  echo " Su solicitud ha sido guardada, CITA se comunicará con usted cuando revisen su solicitud";
} else {
  echo " Hubo un problema al guardar su solicitud por favor contacte a CITA al (928)271-2619";
};

$conn->close();

?>
</body>
</html>