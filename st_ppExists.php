<?php
function ppExists($ppnum, $conn) {
    //assumes database is open
    $query = "select * from applicants where ppnumber = ?";
    $stmt2 = $conn->prepare ($query);
    $stmt2->bind_param ("s", $ppnum);
    $stmt2->execute();
    $result = $stmt2->get_result();
    if ($row = $result->fetch_assoc()) {
        return true;
    }
    else {
        return false;
    }
}
?>