<?php
require_once("../resources/config.php");
require_once("./php/db_connect.php");


$advId = $_POST['adv_id'];
$adminVote = $_POST['admin_votes'];
echo $adminVote;
$stmt = new mysqli_stmt($mysqli, "UPDATE adventures SET admin_vote = ? WHERE adv_id = ?");
if ($stmt) {
    $stmt->bind_param("ii", $adminVote, $advID);
    $stmt->execute();}

    $mysqli->close();

  //  header("location: ./adventure.php?id=$advId");