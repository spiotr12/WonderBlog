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
    "js/main.js"
);
renderHeader("WonderBlog! [testing2]", $meta, $css, $js);
?>
<body>
<?php require_once("../resources/templates/menu.php"); ?>

<?php
//prepare rating and adventure

$adventures = array();
$total_progress = 0;
// adventure
$query = "SELECT a.id, a.name, a.description, rate.total_rate, p.id, p.file_ext
          FROM adventures a, photos p, (
              SELECT a.id, (IFNULL(v.rate,0)+a.admin_vote) as total_rate
              FROM adventures a
              LEFT JOIN (
                  SELECT id, COUNT(*) as rate, v.date
                  FROM adventures a, votes v
                  WHERE a.id = v.adv_id
                 GROUP BY id
              ) v
              ON a.id = v.id
          ) rate
          WHERE a.id = rate.id
          AND (p.adv_id = a.id
          AND p.is_cover = 1)
          ORDER BY rate.total_rate
          DESC LIMIT 5";
$stmtAdventure = new mysqli_stmt($mysqli, $query);
if ($stmtAdventure) {
    $stmtAdventure->execute();
    $stmtAdventure->bind_result($adventureID, $adventureName, $adventureDesc, $rate, $photoId, $photoExt);
    while ($stmtAdventure->fetch()) {
        $adventures[] = array(
            'adventureID' => $adventureID,
            'name' => $adventureName,
            'description' => $adventureDesc,
            'rate' => $rate,
            'photoId' => $photoId,
            'photoExt' => $photoExt
        );

    }
}

?>

<div class="jumbotron">
    <div class="container">
        <h1>WanderBlog</h1>

        <p>The place to upload and explore adventures!</p>

        <form class="navbar-form" role="search" method="get" action="./search.php">
            <div class="row">
                <div id="mainSearch">
                    <div class="input-group col-md-8 col-md-offset-2">
                        <input type="text" name="q"
                               class="search-query form-control"
                               placeholder="Search for author or adventures"/>
                    </div>
                </div>
            </div>
            <div id="buttonGroup" class="row">
                <div id="searchAuthor" class="col-md-6">
                    <button type="submit" name="search_type" value="author"
                            class="btn btn-danger">Search Author
                    </button>
                </div>
                <div id="searchAdventure" class="col-md-6">
                    <button type="submit" name="search_type" value="adventure"
                            class="btn btn-danger">Search Adventure
                    </button>
                </div>
            </div>
        </form>
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
foreach ($adventures as $adv) {
    ?>
    <div id="top1" class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="./img/contents/<?php echo $adv['photoId'] . "." . $adv['photoExt']; ?>" class="img-rounded"
                     width="250" height="228px">
            </div>
            <div class="col-md-9">
                <h4><?php echo $adv['name'] ?></h4>
                <p> <?php echo $adv['description']; ?></p>
                <p><?php echo $adv['rate']; ?></p>
                <p>
                    <a class="btn btn-default" href="./adventure.php?id=<?php echo $adv['adventureID']; ?>">View
                        details &raquo;</a>
                </p>
            </div>
        </div>
    </div>
    <?php
}
?>

</body>
</html>