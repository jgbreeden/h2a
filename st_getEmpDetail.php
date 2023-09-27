<?php
	header('Pragma: public');
	header('Cache-Control: maxage=1');
	header('Expires: ' . date('D, d M Y H:i:s'));
	header('Content-Type: application/json; charset=utf-8');
	require 'cred.php';
	//echo '{"test": "test value1"}, {"test": "test value2"}';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Comunicaton failed: " . $conn->connect_error);
	}
	$query = "SELECT applicants.*, experience.id AS exid, experience.years, experience.location, "
			. "experience.skillsid, experience.details, skills.skillenglish FROM applicants  LEFT "
			. "OUTER JOIN experience ON applicants.id = experience.applicantsid LEFT OUTER JOIN "
			. "skills ON experience.skillsid = skills.id WHERE applicants.id =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$results = $stmt->get_result();
	//echo $results->num_rows;
	//echo mysqli_error($conn);
	$row = $results->fetch_assoc();
	//write person fields, then "skills": [
	echo '{ "id": ' . $row["id"] . ', "firstname": "' . $row["firstname"] . '", "lastname": "'
		. $row["lastname"] . '", "cphone": "' . $row["phonecell"] . '", "hphone": "'
		. $row["phonehome"] . '", "address": "' . $row["address"] . '", "city": "'
		. $row["city"] . '", "state": "' . $row["state"] . '", "zip": "' . $row["zipcode"]
		. '", "status": "' . $row["status"] . '", "specificarea": "' . $row["specificarea"] . '", "whatarea": "' 
		. $row["whatarea"] . '", "stay8mo": "' . $row["stay8mo"] . '", "overtime": "' 
		. $row["overtime"] . '", "extend": "' . $row["extend"] . '", "extendwhynot": "'
		. $row["extendwhynot"] . '", "dateofbirth": "' . $row["dateofbirth"] . '", "email": "'
		. $row["email"] . '", "gender": "' . $row["gender"] . '", "age": "' . $row["age"] . '", "height": "' 
		. $row["height"] . '", "weight": "' . $row["weight"] . '", "lift25to40": "' . $row["lift25to40"] . '", "maritalstatus": "'
		. $row["maritalstatus"] . '", "placeofbirth": "' . $row["placeofbirth"] . '", "whatknowvisa": "' 
		. $row["whatknowvisa"] . '", "howhearcita": "' . $row["howhearcita"] . '", "otherhelp": "'
		. $row["otherhelp"] . '", "whatknowcita": "' . $row["whatknowcita"] . '", "ppnumber": "' 
		. $row["ppnumber"] . '", "ppcity": "' . $row["ppcity"] . '", "ppstate": "' . $row["ppstate"] . '", "ppdateissue": "'
		. $row["ppdateissue"] . '", "visas": "' . $row["visas"] . '", "visaissues": "'
		. $row["visaissues"] . '", "visarefused": "' . $row["visarefused"] . '", "license": "'
		. $row["license"] . '", "deported": "' . $row["deported"] . '", "legalissues": "' 
		. $row["crimes"] .  '", "ustravel": "' . $row["ustravel"] . '", "skills": [ '; 

	if (! is_null( $row["skillenglish"])) {
		echo '{ "skillenglish": "' . $row["skillenglish"] . '", "years": ' . $row["years"] 
			. ', "location": "' . $row["location"] . '", "exid": ' . $row["exid"] 
			. ', "skillsid": ' . $row["skillsid"] . ', "details": "' . $row["details"] . '"}';
	}
	while ($row = $results->fetch_assoc()) {
		echo ', { "skillenglish": "' . $row["skillenglish"] . '", "years": ' . $row["years"]
				. ', "location": "' . $row["location"] . '", "exid": ' . $row["exid"]
				. ', "skillsid": ' . $row["skillsid"] . ', "details": "' . $row["details"] . '"}';
	}
	echo '], "ability": [';
	$query = "SELECT ability.id as abid, ability.years, ability.location, "
			. "ability.details, skills.skillenglish as abeng, ability.skillsid FROM ability INNER JOIN skills ON "
			. "ability.skillsid = skills.id WHERE ability.applicantsid =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$comma = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {
		echo $comma . '{ "abid": "' . $row["abid"] . '", "years": ' . $row["years"] . ', "location": "' 
			. $row["location"] . '", "abeng": "' . $row["abeng"]
			. '", "details": "' . $row["details"] . '", "skillsid": "' . $row["skillsid"] . '"}';
		$comma = ", ";
	}
	/*
	echo '], "docs": [';
	$query = "SELECT documents.id as docid, documents.doctype, documents.whengot, documents.location, "
			. " issues.issueenglish as doceng, documents.issuesid FROM documents INNER JOIN issues ON "
			. "documents.issuesid = issues.id WHERE documents.applicantsid =?";

	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$comma = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {
		echo $comma . '{ "docid": "' . $row["docid"] . '", "doctype": "' . $row["doctype"] . '", "whengot": "' 
			. $row["whengot"] . '", "location": "' . $row["location"] . '", "doceng": "' . $row["doceng"] 
			. '", "issuesid": "' . $row["issuesid"] . '"}';
		$comma = ", ";
	}
	*/

	echo '],	"health": [';
	$query = "SELECT health.id as healthid, health.medtreatment, health.reason, health.skillsid,"
			. " skills.skillenglish as healtheng FROM health INNER JOIN skills ON "
			. "health.skillsid = skills.id WHERE health.applicantsid =?";

	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$comma = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {
		echo $comma . '{ "healthid": "' . $row["healthid"] . '", "healtheng": "' 
			. $row["healtheng"] . '", "reason": "' . $row["reason"] . '", "medtreatment": "' . $row["medtreatment"] . '", "skillsid": "' 
			. $row["skillsid"] . '"}';
		$comma = ", ";
	}
	/*
	echo '],	"issues": [';
	$query = "SELECT status.id as statusid, status.details, status.issuesid,"
			. " issues.issueenglish as statuseng FROM status INNER JOIN issues ON "
			. "status.issuesid = issues.id WHERE status.applicantsid =?";

	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$comma = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {
		echo $comma . '{ "statusid": "' . $row["statusid"] . '", "statuseng": "' 
			. $row["statuseng"] . '", "details": "'
			. $row["details"] . '", "issuesid": "' 
			. $row["issuesid"] . '"}';
		$comma = ", ";
	}
	*/
	echo'],  "jobhistory": [';
	$query = "SELECT * FROM jobhistory WHERE applicantsid =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$comma = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {								
		echo $comma .' { "id": ' . $row["id"] . ', "empname": "' . $row["empname"] . '",  "address": "' . $row["address"]
			. '", "address2": "' . $row["address2"] . '", "city": "' . $row["city"] . '", "state": "' . $row["state"] 
			. '", "zip": "' . $row["zip"] . '", "phone": "' . $row["phone"] . '", "salary": "' . $row["salary"] . '", "jobtitle": "' . $row["jobtitle"] 
			. '", "datefrom": "' . $row["datefrom"] . '", "dateto": "'. $row["dateto"] . '", "applicantsid": "' . $row["applicantsid"] 
			. '", "duties": "' . $row["duties"] . '", "supervisor": "' . $row["supervisor"]	. '"}';
		$comma = ", ";
		}

	echo '], "school": [';
	$query = "SELECT * FROM school WHERE applicantsid =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$comma = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {	
		echo $comma . '{ "id": ' . $row["id"] . ', "schoolname": "' . $row["schoolname"] . '",  "address": "' . $row["address"]
			. '", "address2": "' . $row["address2"] . '", "city": "' . $row["city"] . '", "state": "' . $row["state"] 
			. '", "zip": "' . $row["zip"] . '", "major": "' . $row["major"] . '", "datefrom": "' . $row["datefrom"] . '", "dateto": "'
			. $row["dateto"] . '", "applicantsid": "' . $row["applicantsid"] . '"}';
		$comma = ", ";
	}

	echo '], "appds160": ';
	$query = "SELECT * FROM appds160 WHERE applicantsid =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$results = $stmt->get_result();
	if ($row = $results->fetch_assoc()) {
		echo '{"id": ' . $row["id"] . ', "marriage": "' . $row["marriage"] . '", "nationality": "' 
		. $row["nationality"] . '", "othernations": "' . $row["othernations"] . '", "otherresident": "' 
		. $row["otherresident"] . '", "nationid": "' . $row["nationid"] . '", "ssn": "' . $row["ssn"] . '", "othercontact": "' 
		. $row["othercontact"] . '", "socialmedia": "' . $row["socialmedia"] . '", "pploststolen": "' 
		. $row["pploststolen"] . '", "father": "' . $row["fatherinfo"] . '", "mother": "' 
		. $row["motherinfo"] . '", "relatives": "' . $row["relatives"] . '", "spouse": "' 
		. $row["spouse"] . '", "countries": "' . $row["countries"] . '", "groups": "' . $row["groups"] . '", "military": "' 
		. $row["military"] . '", "issues": "' . $row["issues"] . '", "applicantsid": "' . $row["applicantsid"] . '"}';
	}

	echo '}';
	//loop through rows, add skill fields
	//end record
	$conn->close();
?>