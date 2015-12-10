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
$verified = 0;

if ($stmt = $mysqli->prepare("SELECT id, first_name, last_name, privilege, verified FROM users WHERE first_name LIKE ? AND verified = ?")) {
    $search = "%" . $search . "%";
    $stmt->bind_param('si', $search, $verified);
    $stmt->execute();
    $stmt->bind_result($id, $fname, $lname, $priv, $veri);
    while($stmt->fetch()){
        $results[$id] = array(
            'fname' => $fname,
            'lname' => $lname,
            'privilege' => $priv,
            'verified' => ((bool) $veri),
            'id' => $id
        );
    }
}

//$results = array();
//
//if ($stmt = $mysqli->prepare("SELECT first_name, last_name, privilege, verified FROM users WHERE first_name LIKE ?")) {
//    $search = "%" . $search . "%";
//    $stmt->bind_param('s', $search);
//    $stmt->execute();
//    $results = $stmt->fetch();
//}

echo json_encode($results);