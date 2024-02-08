<?php
function ppExists($ppnum) {
    //assumes database is open
    $query = "select * from applicants where ppnumber = ?";
    $stmt2 = $conn->prepare ($query);
    $stmt2->bind_param ("s", $ppnum);
    $result = $stmt2->execute();
    if ($row = $result->fetch_assoc()) {
        return true;
    }
    else {
        return false;
    }
}
?>