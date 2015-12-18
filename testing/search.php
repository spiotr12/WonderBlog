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
        $search = $mysqli->real_escape_string($_GET["q"]);
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
                <h1>Advance search</h1>
                <form name="advanceSearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="text" name="q" value="<?php echo $_GET["q"]; ?>">
                    <!--                    <input type="number" name="q" value="--><?php //echo $_GET["q"]; ?><!--">-->
                    <br>
                    <label><input type="radio" name="search_type_adv" value="name" checked> by name</label>
                    <br>
                    <label><input type="radio" name="search_type_adv" value="country"> by country</label>
                    <br>
                    <label><input type="radio" name="search_type_adv" value="author"> by author</label>
                    <br>
                    <label><input type="radio" name="search_type_adv" value="keyword"> by keyword</label>
                    <br>
                    <label><input type="radio" name="search_type_adv" value="votes"> by minimum voting score</label>
                    <br>
                    <button class="btn, btn-success" type="submit">Search advance!</button>
                </form>
            </div>
            <div class="col-md-12">
                <h1>Search results:</h1>
                <?php
                $search_results = array(
                    "type" => $search_type,
                    "data" => array()
                );
                $stmt = null;
                if ($search_type == "adventure" || (isset($_GET['search_type_adv']) && count($_GET['search_type_adv']) == 0)) {
                    $search = "%" . $search . "%";
                    $query = "SELECT A.id, A.name, U.first_name, U.last_name
                        FROM adventures A, users U
                        WHERE A.user_id = U.id
                        AND (A.name LIKE ?
                          OR A.description LIKE ?
                          OR A.keywords LIKE ?
                          OR first_name LIKE ?
                          OR last_name LIKE ?) ";
                    $stmt = new mysqli_stmt($mysqli, $query);
                    if ($stmt) {
                        $stmt->bind_param("sssss", $search, $search, $search, $search, $search);
                        $stmt->execute();
                        $stmt->bind_result($id, $name, $f, $l);
                        while ($stmt->fetch()) {
                            $search_results["data"][] = array(
                                "id" => $id,
                                "name" => $name . " by  <i>$f $l</i>"
                            );
                        }
                    }
                } else if ($search_type == "author") {
                    $search = "%" . $search . "%";
                    $stmt = new mysqli_stmt($mysqli, "SELECT id, first_name, last_name FROM users WHERE privilege < ? AND (first_name LIKE ? OR last_name LIKE ?)");
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
                } else {
                    if (isset($_GET['search_type_adv'])) {
                        $query = "";
                        $bindType = "";
                        switch ($_GET['search_type_adv']) {
                            case "name":
                                $query = "SELECT A.id, A.name FROM adventures A WHERE name LIKE ?";
                                $bindType = 's';
                                $search = "%" . $search . "%";
                                break;
                            case "country":
                                $query = "SELECT A.id, A.name FROM adventures A WHERE country LIKE ?";
                                $bindType = 's';
                                $search = "%" . $search . "%";
                                break;
                            case "keyword":
                                $query = "SELECT A.id, A.name FROM adventures A WHERE keywords LIKE ?";
                                $bindType = 's';
                                $search = "%" . $search . "%";
                                break;
                            case "author":
                                $query = "SELECT A.id, A.name FROM adventures A, users U WHERE A.user_id = U.id AND (CONCAT(first_name, ' ', last_name) LIKE ?)";
                                $bindType = 's';
                                $search = "%" . $search . "%";
                                break;
                            case "votes":
                                $query = "SELECT a.id, a.name
                                          FROM adventures a
                                          LEFT JOIN (
                                              SELECT id, COUNT(*) as rate, v.date
                                              FROM adventures a, votes v
                                              WHERE a.id = v.adv_id GROUP BY id
                                          ) v
                                          ON a.id = v.id
                                          WHERE (IFNULL(v.rate,0)+a.admin_vote) >= ?";
                                $bindType = 'i';
                                $search = (int)$search;
                                break;
                        }
                        $stmt = new mysqli_stmt($mysqli, $query);
                        if ($stmt->bind_param($bindType, $search)) {
                            $stmt->execute();
                            $stmt->bind_result($id, $name);
                            while ($stmt->fetch()) {
                                $search_results["data"][] = array(
                                    "id" => $id,
                                    "name" => $name
                                );
                            }
                        }
                    }
                }

                // PRINT SEARCH RESULTS
                echo "<ul class='list-group'>";
                foreach ($search_results["data"] as $key => $val):
                    ?>
                    <li>
                        <a href="./<?php echo $search_results["type"] . ".php?id=" . $val['id']; ?>">
                            <?php echo $val['name'] ?>
                        </a>
                    </li>
                    <?php
                endforeach;
                echo "</ul>";
                ?>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php $mysqli->close(); ?>