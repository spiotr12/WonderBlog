<?php
/**
 * Created by PhpStorm.
 * User: 1307811
 * Date: 05/11/2015
 * Time: 12:12
 */

function redirectToHome(){
    //TODO check if can use __dir__
    header('Location: ./site/');
    die();
}