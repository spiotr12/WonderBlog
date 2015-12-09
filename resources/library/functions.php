<?php
/**
 * Created by PhpStorm.
 * User: 1307811
 * Date: 05/11/2015
 * Time: 12:12
 */
function redirectToHome() {
    header('Location: ./site');
    die();
}

function privilegeCheck($mysqli, $id){
    $stmt = new mysqli_stmt($mysqli, "SELECT privilege FROM users WHERE id = ?");
    $privilege = -1;
    if($stmt){
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_object();
        $privilege = $result->privilege;
    }
    return $privilege;
}