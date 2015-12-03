<?php

require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
require_once("./php/db_connect.php");

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


<?php require_once("../resources/templates/menu.php"); ?>

<?php
$id = 31;
$stmt = new mysqli_stmt($mysqli, "SELECT first_name, last_name, description, country, dob FROM users WHERE id = ?");
if ($stmt) {
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
$stmt->bind_result($first_name, $last_name, $description, $country, $dob);
$stmt->store_result();
if ($stmt->num_rows() == 1) {
while ($stmt->fetch()) {

?>
<body>
<div class="container">
    <div class="row">

        <div id="Author" class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div id="AuthorPic" class="col-md-3">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Michelle-Borromeo-Actor-Headshots-Vancouver-BC20110408_0030.jpg"
                        class="img-rounded" alt="Mountain View" style="width:250px; height:260px;">
                </div>
                <div class="col-md-9">
                    <h2><?php echo $first_name . " " . $last_name; ?></h2>

                    <p>Date of Birth: <?php echo $dob?></p>

                    <p>Country: <?php echo $country ?></p>

                    <p>Adventures: <?php $number = ("SELECT COUNT(user_id) AS adventureNumber FROM adventures WHERE user_id = $id ");

                        echo $number;

                        ?> </p>


                    <p>Memeber Since: 01/10/15 </p>

                    <p><?php echo $description; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="Contributions" class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Contributions </h2>
        </div>
    </div>
</div>

<div id="top1" class="container">
    <div class="row">
        <div class="col-md-3">
            <img
                src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg"
                class="img-rounded" alt="Cinque Terre" width="250" height="228px">
        </div>
        <div class="col-md-9">
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui. </p>

            <p>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star"></span></p>

            <p>

            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<div id="top1" class="container">
    <div class="row">
        <div class="col-md-3">
            <img
                src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg"
                class="img-rounded" alt="Cinque Terre" width="250" height="228px">
        </div>
        <div class="col-md-9">
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui. </p>

            <p>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
            </p>

            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<div id="top1" class="container">
    <div class="row">
        <div class="col-md-3">
            <img
                src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg"
                class="img-rounded" alt="Cinque Terre" width="250" height="228px">
        </div>
        <div class="col-md-9">
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui. </p>

            <p>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
            </p>

            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<div id="top1" class="container">
    <div class="row">
        <div class="col-md-3">
            <img
                src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg"
                class="img-rounded" alt="Cinque Terre" width="250" height="228px">
        </div>
        <div class="col-md-9">
            <p>Do at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condiment. Fusce dapibus, tellus
                ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo Donec id elit non mi porta
                gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
                fermentum massa justo Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus
                commodo, tortor mauris condimentum nibh, ut fermentum massa justo Donec id elit non mi porta gravida at
                eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa
                justo Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo . </p>

            <p>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span></p>

            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<div id="top1" class="container">
    <div class="row">
        <div class="col-md-3">
            <img
                src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg"
                class="img-rounded" alt="Cinque Terre" width="250" height="228px">
        </div>
        <div class="col-md-9">
            <p>Donec id elit non mi porta gr avida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui. </p>

            <p>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star" style="color:gold"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span></p>

            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
</div>

<?php
}
}
}
}

?>


</body>
</html>