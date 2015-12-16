<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$adventureID = $_POST["test"];

$delete = new mysqli_stmt ($mysqli, "DELETE FROM adventures WHERE id = $adventureID");

echo "DONE";
//$str = 'Location:  ./index';
//header($str);

$mysqli->close();

?>

