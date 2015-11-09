<?php
require_once("./resources/config.php");
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
    "css/bootstrap-theme.min.css",
    "css/main.css"
);
$js = array(
    "js/main.js"
);
renderHeader("WonderBlog!", $meta, $css, $js);
?>
<body>

<?php require_once("./resources/templates/menu.php"); ?>

<div class="container">
    <div class="row">
        <h1>Hello world!</h1>
    </div>
</div>
</body>
</html>