<?php
	header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
	header('Pragma: no-cache');
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Cache-Control: post-check=0, pre-check=0',false);
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
	$json =  '{ "id": ' . $row["id"] . ', "firstname": "' . $row["firstname"] . '", "lastname": "'
		. $row["lastname"] . '", "cphone": "' . $row["phonecell"] . '", "hphone": "'
		. $row["phonehome"] . '", "address": "' . $row["address"] . '", "address2": "' . $row["address2"] . '", "city": "'
		. $row["city"] . '", "state": "' . $row["state"] . '", "zip": "' . $row["zipcode"] . '", "country": "' . $row["country"]
		. '", "status": "' . $row["status"] . '", "specificarea": "' . $row["specificarea"] . '", "whatarea": "' 
		. $row["whatarea"] . '", "stay8mo": "' . $row["stay8mo"] . '", "overtime": "' 
		. $row["overtime"] . '", "extend": "' . $row["extend"] . '", "extendwhynot": "'
		. $row["extendwhynot"] . '", "dateofbirth": "' . $row["dateofbirth"] . '", "email": "'
		. $row["email"] . '", "gender": "' . $row["gender"] . '", "lift25to40": "' . $row["lift25to40"] . '", "maritalstatus": "'
		. $row["maritalstatus"] . '", "placeofbirth": "' . $row["placeofbirth"] . '", "whatknowvisa": "' 
		. $row["whatknowvisa"] . '", "ppcountry": "' . $row["ppcountry"] . '", "pptype": "' . $row["pptype"] . '", "ppnumber": "' 
		. $row["ppnumber"] . '", "pplocation": "' . $row["pplocation"] . '", "ppdateissue": "'
		. $row["ppdateissue"] . '", "ppdatedue": "' . $row["ppdatedue"] . '", "visas": "' . $row["visas"] . '", "visaissues": "'
		. $row["visaissues"] . '", "visarefused": "' . $row["visarefused"] . '", "license": "'
		. $row["license"] . '", "deported": "' . $row["deported"] . '", "legalissues": "' 
		. $row["crimes"] .  '", "ustravel": "' . $row["ustravel"] . '", "farmwork": "' 
		. $row["farmwork"] . '", "employersid": "'  . $row["employersid"]. '", "notes": "' . $row["notes"] . '", "skills": [ '; 
		$json = str_replace(chr(13), "", $json);
		echo str_replace(chr(10), "\\n", $json);
	if (! is_null( $row["skillenglish"])) {
		$years = ($row["years"] == "")? 0: $row["years"];
		echo '{ "skillenglish": "' . $row["skillenglish"] . '", "years": ' . $years
			. ', "location": "' . $row["location"] . '", "exid": ' . $row["exid"] 
			. ', "skillsid": ' . $row["skillsid"] . ', "details": "' . $row["details"] . '"}';
	}
	while ($row = $results->fetch_assoc()) {
		$years = ($row["years"] == "")? 0: $row["years"];
		echo ', { "skillenglish": "' . $row["skillenglish"] . '", "years": ' . $years
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
		$years = ($row["years"] == "")? 0: $row["years"];
		echo $comma . '{ "abid": "' . $row["abid"] . '", "years": ' . $years . ', "location": "' 
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
	echo'],  "jobs": [';
	$query = "SELECT * FROM jobhistory WHERE applicantsid =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$comma = "";
	$json = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {								
		$json .= $comma .' { "id": ' . $row["id"] . ', "empname": "' . $row["empname"] . '",  "address": "' . $row["address"]
			. '", "address2": "' . $row["address2"] . '", "city": "' . $row["city"] . '", "state": "' . $row["state"] 
			. '", "zip": "' . $row["zip"] . '", "phone": "' . $row["phone"] . '", "salary": "' . $row["salary"] . '", "jobtitle": "' . $row["jobtitle"] 
			. '", "datefrom": "' . $row["datefrom"] . '", "dateto": "'. $row["dateto"] . '", "applicantsid": "' . $row["applicantsid"] 
			. '", "duties": "' . $row["duties"] . '", "country": "' . $row["country"] . '", "what": "' . $row["whatwork"]	. '"}';
		$comma = ", ";
	}
	$json = str_replace(chr(13), "", $json);
	echo str_replace(chr(10), "\\n", $json);
	echo '], "school": [';
	$query = "SELECT * FROM school WHERE applicantsid =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$comma = "";
	$json = "";
	$results = $stmt->get_result();
	while ($row = $results->fetch_assoc()) {	
		$json .= $comma . '{ "id": ' . $row["id"] . ', "schoolname": "' . $row["schoolname"] . '",  "address": "' . $row["address"]
			. '", "address2": "' . $row["address2"] . '", "city": "' . $row["city"] . '", "state": "' . $row["state"] . '", "country": "' . $row["country"]
			. '", "zip": "' . $row["zip"] . '", "grade": "' . $row["grade"] . '", "datefrom": "' . $row["datefrom"] . '", "dateto": "'
			. $row["dateto"] . '", "applicantsid": "' . $row["applicantsid"] . '"}';
		$comma = ", ";
	}

	$json = str_replace(chr(13), "", $json);
	echo str_replace(chr(10), "\\n", $json);
	echo ']';
	$query = "SELECT * FROM appds160 WHERE applicantsid =?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$results = $stmt->get_result();
	if ($row = $results->fetch_assoc()) {
		$json =  ', "ds160": {"id": ' . $row["id"] . ', "marriage": "' . $row["marriage"] . '", "nationality": "' 
		. $row["nationality"] . '", "othernations": "' . $row["othernations"] . '", "nationid": "' 
		. $row["nationid"] . '", "ssn": "' . $row["ssn"] . '", "mailaddress": "' . $row["mailaddress"] . '", "othercontact": "' 
		. $row["othercontact"] . '", "socialmedia": "' . $row["socialmedia"] . '", "ppissues": "' 
		. $row["ppissues"] . '", "father": "' . $row["fatherinfo"] . '", "mother": "' 
		. $row["motherinfo"] . '", "relatives": "' . $row["relatives"] . '", "spouse": "' 
		. $row["spouse"] . '", "countries": "' . $row["countries"] . '", "groups": "' . $row["groups"] . '", "military": "' 
		. $row["military"] . '", "confirmation": "' . $row["ds160id"] . '", "issues": "'
		. $row["issues"] . '", "applicantsid": "' . $row["applicantsid"] . '", "fingerprints": "' 
		. $row["fingerprints"] . '", "samecountry": "' . $row["samecountry"] . '", "language": "' . $row["language"] . '"}';
		$json = str_replace(chr(13), "", $json);
		echo str_replace(chr(10), "\\n", $json);
	}
    echo ', "documents": [';
	$dir = "../../docs/d" .  $_POST["id"];
	if (is_dir($dir)) {
		$files = scandir($dir);
	} else {
		$files = [];
	} 
	$json = "";
	for ($i = 0; $i < count($files); $i++) {
		$json .= '"' . $files[$i] . '",';
	}
	$json = substr($json, 0, strlen($json) - 1);
	echo $json . "]";
	echo '}';
	//loop through rows, add skill fields
	//end record
	$conn->close();
?>