<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 2015-12-09
 * Time: 18:16
 */
require_once("../../resources/config.php");
require_once("./db_connect.php");

$search = NULL;
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$results = array();

if ($stmt = $mysqli->prepare("SELECT first_name, last_name, privilege, verified FROM users WHERE first_name LIKE ?")) {
    $search = "%" . $search . "%";
    $stmt->bind_param('s', $search);
    $stmt->execute();
    $stmt->bind_result($fname, $lname, $priv, $veri);
    while($stmt->fetch()){
        $results[] = array(
            ["fname"] => $fname,
            ['lname'] => $fname,
            ['privilege'] => $priv,
            ['verified'] => $veri
        );
    }
}


echo json_encode($results);