<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$advId = $_POST['adv_id'];
$commentId = $_POST['id'];



//echo "dump: " . var_dump($_POST) . "<br><br>";


$stmt = new mysqli_stmt ($mysqli, "DELETE FROM comments WHERE id= ?");

if ($stmt) {
    $stmt->bind_param("i", $commentId);
    $stmt->execute();
}


$mysqli->close();

header("location: ./adventure.php?id=$advId");