<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 17/12/2015
 * Time: 12:39
 */

require_once("../../resources/config.php");


$dir = "../img/contents/";
$scan = scandir($dir);
print_r($scan);