<?php
	header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
	header('Pragma: no-cache');
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Cache-Control: post-check=0, pre-check=0',false);
	header('Content-Type: application/json; charset=utf-8');
	require 'cred.php';

	$conn = new mysqli($host, $user, $password, $db);
    if ($conn->connect_error) {
        die("Comunicaton failed: " . $conn->connect_error);
    }
	$contractFields = "";
	$contractJoin = "";
	$contractGroup = "";
	if (isset($_POST["expcontract"])) {
		$contractFields = ", employers.company, max(assignments.startdate) as startdate, contracts.contractnum, contracts.contractname ";
		$contractJoin = " left outer join employers on applicants.employersid = employers.id	left outer join assignments on applicants.id = assignments.applicantsid	inner join contracts on assignments.contractsid = contracts.id";
		$contractGroup = " group by applicants.id";
	}
    $query = "SELECT *" . $contractFields . " from applicants" . $contractJoin;
	if ($_POST["expstatus"] != "all") {
		$query .= " where status = ?";
		if ($_POST["expcompany"] != "all") {
			$query .= " and applicants.employersid = ?" . $contractGroup;
			$stmt = $conn->prepare($query);
			$stmt->bind_param("si", $_POST["expstatus"], $_POST["expcompany"]);
		} else {
			$query .= $contractGroup;
			$stmt = $conn->prepare($query);
			$stmt->bind_param("s", $_POST["expstatus"]);
		}
		$stmt->execute();
		$result = $stmt->get_result();
	} else if ($_POST["expcompany"] != "all") {
		$query .= " where applicants.employersid = ?" . $contractGroup;
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i", $_POST["expcompany"]);
		$stmt->execute();
		$result = $stmt->get_result();
	} else {
		$query .= $contractGroup;
		$result = $conn->query($query);
	}
	
	if ($result->num_rows > 0) {
		$output = "firstname, lastname ";
		if (isset($_POST["expdemographics"])) {
			$output .= ", gender, dateofbirth, placeofbirth, maritalstatus";
		}
		if (isset($_POST["expaddress"])) {
			$output .= ", address, address2, city, state, zipcode, country";
		}
		if (isset($_POST["expcontactinfo"])) {
			$output .= ", phonecell, phonehome, email";
		}
		if (isset($_POST["expppinfo"])) {
			$output .= ", pptype, ppnumber, ppcountry, pplocation, ppdateissue, ppdatedue";
		}
		if (isset($_POST["explink"])) {
			$output .= ", app2 link";
		}
		if (isset($_POST["expcontract"])) {
			$output .= ", company, contractnum, contractname, startdate";
		}
		$output .= "\n";
		while ($row = $result->fetch_assoc()) {
			$output = $output . '"' .$row["firstname"] . '","' . $row["lastname"] . '"';
			if (isset($_POST["expdemographics"])) {
				$output .= ',"' . $row["gender"] . '","' . $row["dateofbirth"] . '","' . $row["placeofbirth"] . '","' . $row["maritalstatus"] . '"';
			}
			if (isset($_POST["expaddress"])) {
				$output .= ',"' . $row["address"] . '","' . $row["address2"] . '","' . $row["city"] . '","' . $row["state"] . '","' . $row["zipcode"] . '","' . $row["country"] . '"';
			}
			if (isset($_POST["expcontactinfo"])) {
				$output .= ',"' . $row["phonecell"] . '","' . $row["phonehome"] . '","' . $row["email"] . '"';
			}
			if (isset($_POST["expppinfo"])) {
				$output .= ',"' . $row["pptype"] . '","' . $row["ppnumber"] . '","' . $row["ppcountry"] . '","' . $row["pplocation"] . '","' . $row["ppdateissue"] . '","' . $row["ppdatedue"] . '"';
			}
			if (isset($_POST["explink"])) {
				$output .= ',"https://por-nosotros-trabajamos.h-2a.com/app2/app2.html?id=' . $row["id"] . '"';
			}
			if (isset($_POST["expcontract"])) {
				$output .= ',"' . $row["company"] . '","' . $row["contractnum"] . '","' . $row["contractname"] . '","' . $row["startdate"] . '"';
			}	
			$output .= "\n";
		}
		echo $output;
	}
?>