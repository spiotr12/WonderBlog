<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");


$firstName = $_POST["firstName"];
$secondName = $_POST["secondName"];
$description = $_POST["description"];
$dob = $_POST["dob"];
$country = $_POST["country"];
$user_id = $_POST["userID"];



$stmt = new mysqli_stmt ($mysqli, "UPDATE users
        SET first_name = ?, last_name = ?, description = ?, country = ?, dob = ? WHERE id= ?");

if ($stmt) {
    $stmt->bind_param("sssssi", $firstName, $secondName, $description, $country, $dob, $user_id);
    $stmt->execute();


}
$str = 'Location:  ./author.php?id=' . $user_id;
header($str);
?>