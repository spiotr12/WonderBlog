<?php
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
//    "css/bootstrap-theme.min.css",
    "css/theme.min.css",
    "css/main.css",
    "css/index.css",
    "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"
);
$js = array(
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
    "js/main.js",
    "js/starRating.js"
);
renderHeader("WonderBlog! [testing2]", $meta, $css, $js);
?>
<body>

<?php
require_once("../resources/templates/menu.php");


//Gather adventures
$adventures = array();
$total_progress = 0;

$stmt = new mysqli_stmt($mysqli, "SELECT id, country, description FROM adventures WHERE id = ?");
if ($stmt) {
    $stmt->bind_param("i", $adventures['id']);
    if ($stmt->execute()) {
        $stmt->bind_result($id, $country, $city, $google_location, $description, $date);
        while ($stmt->fetch()) {
            $temp_arr = array(
                'id' => $id,
                'country' => $country,
                'description' => $description,
            );
            array_push($adventures, $temp_arr);
        }
    }
} else {
    echo "<h3>" . mysqli_error($mysqli) . "</h3>";
}

?>

    <div class="jumbotron">
        <div class="container">
            <h1>WanderBlog</h1>

            <p>The place to upload and explore adventures!</p>

            <div class="row">
                <div id="mainSearch">
                    <div class="input-group col-md-8 col-md-offset-2">
                        <input type="text" class="search-query form-control"
                               placeholder="Search for author or adventures"/>
                    </div>
                </div>
            </div>
            <div id="buttonGroup" class="row">
                <div id="searchAuthor" class="col-md-6">
                    <button type="button" class="btn btn-danger">Search Author</button>
                </div>
                <div id="searchAdventure" class="col-md-6">
                    <button type="button" class="btn btn-danger">Search Adventure</button>
                </div>
            </div>
        </div>
    </div>

    <div id="topAdventure" class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Top 5 Adventures</h1>
            </div>
        </div>
    </div>

<?php
foreach ($adventures as $stone) {
?>

<div id="top1" class="container">
    <div class="row">
        <div class="col-md-3">
            <img
                src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg"
                class="img-rounded" alt="Cinque Terre" width="250" height="228px">
        </div>
        <div class="col-md-9">
            <p> <?php echo $stone['description'] ?></p>

            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<?php
}
?>
</body>
</html>