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
    if (is_array($meta)) {
        foreach ($meta as $m) {
            echo addAsset("m", $m);
        }
    }
    // add title
    echo "\t<title>" . $title . "</title>\n";
    // add css
    if (is_array($css)) {
        foreach ($css as $c) {
            echo addAsset("c", $c);
        }
    }
    // add javascript
    if (is_array($js)) {
        foreach ($js as $s) {
            echo addAsset("j", $s);
        }
    }
    echo "</head>";
}

/**
 * Function used to render assets html links for metatag, css and javascript files
 * @param string $type "m" - metatag; "c" - css; "j" - javascript
 * @param string $pathToFile path to file, e.g.: "css/main.css"; in case of metatags this would be a metatag
 * @return string with correct asset
 */
function addAsset($type, $pathToFile) {
    $str = "\t";
    switch ($type) {
        case "m" :
            $str .= $pathToFile;
            break;
        case 'c' :
            $str .= "<link rel='stylesheet' href='" . $pathToFile . "'>";
            break;
        case 'j' :
            $str .= "<script type='text/javascript' src='" . $pathToFile . "'></script>";
            break;
    }
    $str .= "\n";
    return $str;
}

function renderMenu(){

}