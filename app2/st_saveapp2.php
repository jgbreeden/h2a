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
setlocale(LC_ALL, "en_US.utf8"); //needed for iconv below
require '../cred.php';
//echo $_POST["fname"];
if (isset($_POST["fname"])){


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
  $zipcode = clean($_POST["zipcode"]);
  $country = clean($_POST["country"]);
  $gender = clean($_POST["gender"]);
  //$specificarea = htmlspecialchars($_POST["specificarea"]);
  //$whatarea = htmlspecialchars($_POST["whatarea"]);
  //$stay8mo = htmlspecialchars($_POST["stay8mo"]);
  //$overtime = htmlspecialchars($_POST["overtime"]);
  //$extend = htmlspecialchars($_POST["extend"]);
  //$extendwhynot = htmlspecialchars($_POST["extendwhynot"]);
  $dateofbirth = clean($_POST["dateofbirth"]);
  $email = clean($_POST["email"]);
  //$age = htmlspecialchars($_POST["age"]);
  //$height = htmlspecialchars($_POST["height"]);
  //$weight = htmlspecialchars($_POST["weight"]);
  $maritalstatus = clean($_POST["maritalstatus"]);
  $placeofbirth = clean($_POST["placeofbirth"]) . ", " . clean($_POST["stateofbirth"]) . ", " . clean($_POST["countryofbirth"]);
  //$whatknowvisa = htmlspecialchars($_POST["whatknowvisa"]);
  //$howhearcita = htmlspecialchars($_POST["howhearcita"]);
  //$otherhelp = htmlspecialchars($_POST["otherhelp"]);
  //$whatknowcita = htmlspecialchars($_POST["whatknowcita"]);
  //$kilos = htmlspecialchars($_POST["kilos"]);
  //$datesigned = htmlspecialchars($_POST["datesigned"]);
  //$signature = htmlspecialchars($_POST["signature"]);
  $crimes =  ($_POST["arrested"] == "yes")? "arrested:" . clean($_POST["arrestedexp"]) ."\\n" :  "";
  $crimes .= ($_POST["substances"] == "yes")? "substances:" . clean($_POST["substancesexp"]) ."\\n" : "";
  $crimes .= ($_POST["postitution"] == "yes")? "postitution:" . clean($_POST["postitutionexp"]) ."\\n" : "";
  $crimes .= ($_POST["laundering"] == "yes")? "laundering:" . clean($_POST["launderingexp"]) ."\\n" : "";
  $crimes .= ($_POST["trafficking"] == "yes")? "trafficking:" . clean($_POST["traffickingexp"]) ."\\n" : "";
  $crimes .= ($_POST["aidtrafficking"] == "yes")? "aidtrafficking:" . clean($_POST["aidtraffickingexp"]) ."\\n" : "";
  $crimes .= ($_POST["famtrafficking"] == "yes")? "famtrafficking:" . clean($_POST["famtraffickingexp"]) ."\\n" : "";
  //$crimes .= ($_POST["severetrafficking"] == "yes")? "severetrafficking:" . $_POST["severetraffickingexp"]."\\n" : "";
  //$crimes .= ($_POST["famsubstances"] == "yes")? "famsubstances:" . $_POST["famsubstancesexp"]."\\n" : "";
  $crimes .= ($_POST["espionage"] == "yes")? "espionage:" . clean($_POST["espionageexp"]) ."\\n" : "";
  $crimes .= ($_POST["terrorist"] == "yes")? "terrorist:" . clean($_POST["terroristexp"]) ."\\n" : "";
  $crimes .= ($_POST["financial"] == "yes")? "financial:" . clean($_POST["financialexp"]) ."\\n" : "";
  $crimes .= ($_POST["genocide"] == "yes")? "genocide:" . clean($_POST["genocideexp"]) ."\\n" : "";
  //$crimes .= ($_POST["torture"] == "yes")? "torture:" . $_POST["tortureexp"]."\\n" : "";
  $crimes .= ($_POST["killings"] == "yes")? "killings:" . clean($_POST["killingsexp"]) ."\\n" : "";
  $crimes .= ($_POST["childsoldiers"] == "yes")? "childsoldiers:" . clean($_POST["childsoldiersexp"]) ."\\n" : "";
  $crimes .= ($_POST["violatereligions"] == "yes")? "violatereligions:" . clean($_POST["violatereligionsexp"]) ."\\n" : "";
  //$crimes .= ($_POST["personalgain"] == "yes")? "personalgain:" . $_POST["personalgainexp"]."\\n" : "";
  //$crimes .= ($_POST["fampersonalgain"] == "yes")? "fampersonalgain:" . $_POST["fampersonalgainexp"]."\\n" : "";
  //$crimes .= ($_POST["confidencial"] == "yes")? "confidencial:" . $_POST["confidencialexp"]."\\n" : "";
  //$crimes .= ($_POST["famconfidencial"] == "yes")? "famconfidencial:" . $_POST["famconfidencialexp"]."\\n" : "";
  $crimes .= ($_POST["popcontrol"] == "yes")? "popcontrol:" . clean($_POST["popcontrolexp"]) ."\\n" : "";
  $crimes .= ($_POST["humanorgans"] == "yes")? "humanorgans:" . clean($_POST["humanorgansexp"]) ."\\n" : "";
  //$crimes .= ($_POST["felony"] == "yes")? "felony:" . $_POST["felonyexp"]."\\n":"";
  $crimes.= ($_POST["taxation"] == "yes")? "skipustax:" . clean($_POST["taxationexp"]) ."\\n" : "";
  $crimes.= ($_POST["kidnapping"] == "yes")? "kidnapping:" . clean($_POST["kidnappingexp"]) ."\\n" : "";
  $crimes.= ($_POST["voted"] == "yes")? "Voting:" . clean($_POST["votedexp"]) ."\\n" : "";
  $crimes.= clean($_POST["ocrimes"]);  

  $status = "ready";
  $ppnumber = clean($_POST["ppnumber"]);
  $ppcity = clean($_POST["ppcity"]);
  $ppcity .= ", " . clean($_POST["ppstate"]);
  $ppcity .= ", " . clean($_POST["ppcountry"]);
  $ppdateissue = clean($_POST["ppissuedate"]);
  $ppissuecountry = clean($_POST["ppissuecountry"]);
  $ppdatedue = clean($_POST["ppduedate"]);
  $visas = clean($_POST["visatype"]);
  $visas .= (trim($_POST["appliedvisa"]) == "")? "\\n" . clean($_POST["ovisas"]): " applied:" . clean($_POST["appliedvisa"]) . "\\n" . clean($_POST["ovisas"]);
  $visaissues =  ($_POST["visaslost"] == "yes")? "LoSt:" . clean($_POST["visaslostyear"]) . "\\n" . clean($_POST["visaslostexp"]) : "";
  $visaissues .=  ($_POST["visascancelled"] == "yes")? "CanRev:" . clean($_POST["visascancelledexp"]) . "\\n"  : "";
  $visaissues .=  ($_POST["petition"] == "yes")? "petition:" . clean($_POST["petitionexp"]) . "\\n" . clean($_POST["ovisaissues"])  : clean($_POST["ovisaissues"]);
  $visarefused = ($_POST["visarefused"] == "yes")? clean($_POST["visarefusedexp"]) . "\\n:" 
      . clean($_POST["ovisarefused"]) :  clean($_POST["ovisarefused"]);
  $farmwork = clean($_POST["visaslist"]) . "\\n" . clean($_POST["ofarmwork"]);
  $license = ($_POST["license"] == "yes")? clean($_POST["licensenum"]) . " - " . clean($_POST["licensestate"]) . "\\n" . clean($_POST["olicense"]) : clean($_POST["olicense"]);
  $ustravel = ($_POST["usvisit"] == "yes")? clean($_POST["usvisitexp"]) . "\\n" . clean($_POST["oustravel"]) : clean($_POST["oustravel"]);
  $deported = ($_POST["hearing"] == "yes")?  "hearing:" . clean($_POST["hearingexp"]) . "\\n" : "";
  $deported .= ($_POST["visafraud"] == "yes")?  "visafraud:" . clean($_POST["visafraudexp"]) . "\\n" : "";
  $deported .= ($_POST["failedhearing"] == "yes")?  "failedhearing:" . clean($_POST["failedhearingexp"]) . "\\n" : "";
  $deported .= ($_POST["violatedtime"] == "yes")?  "violatedtime:" . clean($_POST["violatedtimeexp"]) . "\\n" : "";
  //$deported .= ($_POST["INA274C"] == "yes")?  "INA274C:" . $_POST["INA274Cexp"]. "\\n" : "";
  //$deported .= ($_POST["removed5"] == "yes")?  "removed5:" . $_POST["removed5exp"]. "\\n" : "";
  //$deported .= ($_POST["removed20"] == "yes")?  "removed20:" . $_POST["removed20exp"]. "\\n" : "";
  //$deported .= ($_POST["removed10"] == "yes")?  "removed10:" . $_POST["removed10exp"]. "\\n" : "";
  //$deported .= ($_POST["present180"] == "yes")?  "present180:" . $_POST["present180exp"]. "\\n" : "";
  //$deported .= ($_POST["present10"] == "yes")?  "present10:" . $_POST["present10exp"]. "\\n" . $_POST["odeported"] : $_POST["odeported"];
  $notes = ($_POST["otherskill"] == "yes")? clean($_POST["otherskillwhat"]) . "\\n" . clean($_POST["onotes"]) : clean($_POST["onotes"]);
  $id = $_POST["id"];
  $employersid = clean($_POST["company"]);

  //change to an update

  $sql = "UPDATE applicants SET firstname = ?, lastname = ?, employersid = ?, maritalstatus = ?, phonecell = ?, phonehome = ?,"
  . "address = ?, address2 = ?, city = ?, state = ?, zipcode = ?, country = ?, gender = ?, status = ?, ppnumber = ?, pplocation = ?,"
  . "ppdateissue = ?, ppdatedue = ?, visas = ?, visaissues = ?, visarefused = ?, license = ? , crimes = ?, deported = ?,"
  . "dateofbirth = ?, placeofbirth = ?, ppcountry = ?, ustravel = ?, farmwork = ?, notes = ? WHERE id = ?;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssssssssssssssssssssssssssi", $fname, $lname, $employersid, $maritalstatus, $phonecell, $phonehome, $address, $address2, $city, $state, $zipcode, $country,
                              $gender, $status, $ppnumber, $ppcity, $ppdateissue, $ppdatedue, $visas, $visaissues,
                              $visarefused, $license, $crimes, $deported, $dateofbirth, $placeofbirth, $ppissuecountry, $ustravel, $farmwork, $notes, $id);

  $result = $stmt->execute();
  if ($result == 1) {
      $message = ".";
  } else {
      $message = "Hubo un problema al guardar la información del solicitante: " . result.error;
      $conn->close();
      die($message);
  }
  //insert into app ds160
  $mailaddress =  clean($_POST["mailaddressdetail"]);
  $marriage = clean($_POST["datedivorce"]) . ": " . clean($_POST["reasondivorce"]);
  $nationality = clean($_POST["nationality"]);
  $othernations = "";//htmlspecialchars($_POST["othernations"]);
  $otherresident = "";//htmlspecialchars($_POST["otherresident"]);
  $nationid = clean($_POST["nationid"]);
  $ssn = clean($_POST["ssn"]);
  $othercontact = clean($_POST["otherphones"]) . "\\n" . clean($_POST["otheremail"]) . "\\n" . clean($_POST["othersocial"]);
  $socialmedia = clean($_POST["socialmedia"]);
  $pptype = clean($_POST["pptype"]);
  $pploststolen = ""; // htmlspecialchars($_POST["pploststolen"]);
  $fatherinfo = clean($_POST["fatherFname"]) . " " . clean($_POST["fatherLname"])
    . "\\ndob:" . clean($_POST["fatherdob"]);
  //$fatherinfo .= ($_POST["fatherstatus"] == "yes")? "\\n" . htmlspecialchars($_POST["Faddress"])
  //  . " " . htmlspecialchars($_POST["Faddress2"]) . "\\n" . htmlspecialchars($_POST["Fcity"]) . " " . htmlspecialchars($_POST["Fstate"]) 
  //  . " " . htmlspecialchars($_POST["Fzipcode"]) . " " . htmlspecialchars($_POST["Fcountry"]) 
  //  . "\\nin US:" . htmlspecialchars($_POST["FinUS"]): ""; 
  //$fatherinfo .= ($_POST["fatherstatus"] == "no")?  "\\nyear died" . $_POST["Fyeardied"] : "";
  $motherinfo = clean($_POST["motherFname"]) . " " . clean($_POST["motherLname"]) . "\\ndob:" . 
    clean($_POST["motherdob"]);
  //$motherinfo .= ($_POST["motherstatus"] == "yes")?  "\\n" . htmlspecialchars($_POST["Maddress"]) . " " . htmlspecialchars($_POST["Maddress2"]) . "\\n" . 
  //  htmlspecialchars($_POST["Mcity"]) . " " . htmlspecialchars($_POST["Mstate"]) . " " . htmlspecialchars($_POST["Mzipcode"]) . " " . 
  //  htmlspecialchars($_POST["Mcountry"]) . "\\nin US:" . htmlspecialchars($_POST["MUSstatus"]): "";
  //$motherinfo .= ($_POST["motherstatus"] == "no")?  "\\nyear died" . $_POST["Myeardied"] : "";
  $relatives = clean($_POST["Otherrelatives"]);
  $spouse = clean($_POST["SFname"]) . " " . clean($_POST["SLname"]) . " " . clean($_POST["Sdob"]) . "\\n";
  $spouse .= ($_POST["Sotheradd"] == "yes")?  clean($_POST["Saddress"]) . " " . clean($_POST["Saddress2"]) . "\\n" . clean($_POST["Scity"]) 
    . " " . clean($_POST["Sstate"]) . " " . clean($_POST["Szipcode"]) . " " . clean($_POST["Scountry"]) . "\\n": "";
  //$spouse .= "\\nMarried:" . htmlspecialchars($_POST["Dmarriage"]) . " " . htmlspecialchars($_POST["Pmarriage"]);
  $groups = ($_POST["organization"] == "yes")? "organization:" . clean($_POST["organizationexp"]) ."\\n" : "";
  //$groups .= ($_POST["taliban"] == "yes")? "taliban:" . $_POST["talibanexp"]."\\n" : "";
  $groups .= ($_POST["communist"] == "yes")? "communist:" . clean($_POST["communistexp"]) ."\\n" : "";
  //$groups .= ($_POST["farcelnauc"] == "yes")? "farcelnauc:" . $_POST["farcelnaucexp"]."\\n" : "";
  $groups .= ($_POST["terrororg"] == "yes")? "terrororg:" . clean($_POST["terrororgexp"]) ."\\n" : "";
  $groups .= ($_POST["famterrorist"] == "yes")? "famterrorist:" . clean($_POST["famterroristexp"]) ."\\n" : "";
  $countries = ($_POST["traveled"] == "yes")? "traveled:" . clean($_POST["traveledexp"]) ."\\n" : "";
  //$countries .= ($_POST["resided"] == "yes")? "resided:" . $_POST["residedexp"]."\\n" : "";
  $military = ($_POST["served"] == "yes")? "served:" . clean($_POST["served"]) ."\\n" : "";
  $military .= ($_POST["armygroup"] == "yes")? "militia:" . clean($_POST["armygroup"]) ."\\n" : "";
  $ppissues = clean($_POST["ppissues"]);
  $issues = ($_POST["exchange"] == "yes")?  "exchange:" . clean($_POST["exchangeexp"]) . "\\n" : "";
  $issues .= ($_POST["publicSchool"] == "yes")?  "Public School: yes"  : "";
  //$issues .= ($_POST["labor"] == "yes")?  "labor:" . $_POST["laborexp"]. "\\n" : "";
  //$issues .= ($_POST["medical"] == "yes")?  "medical:" . $_POST["medicalexp"]. "\\n" : "";
  //$issues .= ($_POST["certification"] == "yes")?  "certification:" . $_POST["certificationexp"]. "\\n" : "";
  //$issues .= ($_POST["citizenship"] == "yes")?  "citizenship:" . $_POST["citizenshipexp"]. "\\n" : "";
  //$issues .= ($_POST["military"] == "yes")?  "avoidmilitary:" . $_POST["militaryexp"]. "\\n" : "";
  $fingerprints = $_POST["print"];
  $samecountry = $_POST["samecountry"];
  $language = clean($_POST["language"]);
  $language.= ($_POST["dialect"] != "")? " dialect:" . clean($_POST["dialect"]):"";

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
    $empname = clean($_POST["jcompany"][$i]);
    if (trim($empname) == "") continue;
    $address = clean($_POST["jaddress"][$i]);
    $address2 = clean($_POST["jaddress2"][$i]);
    $city = clean($_POST["jcity"][$i]);
    $state = clean($_POST["jstate"][$i]);
    $country = clean($_POST["jcountry"][$i]);
    $zip = clean($_POST["jzip"][$i]);
    $phone = clean($_POST["jphone"][$i]);
    $salary = clean($_POST["jsalary"][$i]);
    $jobtitle = clean($_POST["jobtitle"][$i]);
    $datefrom = clean($_POST["jsdate"][$i]);
    $dateto = clean($_POST["jedate"][$i]);
    $duties = clean($_POST["duties"][$i]);
    $work = clean($_POST["jwork"][$i]);
    $stmt->execute();
  }

  $stmt = $conn->prepare("INSERT INTO school (schoolname, address, address2, city, state, country, zip, grade, datefrom, dateto, applicantsid) "
        ." VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssssssi", $schoolname, $address, $address2, $city, $state, $country, $zip, $grade, 
    $datefrom, $dateto, $id);

  $schoolcount = count($_POST["scname"]);
  for($i = 0; $i < $schoolcount; $i++){
    $schoolname = clean($_POST["scname"][$i]);
    if (trim($schoolname) == "") continue;
    $address = clean($_POST["scaddress"][$i]);
    $address2 = clean($_POST["scaddress2"][$i]);
    $city = clean($_POST["sccity"][$i]);
    $state = clean($_POST["scstate"][$i]);
    $country = clean($_POST["sccountry"][$i]);
    $zip = clean($_POST["sczip"][$i]);
    $grade = clean($_POST["scgrade"][$i]);
    $datefrom = clean($_POST["scdatefrom"][$i]);
    $dateto = clean($_POST["scdateto"][$i]);
    $stmt->execute();
  }

  $stmt = $conn->prepare("INSERT INTO health (skillsid, applicantsid, medtreatment, reason) VALUES(?, ?, ?, ?)");
  $stmt->bind_param("iiss", $skillsid, $id, $med, $reason1);
  $issues = [];
  $empty = "";

  if ($_POST["disease"] == "yes") array_push($issues, array("Disease", clean($_POST["diseaseexp"]), $empty));
  if ($_POST["disorder"] == "yes") array_push($issues, array("Mental disorder", clean($_POST["disorderexp"]), $empty));
  if ($_POST["druguse"] == "yes") array_push($issues, array("Drug Abuse", clean($_POST["druguseexp"]), $empty));
  if ($_POST["vaccinations"] == "yes") array_push($issues, array("Vaccination docs", clean($_POST["vaccinationsexp"]), $empty));
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
    $reason1 = clean($_POST["skillsexp"]);
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
function clean($val) {
  $new = iconv('UTF-8','ASCII//TRANSLIT',$val); //convert spanish chars
  return htmlspecialchars(trim($new));
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