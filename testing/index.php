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

$adventure = array();
$total_progress = 0;
// adventure
$stmtAdventure = new mysqli_stmt($mysqli, "SELECT a.id, a.description, v.adv_id, v.vote, p.file_ext, p.id, COUNT(vote) as rate FROM adventures A, votes V, photos P WHERE A.id = v.adv_id AND is_cover = 1 GROUP BY A.id ORDER BY v.vote DESC LIMIT 5");
if ($stmtAdventure) {
    if ($stmtAdventure->execute()) {
        $stmtAdventure->bind_result($adventureID, $adventureDesc, $voteAdvID, $vote, $photoExt, $photoID, $voteCount);
        while ($stmtAdventure->fetch()) {
            $temp_arr = array(
                'adventureID' => $adventureID,
                'description' => $adventureDesc,
                'voteAdvID' => $voteAdvID,
                'vote' => $vote,
                'photoExt' => $photoExt,
                'photoID' => $photoID,
                'voteCount' => $voteCount,
                //'progress' => $ad_progress
            );
            array_push($adventure, $temp_arr);
        }
    }
}
?>

<div class="jumbotron">
    <div class="container">
        <h1>WanderBlog</h1>

        <p>The place to upload and explore adventures!</p>

        <div class="row">
            <div id="mainSearch">
                <div
                    class="input-group col-md-8 col-md-offset-2">
                    <input type="text"
                           class="search-query form-control"
                           placeholder="Search for author or adventures"/>
                </div>
            </div>
        </div>
        <div id="buttonGroup" class="row">
            <div id="searchAuthor" class="col-md-6">
                <button type="button"
                        class="btn btn-danger">Search Author
                </button>
            </div>
            <div id="searchAdventure" class="col-md-6">
                <button type="button"
                        class="btn btn-danger">Search Adventure
                </button>
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
<?php foreach ($adventure as $stone) {
?>
    <div id="top1" class="container">
        <div class="row">
            <div class="col-md-3">
                <img
                    src="./img/contents/<?php echo $photoID; ?>.<?php echo $photoExt; ?>"
                    class="img-rounded" alt="Cinque Terre" width="250" height="228px">
            </div>
            <div class="col-md-9">
                <p> <?php echo $stone['description'] ?></p>
                <p><?php echo $stone['vote'] ?></p>
                <?php if ($login->isUserLoggedIn() == true): ?>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <input type = "submit" name="like" value = "like"/>
                    <?php endif; ?>

            </div>
        </div>
    </div>
    <?php
}
?>

<?php
if ($_POST['like']){
    mysqli_query($mysqli, "UPDATE votes SET vote = vote+1 WHERE `adv_id` = '1'");
}
?>
</body>
</html>