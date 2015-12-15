<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$advId = $_POST['adv_id'];
$userId = $_POST['user_id'];
$comment = $_POST['comment'];
$date = date("Y-m-d H:i:S");


$stmt = new mysqli_stmt($mysqli, "INSERT INTO comments (user_id, adv_id, comment, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss",$userId, $advId, $comment, $date);
    $stmt->execute();


$mysqli->close();

//header("location: ./adventure.php?id=$advId");

?>