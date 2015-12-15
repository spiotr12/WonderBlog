<?php

require_once("../../resources/config.php");
require_once("./db_connect.php");


$id = $_GET["id"];

$sql= "INSERT INTO `comments` (`id`, `user_id`, `comment`, `date`, `adv_id`) VALUES ('NULL', '1', '$_POST[comment]', CURRENT_TIMESTAMP , $id)";

if (!mysqli_query($con,$sql))
{
    die('Error: ' . mysqli_error($con));
}
echo "1 comment added";

mysqli_close($con);
?>