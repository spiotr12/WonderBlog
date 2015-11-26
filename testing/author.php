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
    "css/author.css"
);
$js = array(
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
    "js/main.js"
);
renderHeader("WonderBlog!", $meta, $css, $js);
?>
<body>

<?php require_once("../resources/templates/menu.php"); ?>

<div class="container">
    <div class="row">
        <body>
        <div id="Author" class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div id="AuthorPic" class="col-md-3">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Michelle-Borromeo-Actor-Headshots-Vancouver-BC20110408_0030.jpg" class="img-rounded" alt="Mountain View" style="width:250px;height:228px;">
                </div>
                <div class="col-md-9">
                    <h2>Author Name</h2>
                    <p>Age: 21</p>
                    <p>Country: Scotland</p>
                    <p>Adventures: 5 </p>
                    <p>Memeber Since: 01/10/15 </p>
                    <p>About Me: id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna moid elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mo </p>
                </div>
            </div>
        </div>
    </div>
</div>


            <div id = "Contributions" class = "container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Contributions </h2>
                    </div>
                </div>
            </div>

            <div id = "top4" class = "container">
                <div class="row">
                    <div class="col-md-2">
                        <img src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg" class="img-rounded" alt="Cinque Terre" width = "204px" height = "128px">
                    </div>
                    <div class="col-md-10">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
            </div>

            <div id = "top4" class = "container">
                <div class="row">
                    <div class="col-md-2">
                        <img src="http://topwalls.net/wallpapers/2012/01/Nature-sea-scenery-travel-photography-image-800x1280.jpg" class="img-rounded" alt="Cinque Terre" width = "204px" height = "128px">
                    </div>
                    <div class="col-md-10">
                        <p>Donec id elit non mi porta grav  ida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
            </div>

            <div id = "top4" class = "container">
                <div class="row">
                    <div class="col-md-2">
                        <img src="http://77wallpapers.com/wp-content/uploads/2014/10/tropical-waterfall-scenery-wide.jpg" class="img-rounded" alt="Cinque Terre" width = "204px" height = "128px">
                    </div>
                    <div class="col-md-10">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
            </div>

            <div id = "top4" class = "container">
                <div class="row">
                    <div class="col-md-2">
                        <img src="http://upload.wikimedia.org/wikipedia/commons/6/68/Soufriere_Hills.jpg" class="img-rounded" alt="Cinque Terre" width = "204px" height = "128px">
                    </div>
                    <div class="col-md-10">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
            </div>


</body>
</html>