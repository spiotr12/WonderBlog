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
$date = date("Y-m-d H:i:s");
$userID = $_POST["userID"];

$stmt = new mysqli_stmt ($mysqli, "INSERT INTO adventures(user_id, name, country, city, description, date)
        VALUES(?,?,?,?,?,?)");
if($stmt){
    $stmt->bind_param("isssss",$userID, $adventureName, $country, $city, $description,$date );
    $stmt->execute();


}
echo "Forename: " . $adventureName . " Surname: " . $country . " Date of Birth: " . $city . " Gender: " . $description . " Superpowers: " . $date;
?>

<?php
if(isset($_POST['submit'])){
    $to = "ryanj1992@hotmail.co.uk"; // this is your Email address
    $from = $_POST['adventureName']; // this is the sender's Email address
    $subject = "Adventure Upload";
    $message = "A new adventure has been uploaded";

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message);
}
?>