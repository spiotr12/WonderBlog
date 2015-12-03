<?php

/* 
 * File created by Piotr Starzec
 * Contact: starzec.piotr.12@gmail.com
 * I declare copyrights for all code written by myself, excluding any third party library used in this project
 */


require_once("../../resources/config.php");
require_once(LIBRARY_PATH . "/functions.php");
require_once("./db_connect.php");

sec_session_start();

// Unset all session values 
$_SESSION = array();

// get session parameters 
$params = session_get_cookie_params();

// Delete the actual cookie. 
setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

// Destroy session 
session_destroy();
header('Location: ../index.php?link=admin');
?>