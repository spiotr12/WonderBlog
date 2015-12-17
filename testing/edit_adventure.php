<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");


$adventureName = $_POST["adventureName"];
$country = $_POST["country"];
$city = $_POST["city"];
$description = $_POST["description"];;
$adventure_id = $_POST["adventureID"];



$stmt = new mysqli_stmt ($mysqli, "UPDATE adventures
       SET name = ?, country = ?, city = ?, description = ? WHERE id= ?");

if ($stmt) {
    $stmt->bind_param("ssssi", $adventureName, $country, $city, $description, $adventure_id);
    $stmt->execute();


}

if($adventure_id != -1) {
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
        $stmt = new mysqli_stmt($mysqli, "INSERT INTO photos (user_id, adv_id, file_ext, date) VALUES (?, ?, ?, ?) ");
        $success = FALSE;
        if ($stmt) {
            $stmt->bind_param("iiss", $userID, $adventure_id, $ext, $dateNow);
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

$mysqli->close();
$str = 'Location:  ./adventure.php?id=' . $adventure_id;
header($str);
?>