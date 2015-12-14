<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 14/12/2015
 * Time: 14:26
 */

require_once("../../resources/config.php");
require_once("./db_connect.php");
require_once("../../resources/library/functions.php");

$result = array(
    "success" => FALSE,
    "errors" => NULL
);

if ($_POST['adminId']) {
    $adminId = $_POST['adminId'];
    $userToVerifyId = $_POST['userToVerifyId'];
    if (privilegeCheck($mysqli, $adminId) == 0) {
        $stmt = new mysqli_stmt($mysqli, "UPDATE users SET verified=? WHERE id = ?");
        if($stmt){
            $verified = 1;
            $stmt->bind_param("ii", $verified, $userToVerifyId);
            if($stmt->execute()){
                $result['success'] = TRUE;
            } else{
                $result["errors"] = "user is not an admin";
            }
        }
    } else {
        $result["errors"] = "user is not an admin";
    }
} else {
    $result["errors"] = "no variable passed";
}

echo json_encode($result);