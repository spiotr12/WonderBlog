<?php

require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
require_once(LIBRARY_PATH . "/functions.php");
require_once("./php/db_connect.php");

// TO ALLOW USERS TO LOGIN ON EACH PAGE PLEASE COPY THIS CODE
require_once("./php/db_connect.php");
require_once("./php/classes/Login.class.php");
$login = new Login();
// END OF LOGIN SCRIPT

?>

<?php
header('Location:  ./index.php');
$adventureName = $_POST["adventureName"];
$country = $_POST["country"];
$city = $_POST["city"];
$description = $_POST["description"];
$date = date("Y-m-d H:i:s");
$userID = $_POST["userID"];

$stmt = new mysqli_stmt ($mysqli, "INSERT INTO adventures(user_id, name, country, city, description, date)
        VALUES(?,?,?,?,?,?)");
if($stmt){
    $stmt->bind_param("isssss",$userID, $adventureName, $country, $city, $description,$date );
    $stmt->execute();


}

?>