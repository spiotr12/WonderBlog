<?php

require_once("../resources/config.php");
require_once("./php/db_connect.php");


$firstName = $_POST["firstName"];
$secondName = $_POST["secondName"];
$description = $_POST["description"];
$dob = $_POST["dob"];
$country = $_POST["country"];
$user_id = $_POST["userID"];


$stmt = new mysqli_stmt ($mysqli, "UPDATE users
        SET first_name = ?, last_name = ?, description = ?, country = ?, dob = ? WHERE id= ?");

if ($stmt) {
    $stmt->bind_param("sssssi", $firstName, $secondName, $description, $country, $dob, $user_id);
    $stmt->execute();


}

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

    $dateNow = date("Y-m-d H:i:s");
    $success = FALSE;


    // On this example, obtain safe unique name from its binary data.

    if (!move_uploaded_file($photoFile['tmp_name'], sprintf('./img/profile/%s.%s', $user_id, $ext))) {
        throw new RuntimeException('Failed to move uploaded file.');
    } else {
        $stmt = new mysqli_stmt($mysqli, "UPDATE users SET file_ext = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("si", $ext, $user_id);
            $stmt->execute();
        }
    }

    echo 'File is uploaded successfully.';

} catch (RuntimeException $e) {

    echo $e->getMessage();


}
//$str = 'Location:  ./author.php?id=' . $user_id;
//header($str);
//?>