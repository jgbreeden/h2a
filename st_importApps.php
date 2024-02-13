<?php
	require 'cred.php';
    require 'st_ppExists.php';
	$conn = new mysqli($host, $user, $password, $db);
	if ($conn->connect_error) {
		die("Connect error: " . $conn->connect_error);
	}
    $last = "";
    $first = "";
    $passport = "";
    $dateofbirth = "";
    $phonecell = "";
    $phonehome = "";
    $email = "";
    $address = "";
    $city = "";
    $zipcode = "";
    $employer = $_POST["impcompany"];
    $result = "";
    $lines = explode("\n", $_POST["appTable"]);
    $headers = explode("\t", $lines[0]);
    $values = "";
    $sql = "insert into applicants(lastname, firstname, dateofbirth, ppnumber, phonecell, phonehome, email, address, city, zipcode, employersid) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    for ($i = 0; $i < count($headers); $i++) {
        if (trim(strtoupper($headers[$i])) == "APELLIDOS") {
            $headers[$i] = "lastname";
        } else
        if (trim(strtoupper($headers[$i])) == "NOMBRES" || strtoupper($headers[$i]) == "NOMBRE") {
            $headers[$i] = "firstname";
        } else
        if (trim(strtoupper($headers[$i])) == "FECHA NAC") {
            $headers[$i] = "dateofbirth";
        } else
        if (trim(strtoupper($headers[$i])) == "PASAPORTE") {
            $headers[$i] = "ppnumber";
        } else
        if (trim(strtoupper($headers[$i])) == "TELEFONO") {
            $headers[$i] = "phonecell";
        } else
        if (trim(strtoupper($headers[$i])) == "CORREO ELECTRONIO" || strtoupper($headers[$i]) == "EMAIL") {
            $headers[$i] = "email";
        } else
        if (trim(strtoupper($headers[$i])) == "DIRECCION") {
            $headers[$i] = "address";
        } else {
            $headers[$i] = "skip";
        }
    }
    
    $found = false;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $last, $first, $dateofbirth, $ppnumber, $phonecell, $phonehome, $email, $address, $city, $zipcode, $employer);
    for ($i = 1; $i < count($lines); $i++) {
        $last = "";
        $first = "";
        $passport = "";
        $dateofbirth = "";
        $phonecell = "";
        $phonehome = "";
        $email = "";
        $address = "";
        $city = "";
        $zipcode = "";
        $fields = explode("\t", $lines[$i]);
        if (count($fields) <= 2) continue;
        for ($f = 0; $f < count($fields); $f++) {
            if ($headers[$f] == "lastname") {
                $last = $fields[$f];
            } 
            if ($headers[$f] == "firstname") {
                $first = $fields[$f];
            } 
            if ($headers[$f] == "dateofbirth") {
                $dateofbirth = $fields[$f];
            } 
            if ($headers[$f] == "ppnumber") {
                $ppnumber = $fields[$f];
                $found = ppExists($ppnumber, $conn);
            } 
            if ($headers[$f] == "phonecell") {
                if (strpos($fields[$f], "/")) {
                    $phonecell = substr($fields[$f], 0, strpos($fields[$f], "/"));
                    $phonehome = substr($fields[$f], strpos($fields[$f], "/") + 1);
                } else if (stripos($fields[$f], "Y")) {
                    $phonecell = substr($fields[$f], 0, stripos($fields[$f], "Y"));
                    $phonehome = substr($fields[$f], stripos($fields[$f], "Y") + 1);
                } else {
                    $phonecell = $fields[$f];
                }

            } 
            if ($headers[$f] == "email") {
                $email = $fields[$f];
            } 
            if ($headers[$f] == "address") {
                $fields[$f] = trim($fields[$f]);
                if (strpos($fields[$f], ",")) {
                    $address = substr($fields[$f], 0, strpos($fields[$f], ","));
                    $zipcode = substr($fields[$f], strlen($fields[$f]) - 5);
                    if (is_numeric($zipcode)) {
                        $city = substr($fields[$f], strpos($fields[$f], ","), strlen($fields[$f]) - 5);
                    } else {
                        $zipcode = "";
                        $city = substr($fields[$f], strpos($fields[$f], ","));
                    }
                } else { 
                    if (is_numeric(substr($fields[$f], strlen($fields[$f]) - 5))) {
                        $zipcode = substr($fields[$f], strlen($fields[$f]) - 5);
                        $address = substr($fields[$f], 0, strlen($fields[$f]) - 5);
                    } else {
                        $address = $fields[$f];
                    }
                }
            } 
        }
        if ($ppnumber == "") {
            $result .= $first . " " . $last . " does not have a passport number, not saved.\n";
        } else if ($found) {
            $result .= $first . " " . $last . " (" . $ppnumber . ") already exists in database.\n";
        } else {
            if ($stmt->execute() == 1) {
                $result .= $first . " " . $last . " saved. Email & Link:\n\t" . $email 
                    . "  https://por-nosotros-trabajamos.h-2a.com/app2/app2.html?id=" . $stmt->insert_id . "\n";
            } else {
                $result .= $stmt->error();
            }
        }
    }
    echo $result;
    $conn->close();
?>