<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");


$firstName = $_POST["firstName"];
$secondName = $_POST["secondName"];
$description = $_POST["description"];
$dob = $_POST["dob"];
$country = $_POST["country"];
$userID = $_POST["userID"];

echo var_dump($_POST);

$stmt = new mysqli_stmt ($mysqli, "UPDATE users (first_name, last_name, description, country, dob)
        SET (?,?,?,?,?) WHERE id= ?");
if ($stmt) {
    $stmt->bind_param("sssssi", $firstName, $secondName, $description, $country, $dob, $userID);
    $stmt->execute();
    $user_id = $stmt->insert_id;
//vdhgfdh[
}
$str = 'Location:  ./adventure.php?id=' . $user_id;
//header($str);
?>