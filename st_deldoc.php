<?php
$dir = "docs/d" .  $_GET["id"] . "/";
$filename = $dir . $_GET["fname"];
unlink($filename);
echo "File deleted.";
?>