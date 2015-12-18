<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$id = $_POST['id'];
$adventure_id = $_POST['adv_id'];




//echo "dump: " . var_dump($_POST) . "<br><br>";


$stmt = new mysqli_stmt ($mysqli, "DELETE FROM photos WHERE id= ?");

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
}


$mysqli->close();



$str = 'Location:  ./adventure.php?id=' . $adventure_id;
header($str);