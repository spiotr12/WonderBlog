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
$adventureName = $_POST["adventureName"];
$country = $_POST["country"];
$city = $_POST["city"];
$description = $_POST["description"];
$date = $_POST["date"];

echo "Forename: " . $adventureName . " Surname: " . $country . " Date of Birth: " . $city . " Gender: " . $description . " Superpowers: " . $date;
?>