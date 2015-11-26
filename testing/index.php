<?php
require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
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
    "css/index.css"
);
$js = array(
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
    "js/main.js",
);
renderHeader("WonderBlog! [testing]", $meta, $css, $js);
?>
<body>

<?php require_once("../resources/templates/menu.php"); ?>

<div class = "jumbotron">

    <div class = "container">
        <h1>Welcome to WanderBlog</h1>
        <p>The place to upload and explore adventures!</p>
        <div class="row">
            <h2>Search for Adventures and Authors</h2>
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="  search-query form-control" placeholder="Search" />
                </div>
            </div>
        </div>
    </div>
</div>

<div id = "topAdventure" class = "container">
    <div class="row">
        <div class="col-md-12">
            <h1>Top 5 Adventures</h1>
        </div>
    </div>
</div>

<div id = "top1" class = "container">
    <div class="row">
        <div class="col-md-4">
            <img src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg" class="img-rounded" alt="Cinque Terre" width = "304px" height = "228px">
        </div>
        <div class="col-md-8">
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<div id = "top2" class = "container">
    <div class="row">
        <div class="col-md-4">
            <img src="http://topwalls.net/wallpapers/2012/01/Nature-sea-scenery-travel-photography-image-800x1280.jpg" class="img-rounded" alt="Cinque Terre" width = "304px" height = "228px">
        </div>
        <div class="col-md-8">
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<div id = "top3" class = "container">
    <div class="row">
        <div class="col-md-4">
            <img src="http://77wallpapers.com/wp-content/uploads/2014/10/tropical-waterfall-scenery-wide.jpg" class="img-rounded" alt="Cinque Terre" width = "304px" height = "228px">
        </div>
        <div class="col-md-8">
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<div id = "top4" class = "container">
    <div class="row">
        <div class="col-md-4">
            <img src="http://upload.wikimedia.org/wikipedia/commons/6/68/Soufriere_Hills.jpg" class="img-rounded" alt="Cinque Terre" width = "304px" height = "228px">
        </div>
        <div class="col-md-8">
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<div id = "top5" class = "container">
    <div class="row">
        <div class="col-md-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/bf/Mt._Everest_from_Gokyo_Ri_November_5,_2012_Cropped.jpg" class="img-rounded" alt="Cinque Terre" width = "304px" height = "228px">
        </div>
        <div class="col-md-8">
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>


</body>
</html>