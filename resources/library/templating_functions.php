<?php
/**
 * Created by PhpStorm.
 * User: Piotrek
 * Date: 2015-11-08
 * Time: 18:53
 */

require_once(realpath(dirname(__FILE__) . "/../config.php"));

/**
 * Render header. It gives a change to add extra metatags, css, javascript and set title
 * @param string $title title to display
 * @param string $meta an array of meta tags
 * @param string $css an array of css paths
 * @param string $js an array of javascript paths
 */
function renderHeader($title, $meta, $css, $js) {
    echo "<head>\n";
    // add metatags
    foreach ($meta as $m) {
        echo addAsset("m", $m);
    }
    // add title
    echo "\t<title>" . $title . "</title>\n";
    // add css
    foreach ($css as $c) {
        echo addAsset("c", $c);
    }
    // add javascript
    foreach ($js as $s) {
        echo addAsset("j", $s);
    }
    echo "</head>";
}

/**
 * Function used to render assets html links for metatag, css and javascript files
 * @param string $type "m" - metatag; "c" - css; "j" - javascript
 * @param string $pathToFile path to file, e.g.: "css/main.css"; in case of metatags this would be a metatag
 */
function addAsset($type, $pathToFile) {
    switch ($type) {
        case "m" :
            echo "\t" . $pathToFile . "\n";
            break;
        case 'c' :
            echo "\t<link rel='stylesheet' href='" . $pathToFile . "'>\n";
            break;
        case 'j' :
            echo "\t<script type='text/javascript' src='" . $pathToFile . "'></script>\n";
            break;
    }
}