<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");



$adventureName = $_POST["adventureName"];
$country = $_POST["country"];
$city = $_POST["city"];
$description = $_POST["description"];
$date = date("Y-m-d H:i:s");
$userID = $_POST["userID"];
$adventure_id = -1;
$stmt = new mysqli_stmt ($mysqli, "INSERT INTO adventures(user_id, name, country, city, description, date)
        VALUES(?,?,?,?,?,?)");
if($stmt){
    $stmt->bind_param("isssss",$userID, $adventureName, $country, $city, $description,$date );
    $stmt->execute();
    $adventure_id = $stmt->insert_id;

}
header('Location:  ./index.php');
?>