<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");


$adventureName = $_POST["adventureName"];
$country = $_POST["country"];
$city = $_POST["city"];
$description = $_POST["description"];;
$adventure_id = $_POST["adventureID"];



$stmt = new mysqli_stmt ($mysqli, "UPDATE adventures
//        SET name = ?, last_name = ?, country = ?, city = ?, description = ? WHERE id= ?");
//
//if ($stmt) {
//    $stmt->bind_param("sssssi", $firstName, $secondName, $description, $country, $dob, $user_id);
//    $stmt->execute();
//
//
//}
//$str = 'Location:  ./author.php?id=' . $user_id;
//header($str);
?>