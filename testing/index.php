<?php
require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
require_once(LIBRARY_PATH . "/functions.php");
require_once("./php/db_connect.php");

session_name("sec_sess_rewdt");
session_start();
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


$teste =  "<h1>logged in?:";
if(login_check($mysqli)){
    $teste .= "TRUE";
} else {
    $teste .= "FALSE";
}
$teste .= "</h1>";
echo $teste;


//Gather adventures
$adventures = array();
$total_progress = 0;

$stmt = new mysqli_stmt($mysqli, "SELECT id, country, city, google_location, description, date FROM adventures WHERE id = ? ORDER BY date");
if ($stmt) {
    $stmt->bind_param("i", $adventures['id']);
    if ($stmt->execute()) {
        $stmt->bind_result($id, $country, $city,  $google_location, $description, $date);
        while ($stmt->fetch()) {
            $temp_arr = array(
                'id' => $id,
                'country' => $country,
                'city' => $city,
                'google_location' => $google_location,
                'description' => $description,
                'date' => date("d/m/y", strtotime($date)),
            );
            array_push($adventures, $temp_arr);
        }
    }
} else {
    echo "<h3>" . mysqli_error($mysqli) . "</h3>";
}
?>

        <?php
//Print adventure
        $ms_total = $total_progress;
        foreach ($adventures as $stone) {
            $ms_total -= $stone['progress'];
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

            <div id="top1" class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img
                            src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg"
                            class="img-rounded" alt="Cinque Terre"
                            width="304px" height="228px">
                    </div>
                    <div class="col-md-8">
                        <h2><?php echo $stone['description']; ?></h2>

                        <div class="rating-select">
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                        </div>
                        <a class="btn btn-info" href="#" role="button">View details &raquo;</a>
                    </div>
                </div>
            </div>

            <div id="top2" class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img
                            src="http://topwalls.net/wallpapers/2012/01/Nature-sea-scenery-travel-photography-image-800x1280.jpg"
                            class="img-rounded" alt="Cinque Terre" width="304px"
                            height="228px">
                    </div>
                    <div class="col-md-8">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                            tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>

                        <div class="rating-select">
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                        </div>
                        <p><a class="btn btn-info" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
            </div>

            <div id="top1" class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img
                            src="http://77wallpapers.com/wp-content/uploads/2014/10/tropical-waterfall-scenery-wide.jpg"
                            class="img-rounded" alt="Cinque Terre" width="304px" height="228px">
                    </div>
                    <div class="col-md-8">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                            tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>

                        <div class="rating-select">
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                        </div>
                        <p><a class="btn btn-info" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
            </div>

            <div id="top2" class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="http://upload.wikimedia.org/wikipedia/commons/6/68/Soufriere_Hills.jpg"
                             class="img-rounded" alt="Cinque Terre" width="304px" height="228px">
                    </div>
                    <div class="col-md-8">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                            tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>

                        <div class="rating-select">
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                        </div>
                        <p><a class="btn btn-info" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
            </div>

            <div id="top3" class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img
                            src="https://upload.wikimedia.org/wikipedia/commons/b/bf/Mt._Everest_from_Gokyo_Ri_November_5,_2012_Cropped.jpg"
                            class="img-rounded" alt="Cinque Terre"
                            width="304px" height="228px">
                    </div>
                    <div class="col-md-8">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo,
                            tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                            Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>

                        <div class="rating-select">
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div class="btn btn-default btn-sm"><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                        </div>
                        <p><a class="btn btn-info" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
            </div>
            <?php
        }
            ?>
            </body>
            </html>