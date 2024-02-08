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
    $email = "";
    $address = "";

    $lines = explode("\n", $_POST["appTable"]);
    $headers = explode("\t", $lines[0]);
    $values = "";
    $sql = "insert into applicants(lastname, firstname, dateofbirth, ppnumber, phonecell, email, address) values (?, ?, ?, ?, ?, ?, ?)";
    for ($i = 0; $i < count($headers); $i++) {
        if (strtoupper($headers[$i]) == "APELLIDOS") {
            $headers[$i] = "lastname";
        } else
        if (strtoupper($headers[$i]) == "NOMBRES" || strtoupper($headers[$i]) == "NOMBRE") {
            $headers[$i] = "firstname";
        } else
        if (strtoupper($headers[$i]) == "FECHA NAC") {
            $headers[$i] = "dateofbirth";
        } else
        if (strtoupper($headers[$i]) == "PASAPORTE") {
            $headers[$i] = "ppnumber";
        } else
        if (strtoupper($headers[$i]) == "TELEFONO") {
            $headers[$i] = "phonecell";
        } else
        if (strtoupper($headers[$i]) == "CORREO ELECTRONIO" || strtoupper($headers[$i]) == "EMAIL") {
            $headers[$i] = "email";
        } else
        if (strtoupper($headers[$i]) == "DIRECCION") {
            $headers[$i] = "address";
        } else {
            $headers[$i] = "skip";
        }
    }
    $result = "";
    $found = false;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first, $last, $dateofbirth, $ppnumber, $phonecell, $email, $address);
    for ($i = 1; $i < count($lines); $i++) {
        $last = "";
        $first = "";
        $passport = "";
        $dateofbirth = "";
        $phonecell = "";
        $email = "";
        $address = "";
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
                $phonecell = $fields[$f];
            } 
            if ($headers[$f] == "email") {
                $email = $fields[$f];
            } 
            if ($headers[$f] == "address") {
                $address = $fields[$f];
            } 
        }
        if ($ppnumber == "") {
            $result .= $first . " " . $last . " does not have a passport number, not saved.\n";
        } else if ($found) {
            $result .= $first . " " . $last . " (" . $ppnumber . ") alread exists in database.\n";
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