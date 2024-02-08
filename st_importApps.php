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
    $stmt->bind_param
    for ($i = 1; $i < count($lines); $i++) {
        $fields = explode("\t", $lines[$i]);
        for ($f = 0; $f < $count($fields)) {
            if ($headers[$i] == "lastname") {
                $last = $fields[$i];
            } else {
                $last = "";
            }
            if ($headers[$i] == "firstname") {
                $first = $fields[$i];
            } else {
                $first = "";
            }
            if ($headers[$i] == "dateofbirth") {
                $dateofbirth = $fields[$i];
            } else {
                $dateofbirth = "";
            }
            if ($headers[$i] == "ppnumber") {
                $ppnumber = $fields[$i];
                $found = ppExists($ppnumber);
            } else {
                $ppnumber = "";
            }
            if ($headers[$i] == "phonecell") {
                $phonecell = $fields[$i];
            } else {
                $phonecell = "";
            }
            if ($headers[$i] == "email") {
                $email = $fields[$i];
            } else {
                $email = "";
            }
            if ($headers[$i] == "address") {
                $address = $fields[$i];
            } else {
                $address = "";
            }
        }
        if (!$found) {
            $result .= $stmt->execute();
        } else {
            $result .= $first . " " . $last . "-" . $ppnumber . " alread exists in database";
        }
    }
    echo $result;
    $conn->close();
?>