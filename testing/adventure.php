<?php
require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
require_once("./php/db_connect.php");
//sec_session_start();
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
    "css/adventure.css"
);
$js = array(
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
    "js/main.js"
);
renderHeader("Adventure", $meta, $css, $js);
?>
<body>

<?php require_once("../resources/templates/menu.php"); ?>



<?php

$id = $_GET["id"];


// create a SQL query as a string
//$sql_query = "SELECT description FROM adventures WHERE id = $id";
// execute the SQL query
//$description = $mysqli->query($sql_query);

$stmt = new mysqli_stmt($mysqli, "SELECT description FROM adventures WHERE id = ?");

if ($stmt)   {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->bind_result($description);
        $stmt->store_result();
        if ($stmt->num_rows() == 1) {
            while ($stmt->fetch()) {


                ?>


                <div class="container">
                    <div class="row">
                        <h1 class="text-center">Adventure Title</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <img class="img-responsive" src="https://i.ytimg.com/vi/EOnqkApnvf8/maxresdefault.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1">
                            <h2>Description</h2>

                            <?php echo $description; ?>
                        </div>
                        <div class="col-md-3 col-md-offset-2 text-center">
                            <h2>Rating</h2>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>

                            <h2>Tags</h2>
                            <ul class="list-unstyled">
                                <li>
                                    #iLoveTags
                                </li>
                                <li>
                                    #mayTheForceBeWithYou
                                </li>
                                <li>
                                    #imGoingOnAnAdventure
                                </li>
                                <li>
                                    #youShallNotPass
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-md-offset-1 comments-section">
                            <h2>Comments</h2>
                            <?php for ($i = 0; $i < 4; $i++): ?>
                                <section>
                                    <div class="">
                                        <label class="">Piotrek</label>
                                        <label class="pull-right">2015-12-01</label>
                                    </div>

                                    <div class="comment">ahfkjbfkjbasfkjbewak bkjfb ksbbf labfeab jehbf aljbfhbfksbf sk
                                        djbf
                                        dksjgoewrihg
                                        dkjsng d
                                    </div>
                                </section>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="carousel slide article-slide" id="adventureCarousel">
                                <div class="carousel-inner cont-slider">
                                    <?php $carouselRuns = 3 ?>
                                    <?php for ($i = 0; $i < $carouselRuns; $i++): ?>
                                        <div class="item <?php if ($i == 0) echo "active"; ?>">
                                            <img src="http://placehold.it/1200x440/cccccc/ffffff">
                                        </div>
                                        <div class="item">
                                            <img src="http://placehold.it/1200x440/999999/cccccc">
                                        </div>
                                    <?php endfor; ?>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#adventureCarousel" role="button"
                                   data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#adventureCarousel" role="button"
                                   data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>

                                <!-- Indicators -->
                                <ol class="carousel-indicators visible-lg visible-md">
                                    <?php for ($i = 0; $i < $carouselRuns; $i++): ?>
                                        <li class="<?php if ($i == 0) echo "active"; ?>"
                                            data-slide-to="<?php echo 2 * $i; ?>"
                                            data-target="#adventureCarousel">
                                            <img alt="" title="" src="http://placehold.it/120x44/cccccc/ffffff">
                                        </li>
                                        <li class="" data-slide-to="<?php echo 2 * $i + 1; ?>"
                                            data-target="#adventureCarousel">
                                            <img alt="" title="" src="http://placehold.it/120x44/999999/cccccc">
                                        </li>
                                    <?php endfor; ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $('#adventureCarousel').carousel({
                        interval: 4000
                    });
                </script>

                <?php
            }
        }
    }
}
?>

</body>
</html>