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

//change to an update

$sql = "UPDATE applicants SET firstname = ?, lastname = ?, phonecell = ?, phonehome = ?,"
. "address = ?, city = ?, state = ?, zipcode = ?, gender = ?, status = ?, specificarea = ?, whatarea = ?, stay8mo = ?, overtime = ?,"
. "extend = ?, extendwhynot = ?, dateofbirth = ?, email = ?, age = ?, height = ?, weight = ?, lift25to40 = ?, maritalstatus = ?,"
. "placeofbirth = ?, whatknowvisa = ?, howhearcita = ?, otherhelp = ?, whatknowcita = ?, ppnumber = ?, ppcity = ?, ppstate = ?,"
. "ppdateissue = ?, ppdatedue = ?, visas = ?, visaissues = ?, visarefused = ?, license = ? WHERE id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssssssssssssssssssssssssssi", $_POST["fname"], $_POST["lname"], $_POST["cphone"],
                            $_POST["hphone"], $_POST["address"], $_POST["city"],
                            $_POST["state"], $_POST["zip"], $_POST["gender"], $_POST["status"], $_POST["specificarea"], $_POST["whatarea"], 
                            $_POST["stay8mo"], $_POST["overtime"], $_POST["extend"],
                            $_POST["extendwhynot"], $_POST["dateofbirth"],  $_POST["email"], $_POST["age"],
                            $_POST["height"], $_POST["weight"], $_POST["lift25to40"], $_POST["maritalstatus"], $_POST["placeofbirth"],
                            $_POST["whatknowvisa"], $_POST["howhearcita"], $_POST["otherhelp"], $_POST["whatknowcita"],
                            $_POST["ppnumber"], $_PODT["ppcity"], $_POST["ppstate"], $_POST["ppdataissue"], $_POST["ppdatedue"], $_POST["visas"],
                            $_POST["visaissues"], $_POST["visarefused"], $_POST["license"],
                            $_POST["id"]);

//insert into app ds160

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
    $message .= "along with DS160"
} else {
    $message .= "There was a problem saving the DS160 info.";
}
echo $message; 								
$conn->close();