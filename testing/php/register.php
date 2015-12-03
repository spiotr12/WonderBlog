<?php

/* 
 * File created by Piotr Starzec
 * Contact: starzec.piotr.12@gmail.com
 * I declare copyrights for all code written by myself, excluding any third party library used in this project
 */

require_once("../../resources/config.php");
require_once("./db_connect.php");


$error_msg = "";

if (isset($_POST['email'], $_POST['password'])) {
    // Sanitize and validate the data passed in
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    // check existing email
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
        }
        $stmt->close();
    } else {
        $error_msg .= '<p class="error">' . mysqli_error($mysqli) . '</p>';
        $stmt->close();
    }
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
    if (empty($error_msg)) {
//	if (false) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), true));

        // Create salted password
        $password = hash('sha512', $password . $random_salt);

        // Insert the new user into the database
        $insert_stmt = $mysqli->prepare("INSERT INTO users (first_name, last_name, email, password, salt) VALUES (?, ?, ?, ?, ?)");
        if ($insert_stmt) {
            $insert_stmt->bind_param('sssss', $fname, $lname, $email, $password, $random_salt);
            // Execute the prepared query.
            if (!$insert_stmt->execute()) {
                echo $error_msg . "<br/>" . mysqli_error($mysqli);
//				header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ../index.php');
//		echo "<h1>Register was successfull</h1>";
    }
}