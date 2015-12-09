<?php
/**
 * Created by PhpStorm.
 * User: 1307811
 * Date: 01/12/2015
 * Time: 12:08
 */
require_once(dirname(__FILE__) . "../../resources/config.php");

define("DB_HOST", $config["db"]["host"]);
define("DB_USER", $config["db"]["username"]);
define("DB_PASSWORD", $config["db"]["password"]);
define("DB_NAME", $config["db"]["dbname"]);

$mysqli = new mysqli(
    DB_HOST,
    DB_USER,
    DB_PASSWORD,
    DB_NAME
);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
//    echo "<h1>connected!</h1>";
}
