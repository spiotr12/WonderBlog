<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");
require_once(LIBRARY_PATH . "/functions.php");


$adventureName = $mysqli->real_escape_string($_POST["adventureName"]);
$country = $mysqli->real_escape_string($_POST["country"]);
$city = $mysqli->real_escape_string($_POST["city"]);
$description = $mysqli->real_escape_string($_POST["description"]);
$date = date("Y-m-d H:i:s");
$userID = $_POST["userID"];
$keywords = $mysqli->real_escape_string($_POST["keywords"]);
$adventure_id = -1;
$stmt = new mysqli_stmt ($mysqli, "INSERT INTO adventures(user_id, name, country, city, description, date, keywords)
        VALUES(?,?,?,?,?,?,?)");
if ($stmt) {
    $stmt->bind_param("issssss", $userID, $adventureName, $country, $city, $description, $date, $keywords);
    $stmt->execute();
    $adventure_id = $stmt->insert_id;

}
if ($adventure_id != -1) {
    try {

        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (
            !isset($_FILES['photos']['error']) ||
            is_array($_FILES['photos']['error'])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }

        $photoFile = $_FILES['photos'];

        // Check $_FILES['upfile']['error'] value.
        switch ($photoFile['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }

        // You should also check filesize here.
        if ($photoFile['size'] > 5242880) {
            throw new RuntimeException('Exceeded filesize limit.');
        }

        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
                $finfo->file($photoFile['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )
        ) {
            throw new RuntimeException('Invalid file format.');
        }

        $id = -1;
        $dateNow = date("Y-m-d H:i:s");
        $stmt = new mysqli_stmt($mysqli, "INSERT INTO photos (user_id, adv_id, file_ext, date, is_cover) VALUES (?, ?, ?, ?, ?) ");
        $success = FALSE;
        if ($stmt) {
            $cov = 1;
            $stmt->bind_param("iissi", $userID, $adventure_id, $ext, $dateNow, $cov);
            if ($stmt->execute()) {
                $id = $stmt->insert_id;
                $success = TRUE;
            }
        }

        // On this example, obtain safe unique name from its binary data.
        if ($success) {
            if (!move_uploaded_file($photoFile['tmp_name'], sprintf('./img/contents/%s.%s', $id, $ext))) {
                throw new RuntimeException('Failed to move uploaded file.');
            }
        } else {
            echo "nothing inserted into db";
        }

        echo 'File is uploaded successfully.';

    } catch (RuntimeException $e) {

        echo $e->getMessage();

    }
}

if (privilegeCheck($mysqli, $userID) != 0) {
    $stmt = new mysqli_stmt($mysqli, "UPDATE users SET privilege = ? WHERE id = ? ");
    if ($stmt) {
        $priv = 1;
        $stmt->bind_param("ii", $priv, $userID);
        $stmt->execute();
    }
}

$str = 'Location:  ./adventure.php?id=' . $adventure_id;
header($str);



