<?php


require_once("../resources/config.php");
require_once("./php/db_connect.php");


$advId = $_POST['adv_id'];

$stmt = new mysqli_stmt($mysqli, "UPDATE votes SET vote = vote+1 WHERE `adv_id` = ?");
if ($stmt) {
    $stmt->bind_param("i", $advId);
    $stmt->execute();
}


$mysqli->close();


//header("location: ./adventure.php?id=$advId");
