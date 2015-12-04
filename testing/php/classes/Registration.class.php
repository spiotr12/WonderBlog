<?php

/**
 * Created by PhpStorm.
 * User: 1307811
 * Date: 04/12/2015
 * Time: 12:12
 */

require_once(realpath(dirname(__FILE__) . "../../../resources/config.php"));

class Registration {

    private $db_connection = null;

    public $errors = array();

    public $messages = array();

    public function __construct() {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        } else {
            $this->errors[] = "No post 'register'";
        }
    }

    private function registerNewUser() {
        if (empty($_POST['email'])) {
            $this->errors[] = "Empty Username";
        } else if ($_POST['password'] !== $_POST['password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
        } else {
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {
                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_first_name = $this->db_connection->real_escape_string(strip_tags($_POST['fname'], ENT_QUOTES));
                $user_last_name = $this->db_connection->real_escape_string(strip_tags($_POST['lname'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['email'], ENT_QUOTES));

                $user_password = $_POST['password'];

                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, that username / email address is already taken.";
                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO users (first_name, last_name, password, email)
                            VALUES('" . $user_first_name . "', '" . $user_last_name . "', '" . $user_password_hash . "', '" . $user_email . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }

            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
        }
    }
}