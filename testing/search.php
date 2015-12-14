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
if (isset($_GET["q"])) {
    $search = $_GET["q"];
}
$search_type = "";
if (isset($_GET["$search_type"])) {
    $search_type = $_GET["$search_type"];
}

renderHeader("Search: " . $search, $meta, $css, $js);
?>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $search_results = array(
                "type" => $search_type
            );
            $stmt = null;
            if ($search_type == "adventures") {
                $stmt = new mysqli_stmt($mysqli, "SELECT * FROM adventures WHERE name LIKE ?");
                if ($stmt) {
                    $stmt->bind_param("s", $search);
                    $stmt->execute();
                    $results = $stmt->get_result();
                    $search_results["data"] = $results->fetch_array();
                }
            } else if ($search_type == "authors") {
                $stmt = new mysqli_stmt($mysqli, "SELECT * FROM authors WHERE privilege = ? AND first_name LIKE ? OR last_name LIKE ?");
                if ($stmt) {
                    $priv = 1;
                    $stmt->bind_param("iss", $priv, $search, $search);
                    $stmt->execute();
                    $results = $stmt->get_result();
                    $search_results["data"] = $results->fetch_array();
                }
            }

            echo $search_results["type"];
            echo "<br>";
            var_dump($_GET);
            echo "<br>";
            var_dump($search_results);
            ?>
        </div>
    </div>
</div>
</body>
</html>