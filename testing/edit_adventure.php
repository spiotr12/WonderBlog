<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");


$adventureName = $_POST["adventureName"];
$country = $_POST["country"];
$city = $_POST["city"];
$description = $_POST["description"];;
$adventure_id = $_POST["adventureID"];



$stmt = new mysqli_stmt ($mysqli, "UPDATE adventures
       SET name = ?, country = ?, city = ?, description = ? WHERE id= ?");

if ($stmt) {
    $stmt->bind_param("ssssi", $adventureName, $country, $city, $description, $adventure_id);
    $stmt->execute();


}

$mysqli->close();
$str = 'Location:  ./adventure.php?id=' . $adventure_id;
header($str);
?>