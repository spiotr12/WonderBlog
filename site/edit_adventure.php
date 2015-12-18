<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");


$adventureName = $mysqli->real_escape_string($_POST["adventureName"]);
$country = $mysqli->real_escape_string($_POST["country"]);
$city = $mysqli->real_escape_string($_POST["city"]);
$description = $mysqli->real_escape_string($_POST["description"]);
$adventure_id = $mysqli->real_escape_string($_POST["adventureID"]);
$keywords = $mysqli->real_escape_string($_POST["keywords"]);



$stmt = new mysqli_stmt ($mysqli, "UPDATE adventures
       SET name = ?, country = ?, city = ?, description = ?, keywords = ? WHERE id= ?");

if ($stmt) {
    $stmt->bind_param("sssssi", $adventureName, $country, $city, $description, $keywords, $adventure_id);
    $stmt->execute();


}



$mysqli->close();
$str = 'Location:  ./adventure.php?id=' . $adventure_id;
header($str);
?>