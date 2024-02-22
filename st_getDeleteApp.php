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
	$query = "SELECT applicants.*, employers.company, appds160.ds160id, appds160.ssn FROM applicants 
                LEFT JOIN employers on applicants.employersid = employers.id 
                LEFT JOIN appds160 on applicants.id = appds160.applicantsid 
                WHERE applicants.id = ?";
    $stmt = $conn->prepare($query);
	$stmt->bind_param("i", $_POST["id"]);
	$stmt->execute();
	$results = $stmt->get_result();
	
    if ($row = $results->fetch_assoc()) {
        $json =  '{ "id": ' . $row["id"] . ', "firstname": "' . $row["firstname"] . '", "lastname": "' . $row["lastname"] 
            . '", "cphone": "' . $row["phonecell"] . '", "hphone": "' . $row["phonehome"] . '", "email": "' . $row["email"] 
            . '", "gender": "' . $row["gender"] . '", "marital": "' . $row["maritalstatus"]
            . '", "ppnumber": "' . $row["ppnumber"] . '", "dateofbirth": "' . $row["dateofbirth"] 
            . '", "status": "' . $row["status"] . '", "company": "' . $row["company"] . '", "ssn": "' . $row["ssn"] 
            . '", "ds160": "' . $row["ds160id"] . '", "notes": "' . $row["notes"] . '"';
        
        $company = $row["company"];
        $query = "SELECT * from assignments WHERE applicantsid = " . $row["id"];
        $results = $conn->query($query);
        if ($row = $results->fetch_assoc()) {
            $json .= ', "warning": "WARNING! There are existing Assignment records for this applicant.\n'
                    . ' They cannot be deleted until all assignment records have been deleted. Company: ';
            $json .= $company . '"';  
        }
    } else {
        $json = '{"id": 0, "warning": "WARNING! No applicant with that ID was found."';
    }

    $json .= '}';
    echo $json;

	$conn->close();
?>