<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$adventureID = $_POST["test"];

$stmt = new mysqli_stmt($mysqli, "DELETE FROM `adventures` WHERE `adventures`.`id` = ?");
if ($stmt) {
    $stmt->bind_param("i", $adventureID);
    $stmt->execute();}


//echo "DONE";
//$str = 'Location:  ./index ';
//header($str);

$mysqli->close();

//header("location: ./index.php");

?>

