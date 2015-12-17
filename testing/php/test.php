<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 17/12/2015
 * Time: 12:39
 */

function multiexplode ($delimiters,$string) {
    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

echo "hello world";
$str = "elo;Cos;reawfew;23rwefwe,SDFfdwfWE";
echo "<br>";
$arr = multiexplode(array(";", ","), $str);
var_dump($arr);