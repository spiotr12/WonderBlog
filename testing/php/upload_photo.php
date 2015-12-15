<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 15/12/2015
 * Time: 11:21
 */

header('Content-Type: text/plain; charset=utf-8');

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
    if ($photoFile['size'] > 1000000) {
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

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $photoFile['tmp_name'],
        sprintf('./uploads/%s.%s',
            sha1_file($photoFile['tmp_name']),
            $ext
        )
    )
    ) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    echo 'File is uploaded successfully.';

} catch (RuntimeException $e) {

    echo $e->getMessage();

}
