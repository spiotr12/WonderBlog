<?php

require_once("../../resources/config.php");
require_once("./db_connect.php");

$advId = $_POST['adv_id'];
$userId = $_POST['user_id'];
$comment = $_POST['comment'];
$date = date("Y-m-d H:i:S");


$stmt = new mysqli_stmt($mysqli, "INSERT INTO comments (user_id, adv_id, comment, date) VALUES (?, ?, ?, ?)");
if($stmt){
    $stmt->bind_param("i",$userId, $advId, comment);
    $stmt->bind_param("s",$date);
    $stmt->execute();
}




$mysqli->close();
?>