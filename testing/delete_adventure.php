<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$adventureID = $_POST["test"];
echo $adventureID;

$stmt = new mysqli_stmt($mysqli, "DELETE FROM adventures WHERE id = ?");
if ($stmt) {
    $stmt->bind_param("i", $adventureID);
    $stmt->execute();
}



//$str = 'Location:  ./index '  ;
//header($str);

$mysqli->close();

//header("location: ./index.php");

?>

