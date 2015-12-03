<?php

/* 
 * File created by Piotr Starzec
 * Contact: starzec.piotr.12@gmail.com
 * I declare copyrights for all code written by myself, excluding any third party library used in this project
 */

require_once("../../resources/config.php");
require_once("./db_connect.php");

sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['email'], $_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password']; // The hashed password.

	if (login($email, $password, $mysqli) == true) {
		// Login success
		echo "login successful";
//		header('Location: ../index.php?link=admin&success=11');
	} else {
		// Login failed
		echo "login failed";
//		header('Location: ../index.php?link=admin&error=1');
	}
} else {
	// The correct POST variables were not sent to this page. 
	echo 'Invalid Request';
//	header('Location: ../index.php?link=admin&error=40');
}
?>