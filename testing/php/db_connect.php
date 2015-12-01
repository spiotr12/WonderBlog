<?php
/**
 * Created by PhpStorm.
 * User: 1307811
 * Date: 01/12/2015
 * Time: 12:08
 */
require_once(realpath(dirname(__FILE__) . "../../resources/config.php"));

$mysqli = new mysqli(
    $config["db"]["host"],
    $config["db"]["username"],
    $config["db"]["password"],
    $config["db"]["dbname"]
);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
//    echo "<h1>connected!</h1>";
}
