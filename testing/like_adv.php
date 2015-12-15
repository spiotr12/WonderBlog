<?php


require_once("../resources/config.php");
require_once("./php/db_connect.php");


$advId = $_POST['adv_id'];
$userId = $_POST['user_id'];
$date = date("Y-m-d H:i:s");

$stmt = new mysqli_stmt($mysqli, "INSERT INTO votes (user_id, adv_id, date) VALUES (?, ?, ?)");
if ($stmt) {
    $stmt->bind_param("iis", $userId, $advId, $date);
    $stmt->execute();
}


$mysqli->close();


//header("location: ./adventure.php?id=$advId");
