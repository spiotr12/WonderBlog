<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$adventureID = $_POST["test"];
echo $adventureID;

$delete = new mysqli_stmt ($mysqli, "DELETE FROM adventures WHERE id = $adventureID");

if ($mysqli->query($delete) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $mysqli->error;
}

$mysqli->close();

?>

