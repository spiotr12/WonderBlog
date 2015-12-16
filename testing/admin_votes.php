<?php
require_once("../resources/config.php");
require_once("./php/db_connect.php");


$advId = $_POST['adv_id'];
$adminVote = $_POST['admin_votes'];
echo $adminVote;
$stmt = new mysqli_stmt($mysqli, "UPDATE adventures SET admin_vote = $adminVote WHERE adv_id = $advId");
//if ($stmt) {
   // $stmt->bind_param("i", $advID);
    $stmt->execute();//}

    $mysqli->close();

  header("location: ./adventure.php?id=$advId");