<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 2015-12-09
 * Time: 18:16
 */
//require_once(realpath(dirname(__FILE__) . "../../resources/config.php"));
//require_once("../../resources/config.php");
require_once("./db_connect.php");

$search = NULL;
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$results = null;

if ($stmt = $mysqli->prepare("SELECT first_name, last_name, privilege, verified FROM users WHERE first_name LIKE ?")) {
    $search = "%" . $search . "%";
    $stmt->bind_param('s', $search);
    $stmt->execute();
    $resultset = $stmt->get_result();
    $results = $resultset->fetch_array();
}


echo json_encode($results);