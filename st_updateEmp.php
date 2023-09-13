<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE applicants SET firstname = ?, lastname = ?, phonecell = ?, phonehome = ?,"
		. "address = ?, city = ?, state = ?, zipcode = ?, gender = ?, status = ?, specificarea = ?, whatarea = ?, stay8mo = ?, overtime = ?,"
		. "extend = ?, extendwhynot = ?, dateofbirth = ?, email = ?, age = ?, height = ?, weight = ?, lift25to40 = ?, maritalstatus = ?,"
		. "placeofbirth = ?, whatknowvisa = ?, howhearcita = ?, otherhelp = ?, whatknowcita = ?, ppnumber = ?, ppcity = ?, ppstate = ?,"
		. "ppdateissue = ?, ppdatedue = ?, visas = ?, visaissues = ?, visarefused = ?, license = ?, deported = ? WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sssssssssssssssssssssssssssssssssssssi", $_POST["fname"], $_POST["lname"], $_POST["cphone"],
									$_POST["hphone"], $_POST["address"], $_POST["city"],
									$_POST["state"], $_POST["zip"], $_POST["gender"], $_POST["status"], $_POST["specificarea"], $_POST["whatarea"], 
									$_POST["stay8mo"], $_POST["overtime"], $_POST["extend"],
									$_POST["extendwhynot"], $_POST["dateofbirth"],  $_POST["email"], $_POST["age"],
									$_POST["height"], $_POST["weight"], $_POST["lift25to40"], $_POST["maritalstatus"], $_POST["placeofbirth"],
									$_POST["whatknowvisa"], $_POST["howhearcita"], $_POST["otherhelp"], $_POST["whatknowcita"],
									$_POST["ppnumber"], $_PODT["ppcity"], $_POST["ppstate"], $_POST["ppdataissue"], $_POST["ppdatedue"], $_POST["visas"],
									$_POST["visaissues"], $_POST["visarefused"], $_POST["license"], $_POST["usresidency"],
									$_POST["id"]);
	$result = $stmt->execute();
	$message = "";
	if ($result == 1) {
		$message =  "<h2>Record Saved</h2>";
		//echo "First name: " . $_POST["fname"];
	} else {
		$message ="There was a problem saving the record, please try again.";
	}
	$sql = "UPDATE appds160 SET marriage = ?, nationalilty = ?, othernation = ?, mationid = ?, ssn = ?, othercontact = ?, socialmedia = ?,"
		. "pploststolen = ?, fatherinfo = ?, motherinfo = ?, relatives = ?, spouse = ?, countries = ?, groups = ?, military = ?"
		. "issues = ?, crimes = ? , deportation = ?, applicantsid = ? WHERE id = ?;";
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
?>