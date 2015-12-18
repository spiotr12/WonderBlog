<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 17/12/2015
 * Time: 12:39
 */

require_once("../../resources/config.php");


$dir = "../img/contents/";
$scan = scandir($dir);
foreach($scan as $s){
    print_r($s);
    echo "<br>";
}

//SELECT a.id, a.name, a.description, rate.total_rate
//FROM adventures A, votes V, (
//    SELECT a.id, (IFNULL(v.rate,0)+a.admin_vote) as total_rate
//    FROM adventures a
//    LEFT JOIN (
//        SELECT id, COUNT(*) as rate, v.date
//        FROM adventures a, votes v
//        WHERE a.id = v.adv_id
//        GROUP BY id
//    ) v
//    ON a.id = v.id
//) rate
//WHERE a.id = rate.id
//ORDER BY rate.total_rate
//DESC LIMIT 5