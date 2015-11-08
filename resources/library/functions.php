<?php
/**
 * Created by PhpStorm.
 * User: 1307811
 * Date: 05/11/2015
 * Time: 12:12
 */

/**
 * Redirect straight to home page
 */
function redirectToHome() {
    header('Location: ./site/home.php');
    die();
}