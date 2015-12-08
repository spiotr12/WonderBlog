<?php

/**
 * Created by PhpStorm.
 * User: 1307811
 * Date: 07/12/2015
 * Time: 14:34
 */

require_once(realpath(dirname(__FILE__) . "../../../resources/config.php"));


class Login {
    private $db_connection = null;

    public $errors = array();

    public $messages = array();

    public function __construct() {
        // create/read session, absolutely necessary
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        } // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    private function doLoginWithPostData() {
        // check login form contents
        if (empty($_POST['email'])) {
            $this->errors[] = "Email field was empty.";
        } else if (empty($_POST['password'])) {
            $this->errors[] = "Password field was empty.";
        } else if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {
                // escape the POST stuff
                $email = $this->db_connection->real_escape_string($_POST['email']);

                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                //TODO change it to prepared statement
                $sql = "SELECT id, first_name, last_name, email, password, privileges
                        FROM users
                        WHERE email = '" . $email . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1) {

                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['password'], $result_row->password)) {

                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['id'] = $result_row->id;
                        $_SESSION['first_name'] = $result_row->first_name;
                        $_SESSION['last_name'] = $result_row->last_name;
                        $_SESSION['email'] = $result_row->email;
                        $_SESSION['privileges'] = $result_row->privileges;
                        $_SESSION['user_login_status'] = 1;

                        $this->messages[] = "You have logged in successfully!";
                    } else {
                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    $this->errors[] = "This user does not exist.";
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout() {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "You have been logged out.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn() {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
//            $this->messages[] = "You have logged out successfully!";
            return true;
        }
        // default return
        return false;
    }

}