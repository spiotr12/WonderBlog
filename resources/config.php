<?php
/**
 * Created by PhpStorm.
 * User: Piotr Starzec
 * MatriNo: 1307811
 * Date: 05/11/2015
 * Time: 11:36
 */

//echo "hello I'm config file";

$config = array(
    "db" => array(
        "dbname" => "db1307811",
        "username" => "b3921827c06692",
        "password" => "c5550580",
        "host" => "eu-cdbr-azure-west-c.cloudapp.net"
    ),
    "urls" => array(
        "baseUrl" => "http://wonderblog.azurewebsites.net"
    )
);

defined("LIBRARY_PATH") OR define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));

defined("TEMPLATES_PATH") OR define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

date_default_timezone_set("Europe/London");