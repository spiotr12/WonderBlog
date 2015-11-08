<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 2015-11-08
 * Time: 18:53
 */

require_once(realpath(dirname(__FILE__) . "/../config.php"));

function renderHeader($metatags, $title) {
    //TODO add css, js, and change meta tags
    echo "<head>\n
        \t<meta charset='UTF-8'>\n
        \t<meta http-equiv='X-UA-Compatible' content='IE=edge'>\n
        \t<meta name='viewport' content='width=device-width, initial-scale=1'>\n";
    echo $metatags;
    echo "\t<title>" . $title . "</title>\n";
    echo "</head>";
}