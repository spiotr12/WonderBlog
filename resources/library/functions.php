<?php
/**
 * Created by PhpStorm.
 * User: 1307811
 * Date: 05/11/2015
 * Time: 12:12
 */
function redirectToHome() {
    header('Location: ./site');
    die();
}

/**
 * Starcts cecure session
 */
function sec_session_start() {
    $secure = TRUE;
    // This stops JavaScript being able to access the session id.
    $httponly = TRUE;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookiesParams = session_get_cookie_params();
    session_set_cookie_params($cookiesParams["lifetime"], $cookiesParams["path"], $cookiesParams["domain"], $secure, $httponly);
    // Sets the session name to the one set above.
    session_name("sec_sess_rewdt");
    session_start();
}

function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible.
    $stmt = $mysqli->prepare("SELECT id, password, salt FROM administrators WHERE email = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('s', $email); // Bind "$email" to parameter.
        $stmt->execute(); // Execite query
        $stmt->store_result();

        // get variables from result.
        $stmt->bind_result($user_ids, $db_password, $salt);
        $stmt->fetch();

        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If user exists checks if the account is locked (from too many login attempts)
            if (checkbrute($user_id, $mysqli) == TRUE) {
                // Account is locked
                return FALSE;
            } else {
                // Check if the password match with the password from db
                if ($db_password == $password) {
                    // Password is correct!
                    // get the user agent string of the user
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];

                    // XSS protection as we might printing this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['admin_id'] = $user_id;

                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    // Login successful.
                    return TRUE;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    echo "password incorrect - login attempt added";
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(administrator_id, time) VALUES ('$user_id', '$now')");
                    echo mysqli_error($mysqli);
                    return FALSE;
                }
            }
        } else {
            // No user exists.
            return FALSE;
        }
    }
}

/**
 * Checks if the account is locked due to too many login attempts within last hour
 *
 * @param type $admin_id
 * @param type $mysqli
 * @return boolean
 */
function checkbrute($admin_id, $mysqli) {
    // Get timestamp of current time
    $now = time();
    // All login attempts are counted from the past 1 hours.
    $valid_attempts = $now - (1 * 60 * 60);
    $stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE administrator_id = ? AND time > '$valid_attempts'");
    if ($stmt) {
        $stmt->bind_param('i', $admin_id);

        // Execute prepared query
        $stmt->execute();
        $stmt->store_result();

        // If there have been more than 5 failed logins
        if ($stmt->num_rows > 5) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/**
 * Checks the login user
 *
 * @param type $mysqli
 * @return boolean
 */
function login_check($mysqli) {
    // Check if all session variables are set
    if (isset($_SESSION['admin_id'], $_SESSION['login_string'])) {
        $admin_id = $_SESSION['admin_id'];
        $login_string = $_SESSION['login_string'];

        // Get the user-agent string of the user
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        $stmt = $mysqli->prepare("SELECT password FROM administrators WHERE id = ? LIMIT 1");
        if ($stmt) {
            // Bind "$admin_id" to parameter.
            $stmt->bind_param('i', $admin_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) {
                    // Logged in!
//					echo "<h1>Zalogowany</h1>";
                    return TRUE;
                } else {
//					echo "<h3>Login check does not match</h3>";
                    return FALSE;
                }
            } else {
//				echo "<h3>More then 1 user</h3>";
                return FALSE;
            }
        } else {
            // Not logged in
//			echo "<h3>No user</h3>";
            return FALSE;
        }
    } else {
        // Not logged in
//		echo "<h3>Variables not set</h3>";
        return FALSE;
    }
}