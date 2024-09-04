<?php
$dir = "docs/d" .  $_GET["id"] . "/";
$filename = $dir . $_GET["fname"];
$newname = $dir . $_GET["newname"];
rename($filename, $newname);
echo $_GET["newname"];
?>