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
$kilos = htmlspecialchars($_POST["kilos"]);
$datesigned = htmlspecialchars($_POST["datesigned"]);
$signature = htmlspecialchars($_POST["signature"]);
$status = "new";
$id = $_POST["id"];

//change to an update

$sql = "UPDATE applicants SET firstname = ?, lastname = ?, phonecell = ?, phonehome = ?,"
. "address = ?, city = ?, state = ?, zipcode = ?, gender = ?, status = ?, ppnumber = ?, ppcity = ?, ppstate = ?,"
. "ppdateissue = ?, ppdatedue = ?, visas = ?, visaissues = ?, visarefused = ?, license = ? WHERE id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssssssssi", $fname, $lname, $phonecell, $phonehome, $address, $city, $state, $zipcode, 
                            $gender, $status, $ppnumber, $ppcity, $ppstate, $ppdateissue, $ppdatedue, $visas, $visaissues,
                            $visarefused, $license, $id);

//insert into app ds160
$marriage = htmlspecialchars($_POST["marriage"]);
$nationality = htmlspecialchars($_POST["nationality"]);
$othernations = htmlspecialchars($_POST["othernations"]);
$otherresident = htmlspecialchars($_POST["otherresident"]);
$nationid = htmlspecialchars($_POST["nationid"]);
$ssn = htmlspecialchars($_POST["ssn"]);
$othercontact = htmlspecialchars($_POST["othercontact"]);
$socialmedia = htmlspecialchars($_POST["socialmedia"]);
$pploststolen = htmlspecialchars($_POST["pploststolen"]);
$fatherinfo = htmlspecialchars($_POST["fatherinfo"]);
$motherinfo = htmlspecialchars($_POST["motherinfo"]);
$relatives = htmlspecialchars($_POST["relatives"]);
$spouse = htmlspecialchars($_POST["spouse"]);
$countries = htmlspecialchars($_POST["countries"]);
$groups = htmlspecialchars($_POST["groups"]);
$military = htmlspecialchars($_POST["military"]);
$issues = htmlspecialchars($_POST["issues"]);
$crimes = htmlspecialchars($_POST["crimes"]);
$deportation = htmlspecialchars($_POST["deportation"]);
$applicantsid = htmlspecialchars($_POST["applicantsid"]);

$sql = "INSERT INTO `h2a`.`appds160` (`marriage`,`nationalilty`,`othernations`,`otherresident`,`nationid`,`ssn`,`othercontact`,"
		."`socalmedia`,`pploststolen`,`fatherinfo`,`motherinfo`,`relatives`,`spouse`,`countries`,`groups`,`military`,`issues`,`crimes`,"
		."`deportation`,`applicantsid`) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssssssssi", $_POST["marriage"], $_POST["nationalilty"], $_POST["othernations"], $_POST["otherresident"], $_POST["nationid"], 
                                $_POST["ssn"], $_POST["othercontact"], $_POST["socialmedia"], $_POST["pploststolen"], $_POST["fatherinfo"], $_POST["motherinfo"], $_POST["relatives"],
                                $_POST["spouse"], $_POST["countires"], $_POST["groups"], $_POST["military"], $_POST["issues"], $_POST["crimes"], $_POST["deportation"], $_POST["applicantsid"],
                                $_POST["id"]);
$result = $stmt->execute();
if ($result == 1) {
    $message .= "along with DS160";
} else {
    $message .= "There was a problem saving the DS160 info.";
}
echo $message; 								
$conn->close();


$stmt = $conn->prepare("INSERT INTO jobhistory (empname, address, address2, city, state, zip, phone, salary, jobtitle, datefrom, dateto, applicantsid) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssi", $id, $empname, $address, $address2, $city, $state, $zip, $phone, $salary, $jobtitle, $datefrom, $dateto, $applicantsid);

$jobcount = count($_POST["company"])
for($i = 0; $i < $jobcount; $i++){
  $empname = htmlspecialchars($_POST["jcompany"][i]);
  $address = htmlspecialchars($_POST["jaddress"][i]);
  $address2 = htmlspecialchars($_POST["jaddress2"][i]);
  $city = htmlspecialchars($_POST["jcity"][i]);
  $state = htmlspecialchars($_POST["jstate"][i]);
  $zip = htmlspecialchars($_POST["jzip"][i]);
  $phone = htmlspecialchars($_POST["jphone"][i]);
  $salary = htmlspecialchars($_POST["jsalary"][i]);
  $jobtitle = htmlspecialchars($_POST["jjobtitle"][i]);
  $datefrom = htmlspecialchars($_POST["jdatefrom"][i]);
  $dateto = htmlspecialchars($_POST["jdateto"][i]);
  $stmt->execute();
}

$stmt = $conn->prepare("INSERT INTO school (schoolname, address, address2, city, state, zip, major, datefrom, dateto, applicantsid) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssi", $schoolname, $address, $address2, $city, $state, $zip, $major, $datefrom, $dateto, $id);

$schoolcount = count($_POST["school"])
for($i = 0; $i < $schoolcount; $i++){
  $schoolname = htmlspecialchars($_POST["jschoolname"][i]);
  $address = htmlspecialchars($_POST["jaddress"][i]);
  $address2 = htmlspecialchars($_POST["jaddress2"][i]);
  $city = htmlspecialchars($_POST["jcity"][i]);
  $state = htmlspecialchars($_POST["jstate"][i]);
  $zip = htmlspecialchars($_POST["jzip"][i]);
  $major = htmlspecialchars($_POST["jmajor"][i]);
  $datefrom = htmlspecialchars($_POST["jdatefrom"][i]);
  $dateto = htmlspecialchars($_POST["jdateto"][i]);
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