<!DOCTYPE html>
<html>
<title>Application</title>
<head>
<link rel="stylesheet" href="../mk.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style> 
#id, #fileToUpload {
  display: none;
}
#fakeUpload {
  line-height: 30px;
  padding: 4px;
  border: 1px solid #666;
  border-radius: 2px;
  margin-top: 5px;
  background-color: #eee;
  font-family: arial, sans-serif;
  font-size: 22px;
}
#fileName {
  margin-top: 5px;
}
</style>
</head>
<body>
<img src="../tjlogo.webp" id="tjlogo">
<h1>Trabajamos Juntos</h1>
<?php
require '../cred.php';
//echo $_POST["fname"];
if (isset($_POST["fname"])){


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
  $country = htmlspecialchars($_POST["country"]);
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
  $placeofbirth = htmlspecialchars($_POST["placeofbirth"]) . ", " . htmlspecialchars($_POST["stateofbirth"]) . ", " . htmlspecialchars($_POST["countryofbirth"]);
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
  //$crimes .= ($_POST["severetrafficking"] == "yes")? "severetrafficking:" . $_POST["severetraffickingexp"]."\\n" : "";
  //$crimes .= ($_POST["famsubstances"] == "yes")? "famsubstances:" . $_POST["famsubstancesexp"]."\\n" : "";
  $crimes .= ($_POST["espionage"] == "yes")? "espionage:" . $_POST["espionageexp"]."\\n" : "";
  $crimes .= ($_POST["terrorist"] == "yes")? "terrorist:" . $_POST["terroristexp"]."\\n" : "";
  $crimes .= ($_POST["financial"] == "yes")? "financial:" . $_POST["financialexp"]."\\n" : "";
  $crimes .= ($_POST["genocide"] == "yes")? "genocide:" . $_POST["genocideexp"]."\\n" : "";
  //$crimes .= ($_POST["torture"] == "yes")? "torture:" . $_POST["tortureexp"]."\\n" : "";
  $crimes .= ($_POST["killings"] == "yes")? "killings:" . $_POST["killingsexp"]."\\n" : "";
  $crimes .= ($_POST["childsoldiers"] == "yes")? "childsoldiers:" . $_POST["childsoldiersexp"]."\\n" : "";
  $crimes .= ($_POST["violatereligions"] == "yes")? "violatereligions:" . $_POST["violatereligionsexp"]."\\n" : "";
  //$crimes .= ($_POST["personalgain"] == "yes")? "personalgain:" . $_POST["personalgainexp"]."\\n" : "";
  //$crimes .= ($_POST["fampersonalgain"] == "yes")? "fampersonalgain:" . $_POST["fampersonalgainexp"]."\\n" : "";
  //$crimes .= ($_POST["confidencial"] == "yes")? "confidencial:" . $_POST["confidencialexp"]."\\n" : "";
  //$crimes .= ($_POST["famconfidencial"] == "yes")? "famconfidencial:" . $_POST["famconfidencialexp"]."\\n" : "";
  $crimes .= ($_POST["popcontrol"] == "yes")? "popcontrol:" . $_POST["popcontrolexp"]."\\n" : "";
  $crimes .= ($_POST["humanorgans"] == "yes")? "humanorgans:" . $_POST["humanorgansexp"]."\\n" : "";
  //$crimes .= ($_POST["felony"] == "yes")? "felony:" . $_POST["felonyexp"]."\\n":"";
  $crimes.= ($_POST["taxation"] == "yes")? "skipustax:" . $_POST["taxationexp"]."\\n" : "";
  $crimes.= ($_POST["kidnapping"] == "yes")? "kidnapping:" . $_POST["kidnappingexp"]."\\n" : "";
  $crimes.= ($_POST["voted"] == "yes")? "Voting:" . $_POST["votedexp"]."\\n" : "";
  $crimes.= $_POST["ocrimes"];  

  $status = "ready";
  $ppnumber = $_POST["ppnumber"];
  $ppcity = $_POST["ppcity"];
  $ppcity .= ", " . $_POST["ppstate"];
  $ppcity .= ", " . $_POST["ppcountry"];
  $ppdateissue = $_POST["ppissuedate"];
  $ppissuecountry = $_POST["ppissuecountry"];
  $ppdatedue = $_POST["ppduedate"];
  $visas = $_POST["visatype"] ." applied:" .$_POST["appliedvisa"] . "\\n". $_POST["visaslist"]. "\\n" . $_POST["ovisas"];
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
  //$deported .= ($_POST["INA274C"] == "yes")?  "INA274C:" . $_POST["INA274Cexp"]. "\\n" : "";
  //$deported .= ($_POST["removed5"] == "yes")?  "removed5:" . $_POST["removed5exp"]. "\\n" : "";
  //$deported .= ($_POST["removed20"] == "yes")?  "removed20:" . $_POST["removed20exp"]. "\\n" : "";
  //$deported .= ($_POST["removed10"] == "yes")?  "removed10:" . $_POST["removed10exp"]. "\\n" : "";
  //$deported .= ($_POST["present180"] == "yes")?  "present180:" . $_POST["present180exp"]. "\\n" : "";
  //$deported .= ($_POST["present10"] == "yes")?  "present10:" . $_POST["present10exp"]. "\\n" . $_POST["odeported"] : $_POST["odeported"];
  $notes = ($_POST["otherskill"] == "yes")? $_POST["otherskillwhat"] . "\\n" . $_POST["onotes"] : $_POST["onotes"];
  $id = $_POST["id"];
  $employersid = $_POST["company"];

  //change to an update

  $sql = "UPDATE applicants SET firstname = ?, lastname = ?, employersid = ?, maritalstatus = ?, phonecell = ?, phonehome = ?,"
  . "address = ?, address2 = ?, city = ?, state = ?, zipcode = ?, country = ?, gender = ?, status = ?, ppnumber = ?, pplocation = ?,"
  . "ppdateissue = ?, ppdatedue = ?, visas = ?, visaissues = ?, visarefused = ?, license = ? , crimes = ?, deported = ?,"
  . "dateofbirth = ?, placeofbirth = ?, ppcountry = ?, ustravel = ?, notes = ? WHERE id = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssssssssssssssssssssssssssi", $fname, $lname, $employersid, $maritalstatus, $phonecell, $phonehome, $address, $address2, $city, $state, $zipcode, $country,
                              $gender, $status, $ppnumber, $ppcity, $ppdateissue, $ppdatedue, $visas, $visaissues,
                              $visarefused, $license, $crimes, $deported, $dateofbirth, $placeofbirth, $ppissuecountry, $ustravel, $notes, $id);

  $result = $stmt->execute();
  if ($result == 1) {
      $message = ".";
  } else {
      $message = "Hubo un problema al guardar la información del solicitante: " . result.error;
      $conn->close();
      die($message);
  }
  //insert into app ds160
  $mailaddress =  htmlspecialchars($_POST["mailaddressdetail"]);
  $marriage = htmlspecialchars($_POST["datedivorce"]) . ": " . htmlspecialchars($_POST["reasondivorce"]);
  $nationality = htmlspecialchars($_POST["nationality"]);
  $othernations = "";//htmlspecialchars($_POST["othernations"]);
  $otherresident = "";//htmlspecialchars($_POST["otherresident"]);
  $nationid = htmlspecialchars($_POST["nationid"]);
  $ssn = htmlspecialchars($_POST["ssn"]);
  $othercontact = htmlspecialchars($_POST["otherphones"]) . "\\n" . htmlspecialchars($_POST["otheremail"]) . "\\n" . htmlspecialchars($_POST["othersocial"]);
  $socialmedia = htmlspecialchars($_POST["socialmedia"]);
  $pptype = htmlspecialchars($_POST["pptype"]);
  $pploststolen = ""; // htmlspecialchars($_POST["pploststolen"]);
  $fatherinfo = htmlspecialchars($_POST["fatherFname"]) . " " . htmlspecialchars($_POST["fatherLname"])
    . "\\ndob:" . htmlspecialchars($_POST["fatherdob"]);
  //$fatherinfo .= ($_POST["fatherstatus"] == "yes")? "\\n" . htmlspecialchars($_POST["Faddress"])
  //  . " " . htmlspecialchars($_POST["Faddress2"]) . "\\n" . htmlspecialchars($_POST["Fcity"]) . " " . htmlspecialchars($_POST["Fstate"]) 
  //  . " " . htmlspecialchars($_POST["Fzipcode"]) . " " . htmlspecialchars($_POST["Fcountry"]) 
  //  . "\\nin US:" . htmlspecialchars($_POST["FinUS"]): ""; 
  //$fatherinfo .= ($_POST["fatherstatus"] == "no")?  "\\nyear died" . $_POST["Fyeardied"] : "";
  $motherinfo = htmlspecialchars($_POST["motherFname"]) . " " . htmlspecialchars($_POST["motherLname"]) . "\\ndob:" . 
    htmlspecialchars($_POST["motherdob"]);
  //$motherinfo .= ($_POST["motherstatus"] == "yes")?  "\\n" . htmlspecialchars($_POST["Maddress"]) . " " . htmlspecialchars($_POST["Maddress2"]) . "\\n" . 
  //  htmlspecialchars($_POST["Mcity"]) . " " . htmlspecialchars($_POST["Mstate"]) . " " . htmlspecialchars($_POST["Mzipcode"]) . " " . 
  //  htmlspecialchars($_POST["Mcountry"]) . "\\nin US:" . htmlspecialchars($_POST["MUSstatus"]): "";
  //$motherinfo .= ($_POST["motherstatus"] == "no")?  "\\nyear died" . $_POST["Myeardied"] : "";
  $relatives = htmlspecialchars($_POST["Otherrelatives"]);
  $spouse = htmlspecialchars($_POST["SFname"]) . " " . htmlspecialchars($_POST["SLname"]) . " " . htmlspecialchars($_POST["Sdob"]) . "\\n";
  $spouse .= ($_POST["Sotheradd"] == "yes")?  htmlspecialchars($_POST["Saddress"]) . " " . htmlspecialchars($_POST["Saddress2"]) . "\\n" . htmlspecialchars($_POST["Scity"]) 
    . " " . htmlspecialchars($_POST["Sstate"]) . " " . htmlspecialchars($_POST["Szipcode"]) . " " . htmlspecialchars($_POST["Scountry"]) . "\\n": "";
  //$spouse .= "\\nMarried:" . htmlspecialchars($_POST["Dmarriage"]) . " " . htmlspecialchars($_POST["Pmarriage"]);
  $groups = ($_POST["organization"] == "yes")? "organization:" . $_POST["organizationexp"]."\\n" : "";
  //$groups .= ($_POST["taliban"] == "yes")? "taliban:" . $_POST["talibanexp"]."\\n" : "";
  $groups .= ($_POST["communist"] == "yes")? "communist:" . $_POST["communistexp"]."\\n" : "";
  //$groups .= ($_POST["farcelnauc"] == "yes")? "farcelnauc:" . $_POST["farcelnaucexp"]."\\n" : "";
  $groups .= ($_POST["terrororg"] == "yes")? "terrororg:" . $_POST["terrororgexp"]."\\n" : "";
  $groups .= ($_POST["famterrorist"] == "yes")? "famterrorist:" . $_POST["famterroristexp"]."\\n" : "";
  $countries = ($_POST["traveled"] == "yes")? "traveled:" . $_POST["traveledexp"]."\\n" : "";
  //$countries .= ($_POST["resided"] == "yes")? "resided:" . $_POST["residedexp"]."\\n" : "";
  $military = ($_POST["served"] == "yes")? "served:" . $_POST["served"]."\\n" : "";
  $military .= ($_POST["armygroup"] == "yes")? "militia:" . $_POST["armygroup"]."\\n" : "";
  $ppissues = $_POST["ppissues"];
  $issues = ($_POST["exchange"] == "yes")?  "exchange:" . $_POST["exchangeexp"]. "\\n" : "";
  $issues .= ($_POST["publicSchool"] == "yes")?  "Public School: yes"  : "";
  //$issues .= ($_POST["labor"] == "yes")?  "labor:" . $_POST["laborexp"]. "\\n" : "";
  //$issues .= ($_POST["medical"] == "yes")?  "medical:" . $_POST["medicalexp"]. "\\n" : "";
  //$issues .= ($_POST["certification"] == "yes")?  "certification:" . $_POST["certificationexp"]. "\\n" : "";
  //$issues .= ($_POST["citizenship"] == "yes")?  "citizenship:" . $_POST["citizenshipexp"]. "\\n" : "";
  //$issues .= ($_POST["military"] == "yes")?  "avoidmilitary:" . $_POST["militaryexp"]. "\\n" : "";
  $fingerprints = $_POST["print"];
  $samecountry = $_POST["samecountry"];
  $language = $_POST["language"];
  $language.= ($_POST["dialect"] != "")? " dialect:" .$_POST["dialect"]:"";

  $sql = "SELECT * FROM appds160 WHERE applicantsid = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $results = $stmt->get_result();
  if ($row = $results->fetch_assoc()) {
    $sql = "UPDATE appds160 SET marriage = ?,nationality = ?,othernations = ?,nationid = ?,ssn = ?,othercontact = ?,"
    ."socialmedia = ?,pptype = ?,fatherinfo = ?,motherinfo = ?,relatives = ?,spouse = ?,countries = ?,groups = ?,military = ?,issues = ?,"
    ."fingerprints = ?,language = ?,mailaddress = ?, ppissues = ?, samecountry = ? "
    ."WHERE applicantsid = ?";
  }
  else {
    $sql = "INSERT INTO appds160 (marriage,nationality,othernations,nationid,ssn,othercontact,"
    ."socialmedia,pptype,fatherinfo,motherinfo,relatives,spouse,countries,groups,military,issues,"
    ."fingerprints,language,mailaddress,ppissues,samecountry,"
    ."applicantsid) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  }

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssssssssssssssssssssi", $marriage, $nationality, $othernations, $nationid, 
                                  $ssn, $othercontact, $socialmedia, $pptype, $fatherinfo, $motherinfo, $relatives,
                                  $spouse, $countries, $groups, $military, $issues, $fingerprints, $language, $mailaddress, $ppissues,
                                  $samecountry, $id);
  $result = $stmt->execute();
  if ($result == 1) {
      $message .= ".\n";
  } else {
      $message .= "Hubo un problema al guardar la información del DS160.\n";
  }
  echo $message; 								

  $stmt = $conn->prepare("INSERT INTO jobhistory (empname, address, address2, city, state, country, zip, phone, salary,"
      ." jobtitle, datefrom, dateto, duties, whatwork, applicantsid) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssssssssssi", $empname, $address, $address2, $city, $state, $country, $zip, $phone, 
    $salary, $jobtitle, $datefrom, $dateto, $duties, $work, $id);

  $jobcount = count($_POST["jcompany"]);
  for($i = 0; $i < $jobcount; $i++){
    $empname = htmlspecialchars($_POST["jcompany"][$i]);
    if (trim($empname) == "") continue;
    $address = htmlspecialchars($_POST["jaddress"][$i]);
    $address2 = htmlspecialchars($_POST["jaddress2"][$i]);
    $city = htmlspecialchars($_POST["jcity"][$i]);
    $state = htmlspecialchars($_POST["jstate"][$i]);
    $country = htmlspecialchars($_POST["jcountry"][$i]);
    $zip = htmlspecialchars($_POST["jzip"][$i]);
    $phone = htmlspecialchars($_POST["jphone"][$i]);
    $salary = htmlspecialchars($_POST["jsalary"][$i]);
    $jobtitle = htmlspecialchars($_POST["jobtitle"][$i]);
    $datefrom = htmlspecialchars($_POST["jsdate"][$i]);
    $dateto = htmlspecialchars($_POST["jedate"][$i]);
    $duties = htmlspecialchars($_POST["duties"][$i]);
    $work = htmlspecialchars($_POST["jwork"][$i]);
    $stmt->execute();
  }

  $stmt = $conn->prepare("INSERT INTO school (schoolname, address, address2, city, state, country, zip, grade, datefrom, dateto, applicantsid) "
        ." VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssssssi", $schoolname, $address, $address2, $city, $state, $country, $zip, $grade, 
    $datefrom, $dateto, $id);

  $schoolcount = count($_POST["scname"]);
  for($i = 0; $i < $schoolcount; $i++){
    $schoolname = htmlspecialchars($_POST["scname"][$i]);
    if (trim($schoolname) == "") continue;
    $address = htmlspecialchars($_POST["scaddress"][$i]);
    $address2 = htmlspecialchars($_POST["scaddress2"][$i]);
    $city = htmlspecialchars($_POST["sccity"][$i]);
    $state = htmlspecialchars($_POST["scstate"][$i]);
    $country = htmlspecialchars($_POST["sccountry"][$i]);
    $zip = htmlspecialchars($_POST["sczip"][$i]);
    $grade = htmlspecialchars($_POST["scgrade"][$i]);
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
    $skillsid = getHealth(["Firearms etc."]);
    $reason1 = $_POST["skillsexp"];
    $stmt->execute();
  }

  if ($result == 1){
    echo " Su solicitud ha sido enviada. CITA se comunicará con usted cuando revisen su solicitud.";
  } else {
    echo " Hubo un problema al guardar su solicitud por favor contacte a CITA al (928)271-2619";
  };

  $conn->close();
}else {

  if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];
    if (is_null($id) || $id == "") {
      echo "Error: enlace no válido, comuníquese con CITA para obtener un nuevo enlace.";
      die();
    }
  } else {
    $id = $_POST["id"];
    if (is_null($id) || $id == "") {
      echo "Error: enlace no válido, comuníquese con CITA para obtener un nuevo enlace.";
      die();
    }
    $target_dir="../../h-2a/docs/d" . $id . '/';
    if (!is_dir($target_dir)){
      mkdir($target_dir);
    }

    $target_file= $target_dir . basename($_FILES["fileToUpload"] ["name"]);

    if (move_uploaded_file($_FILES["fileToUpload"] ["tmp_name"], $target_file)) {
        echo "El archivo " .  basename($_FILES["fileToUpload"] ["name"]) . " ha sido subido.";
    } else {
        echo "Lo siento, hubo un problema al cargar tu archivo.";
    }
  }

}
function getHealth($health){
  global $conn;
  $sql = "SELECT id FROM skills WHERE skillenglish  = '" . $health[0] ."'";
  $records = $conn->query($sql);
  if ($row = $records->fetch_assoc()){
      return $row["id"];
  } else {
      return 0;
  }
}

?>
<br>
Porfavor elija otro documento a subir.
<form  action="st_saveapp2.php" method="post" enctype="multipart/form-data">
    <br><br>
    <input type="text" name="id" id="id" class="hidden" value=<?php echo '"' . $id . '"' ; ?> >
    <label for="fileToUpload" id="fakeUpload">Seleccionar archivos
    <input type="file" name="fileToUpload" id="fileToUpload" 
      onchange="document.getElementById('fileName').value = this.value.substring(this.value.lastIndexOf('\\') + 1)">
    </label>
    <input type="text" id="fileName" placeholder="Ningún archivo elegido"><br><br>
    <input type="submit" value="Subir archivo" name="submit">


</form>

</body>
</html>