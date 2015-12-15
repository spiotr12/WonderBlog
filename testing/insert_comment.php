<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$advId = $_POST['adv_id'];
$userId = $_POST['user_id'];
$comment = $_POST['comment'];
$date = date("Y-m-d H:i:s");

echo "dump: " . var_dump($_POST) . "<br><br>";


$stmt = new mysqli_stmt($mysqli, "INSERT INTO comments (user_id, adv_id, comment, date) VALUES (?, ?, ?, ?)");
if ($stmt) {
    $stmt->bind_param("iiss", $userId, $advId, $comment, $date);
    $stmt->execute();
} else {
    echo "stmt error";
}

echo "eror: " . $mysqli->error;

$mysqli->close();

//header("location: ./adventure.php?id=$advId");

?>