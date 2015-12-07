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
            return true;
        }
        // default return
        return false;
    }
}