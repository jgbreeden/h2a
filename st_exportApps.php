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

    $query = "SELECT * from applicants";
	if ($_POST["expstatus"] != "all") {
		$query .= " where status = ?";
		if ($_POST["expcompany"] != "all") {
			$query .= " and employersid = ?";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("si", $_POST["expstatus"], $_POST["expcompany"]);
		} else {
			$stmt = $conn->prepare($query);
			$stmt->bind_param("s", $_POST["expstatus"]);
		}
		$stmt->execute();
		$result = $stmt->get_result();
	} else if ($_POST["expcompany" != "all"]) {
		$query .= " where employersid = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i", $_POST["expcompany"]);
	} else {
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
			$output .= "\n";
		}
		echo $output;
	}
?>