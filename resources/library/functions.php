<?php
/**
 * Created by PhpStorm.
 * User: 1307811
 * Date: 05/11/2015
 * Time: 12:12
 */
function redirectToHome() {
    header('Location: ./testing');
    die();
}

/**
 * Returns the privilege of the given user (id)
 *
 * @param mysqli $mysqli
 * @param int $id id of the user
 * @return int int privilege of the user
 */
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

function showPotentialErrors($object){
    if (isset($object)) {
        if ($object->errors) {
            foreach ($object->errors as $error) {
                echo $error;
            }
        }
        if ($object->messages) {
            foreach ($object->messages as $message) {
                echo $message;
            }
        }
    }
}

/**
 * Compares adventure ID and author ID to see if the adventure was created by that author
 *
 * @param $mysqli
 * @param $authorId
 * @param $adventureId
 * @return bool
 */
function isOwner($mysqli, $authorId, $adventureId){
    $stmt = new mysqli_stmt($mysqli, "SELECT user_id FROM adventures WHERE id = ?");
    if($stmt){
        $stmt->bind_param('i', $adventureId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_object();
        if($authorId == $result->user_id){
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}


/**
 * Function that explode string into array using multiple delimiters
 *
 * @param String[] $delimiters array of delimiters
 * @param $string
 * @return array
 */
function multiexplode ($delimiters, $string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function isUserVerified($mysqli, $userID){
    $stmt = new mysqli_stmt($mysqli, "SELECT verified FROM users WHERE id = ?");
    if($stmt){
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_object();
        if($result->verified == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}