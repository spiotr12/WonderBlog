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
    "js/main.js"
);
renderHeader("WonderBlog! [testing]", $meta, $css, $js);
?>
<body>

<?php require_once("../resources/templates/menu.php"); ?>

<div class = "jumbotron">

    <div class = "container">
        <h1>Welcome to WanderBlog</h1>
        <p>The place to upload and explore adventures!</p>

        <p>
            <a class = "btn btn-primary btn-lg" role = "button">Learn more</a>
        </p>
    </div>
</div>

<div class = "container">
    <div class="row">
        <div class="col-md-12">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

</body>
</html>