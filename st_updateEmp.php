<?php
	require 'cred.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
	$sql = "UPDATE applicants SET firstname = ?, lastname = ?, phonecell = ?, phonehome = ?, address = ?,"
		. "address2 = ?, city = ?, state = ?, zipcode = ?, country = ?, gender = ?, status = ?, "
		. "specificarea = ?, whatarea = ?, stay8mo = ?, overtime = ?, farmwork = ?, "
		. "extend = ?, extendwhynot = ?, dateofbirth = ?, email = ?, lift25to40 = ?, maritalstatus = ?,"
		. "placeofbirth = ?, whatknowvisa = ?, pptype = ?, ppcountry = ?, ppdatedue = ?, ppnumber = ?, pplocation = ?, "
		. "ppdateissue = ?, visas = ?, visaissues = ?, visarefused = ?, license = ?, deported = ?, crimes = ?, notes = ?, employersid=? "
		. "WHERE id = ?;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssssssssssssssssssssssssssssssssssssii", $_POST["fname"], $_POST["lname"], $_POST["cphone"],
									$_POST["hphone"], $_POST["address"], $_POST["address2"], $_POST["city"],
									$_POST["state"], $_POST["zip"], $_POST["country"], $_POST["gender"], $_POST["status"], $_POST["specificarea"], $_POST["whatarea"], 
									$_POST["stay8mo"], $_POST["overtime"], $_POST["farmwork"], $_POST["extend"],
									$_POST["extendwhynot"], $_POST["dateofbirth"],  $_POST["email"], $_POST["lift25to40"], $_POST["maritalstatus"], $_POST["placeofbirth"],
									$_POST["whatknowvisa"], $_POST["pptype"], $_POST["ppcountry"], $_POST["ppdatedue"],
									$_POST["ppnumber"], $_POST["ppcity"], $_POST["ppdateissue"], $_POST["visas"],
									$_POST["visaissues"], $_POST["visarefused"], $_POST["license"], $_POST["usresidency"],
									$_POST["legalissues"], $_POST["notes"], $_POST["company"], $_POST["id"]);
	$result = $stmt->execute();
	$message = "";
	if ($result == 1) {
		$message =  "<h2>Record Saved</h2>";
		//echo "First name: " . $_POST["fname"];
	} else {
		$message ="There was a problem saving the record, please try again.";
	}
	if ($_POST["ds160id"] != "") {
		$sql = "UPDATE appds160 SET marriage = ?, nationality = ?, othernations = ?, nationid = ?, ssn = ?, "
			. "othercontact = ?, socialmedia = ?, ppissues = ?, "
			. "fatherinfo = ?, motherinfo = ?, relatives = ?, spouse = ?, countries = ?, groups = ?, military = ?,"
			. "issues = ?, ds160id = ?, applicantsid = ?, fingerprints = ?, language = ? WHERE id = ?;";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssssssssssssssssssssi", $_POST["marriage"], $_POST["nationality"], $_POST["othernations"],  $_POST["nationid"], 
										$_POST["ssn"], $_POST["othercontact"], $_POST["socialmedia"], $_POST["ppissues"], 
										$_POST["father"], $_POST["mother"], $_POST["relatives"],
										$_POST["spouse"], $_POST["countries"], $_POST["groups"], $_POST["military"], $_POST["issues"], 
										$_POST["appconfirm"], $_POST["id"],	$_POST["ds160id"], $_POST["prints"], $_POST["language"]);
		$result = $stmt->execute();
		if ($result == 1) {
			$message .= "along with DS160";
		} else {
			$message .= "There was a problem saving the DS160 info.";
		}
	}
	echo $message; 								
	$conn->close();
	
?>