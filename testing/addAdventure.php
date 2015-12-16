<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");


$adventureName = $_POST["adventureName"];
$country = $_POST["country"];
$city = $_POST["city"];
$description = $_POST["description"];
$date = date("Y-m-d H:i:s");
$userID = $_POST["userID"];
$adventure_id = -1;
$stmt = new mysqli_stmt ($mysqli, "INSERT INTO adventures(user_id, name, country, city, description, date)
        VALUES(?,?,?,?,?,?)");
if ($stmt) {
    $stmt->bind_param("isssss", $userID, $adventureName, $country, $city, $description, $date);
    $stmt->execute();
    $adventure_id = $stmt->insert_id;

}
$str = 'Location:  ./adventure.php?id=' . $adventure_id;
//header($str);

//$admins = array();
//
//$stmt1 = new mysqli_stmt($mysqli, "SELECT first_name, email, privilege FROM users WHERE privilege = 0");
//if($stmt1){
//    $stmt1->bind_param($first_name, $email, $privilege);
//    $stmt1->execute();
//    $temp_arr = array(
//        'email' => $email,
//    );
//    array_push($admins, $temp_arr);
//}
// the message
$msg = "New Adventure Created" . $str;
//foreach ($admins as $stone)
// send email
mail("ruairigray@gmail.com","New Adventure",$msg);
echo $msg
?>
