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
if (isset($_GET["search_type"])) {
    $search_type = $_GET["search_type"];
}

renderHeader("Search: " . $search, $meta, $css, $js);
?>
<body>

<?php require_once("../resources/templates/menu.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $search = "%" . $search . "%";
            $search_results = array(
                "type" => $search_type,
                "data" => array()
            );
            $stmt = null;
            if ($search_type == "adventure") {
                $stmt = new mysqli_stmt($mysqli, "SELECT id, name FROM adventures WHERE name LIKE ? OR description LIKE ?");
                if ($stmt) {
                    $stmt->bind_param("ss", $search, $search);
                    $stmt->execute();
                    $stmt->bind_result($id, $name);
                    while ($stmt->fetch()) {
                        $search_results["data"][] = array(
                            "id" => $id,
                            "name" => $name
                        );
                    }
                }
            } else if ($search_type == "author") {
                $stmt = new mysqli_stmt($mysqli, "SELECT id, first_name, last_name FROM users WHERE privilege > ? AND first_name LIKE ? OR last_name LIKE ?");
                if ($stmt) {
                    $priv = 2;
                    $stmt->bind_param("iss", $priv, $search, $search);
                    $stmt->execute();
                    $stmt->bind_result($id, $fname, $lname);
                    while ($stmt->fetch()) {
                        $search_results["data"][] = array(
                            "id" => $id,
                            "name" => $fname . " " . $lname
                        );
                    }
                }
            }
            foreach ($search_results["data"] as $key => $val):
                ?>
                <a href="./<?php echo $search_results["type"] . ".php?id=" . $val['id']; ?>">
                    <?php echo $val['name'] ?>
                </a>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</div>
</body>
</html>
<?php $mysqli->close(); ?>