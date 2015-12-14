<?php
/**
 * Created by PhpStorm.
 * User: piotr
 * Date: 14/12/2015
 * Time: 11:22
 */
require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
require_once(LIBRARY_PATH . "/functions.php");
// TO ALLOW USERS TO LOGIN ON EACH PAGE PLEASE COPY THIS CODE
require_once("./php/db_connect.php");
require_once("./php/classes/Login.class.php");
$login = new Login();
// END OF LOGIN SCRIPT
?>
<!DOCTYPE html>
<html lang="en">
<?php
$meta = array(
    "<meta charset=\"UTF-8\">",
    "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">",
    "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">"
);
$css = array(
    "css/bootstrap.min.css",
    "css/theme.min.css",
    "css/main.css",
    "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"
);
$js = array(
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
    "js/main.js"
);

$search = "";
if(isset($_GET["q"])){
    $search = $_GET["q"];
}


renderHeader("Search: " . $search, $meta, $css, $js);
?>
<body>
<div class="container">
    <div class="row">

    </div>
</div>
</body>
</html>