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
        <div id="test" class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <img src="http://i.telegraph.co.uk/multimedia/archive/02625/mountain1_2625884k.jpg" alt="Mountain View" style="width:304px;height:228px;">
                </div>
                <div class="col-md-8">
                    <h2>Author Name</h2>
                    <p>Donec id elit non  mi portvid a at ege t metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
                </div>
            </div>

            <div id = "authorText" class = "container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Donec id elit non mi onec id elit non mi porta gravida at eget metus. Fusce daonec id elit non mi porta gravida at eget metus. Fusce daonec id elit non mi porta gravida at eget metus. Fusce daonec id elit non mi porta gravida at eget metus. Fusce daonec id elit non mi porta gravida at eget metus. Fusce daonec id elit non mi porta gravida at eget metus. Fusce daonec id elit non mi porta gravida at eget metus. Fusce daonec id elit non mi porta gravida at eget metus. Fusce daonec id elit non mi porta gravida at eget metus. Fusce daporta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
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
                    <div class="col-md-4">
                        <img src="http://upload.wikimedia.org/wikipedia/commons/6/68/Soufriere_Hills.jpg" class="img-rounded" alt="Cinque Terre" width = "304px" height = "228px">
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


</body>
</html>