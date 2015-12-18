<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");

$advId = $_POST['adv_id'];
$commentId = $_POST['id'];
$editedComment = $mysqli->real_escape_string($_POST['editComment']);
$date = date("Y-m-d H:i:s");

//echo "dump: " . var_dump($_POST) . "<br><br>";


$stmt = new mysqli_stmt ($mysqli, "UPDATE comments
       SET comment = ?, date = ? WHERE id= ?");

if ($stmt) {
    $stmt->bind_param("ssi", $editedComment, $date, $commentId);
    $stmt->execute();
}


$mysqli->close();

header("location: ./adventure.php?id=$advId");

?>