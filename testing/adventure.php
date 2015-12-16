<?php
require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
require_once(LIBRARY_PATH . "/functions.php");
require_once("./php/db_connect.php");
//sec_session_start();

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

$stmt = new mysqli_stmt($mysqli, "SELECT description, name, admin_vote FROM adventures WHERE id = ?");

$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($description, $adventureName, $adminVote);
$stmt->store_result();
if ($stmt->num_rows() == 1) {
while ($stmt->fetch()) {


$stmt1 = new mysqli_stmt($mysqli, "SELECT COUNT(adv_id) FROM votes WHERE adv_id = ?");

$stmt1->bind_param("i", $id);
$stmt1->execute();
$stmt1->bind_result($voteCount);
$stmt1->store_result();
if ($stmt1->num_rows() == 1) {
while ($stmt1->fetch()) {

$stmt2 = new mysqli_stmt($mysqli, "SELECT id, file_ext FROM photos WHERE adv_id = ? AND is_cover = 1 ");

$stmt2->bind_param("i", $id);
$stmt2->execute();
$stmt2->bind_result($coverPhotoID, $coverFileEXT);
$stmt2->store_result();
if ($stmt2->num_rows() == 1) {
while ($stmt2->fetch()) {


?>


<div class="container">
    <div class="row">
        <h1 class="text-center">
            <?php echo $adventureName ?></h1>
    </div>
    <div class="row">
        <div
            class="col-md-10 col-md-offset-1">
            <img class="img-responsive" width="1200" height="440px"
                 src="./img/contents/<?php echo $coverPhotoID; ?>.<?php echo $coverFileEXT; ?>">
        </div>
    </div>
    <div class="row">
        <div
            class="col-md-5 col-md-offset-1">
            <h2>Description</h2>

            <?php echo $description; ?>
        </div>
        <div
            class="col-md-3 col-md-offset-2 text-center">
            <h2>Rating</h2>


            <?php if ($login->isUserLoggedIn() == true): ?>


            <?php if (privilegeCheck($mysqli, $_SESSION['id']) == 0): ?>
            <form action="admin_votes.php" method=post>
                Current admin vote: <?php echo $adminVote ?><br>
                Update admin vote to: <input type="number" name="admin_votes" min="-1000000" max="1000000"/>
                <input type="hidden" name="adv_id" value="<?php echo $id; ?>">
                <input type='submit' value="<?php echo "Update"?>"/>
                </form>
                <?php endif; ?>


                <form action="like_adv.php" method="post">
                    <input type="submit" name="like" value="like"/>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <input type="hidden" name="adv_id" value="<?php echo $id; ?>">
                </form>
                    <?php endif; ?>

                    <?php

                    $voteCount = $voteCount + $adminVote;

                    echo $voteCount;
                    echo " Like(s)"; ?>


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
        <div
            class="col-md-5 col-md-offset-1 comments-section">
            <h2>Comments <br></h2>
        </div
    </div

    <?php $commentArray[] = array();


    $sql = "SELECT * FROM comments WHERE adv_id = $id";
    $res = $mysqli->query($sql) or trigger_error($mysqli->error . "[$sql]");
    while ($row = $res->fetch_assoc()) {
        $stmt3 = new mysqli_stmt($mysqli, "SELECT first_name, last_name FROM users WHERE id = ?");

        $stmt3->bind_param("i", $row['user_id']);
        $stmt3->execute();
        $stmt3->bind_result($commentFirstName, $commentLastName);
        $stmt3->store_result();
        if ($stmt3->num_rows() == 1) {
            while ($stmt3->fetch()) { ?>


                <div class="row">
                    <div
                        class="col-md-6 col-md-offset-1 comments-section">


                        <section>
                            <div class="">
                                <label
                                    class=""><?php echo $commentFirstName;
                                    echo " ";
                                    echo $commentLastName; ?></label>
                                <label
                                    class="pull-right"><?php echo $row['date']; ?></label>
                            </div>

                            <div
                                class="comment">
                                <?php echo $row['comment'];
                                ?>

                            </div>

                            <?php if ($login->isUserLoggedIn() == true): ?>
                            <?php if ($row['user_id'] == $_SESSION['id']): ?>
                            <form action="edit_comment.php" method=post>
                                <textarea rows="3" cols="75" name='editComment' id='editComment'
                                              placeholder="<?php echo $row['comment'] ?>"></textarea><br/>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="adv_id" value="<?php echo $id; ?>">
                                <input type='submit' value = "<?php echo "Click to edit comment";?>""/>
                                </form>







                                <?php endif; ?>







                            <?php endif; ?>
                        </section>

                    </div>
                </div>
            <?php }
        }
    }
    }
    }
    }
    }
    }


    } ?>

    <div class="row">
        <div
            class="col-md-5 col-md-offset-1 comments-section">
            <?php if ($login->isUserLoggedIn() == true): ?>
                <form action="insert_comment.php" method=post>
                <textarea rows="3" cols="80" name='comment' id='comment'
                          placeholder="Insert comment here"></textarea><br/>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <input type="hidden" name="adv_id" value="<?php echo $id; ?>">
                    <input type='submit' value="<?php echo "Click to submit your comment"?> "/>
                </form>
            <?php endif; ?>
            <br>


        </div>

        <div class="container">
            <div class="row">
                <div
                    class="col-md-10 col-md-offset-1">
                    <div
                        class="carousel slide article-slide"
                        id="adventureCarousel">
                        <div
                            class="carousel-inner cont-slider">
                            <?php $carouselRuns = 3 ?>
                            <?php for ($i = 0; $i < $carouselRuns; $i++): ?>
                                <div
                                    class="item <?php if ($i == 0) echo "active"; ?>">
                                    <img
                                        src="http://placehold.it/1200x440/cccccc/ffffff">
                                </div>
                                <div
                                    class="item">
                                    <img
                                        src="http://placehold.it/1200x440/999999/cccccc">
                                </div>
                            <?php endfor; ?>
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control"
                           href="#adventureCarousel"
                           role="button"
                           data-slide="prev">
                                                                    <span
                                                                        class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control"
                           href="#adventureCarousel"
                           role="button"
                           data-slide="next">
                                                                    <span
                                                                        class="glyphicon glyphicon-chevron-right"></span>
                        </a>

                        <!-- Indicators -->
                        <ol class="carousel-indicators visible-lg visible-md">
                            <?php for ($i = 0; $i < $carouselRuns; $i++): ?>
                                <li class="<?php if ($i == 0) echo "active"; ?>"
                                    data-slide-to="<?php echo 2 * $i; ?>"
                                    data-target="#adventureCarousel">
                                    <img alt=""
                                         title=""
                                         src="http://placehold.it/120x44/cccccc/ffffff">
                                </li>
                                <li class=""
                                    data-slide-to="<?php echo 2 * $i + 1; ?>"
                                    data-target="#adventureCarousel">
                                    <img alt=""
                                         title=""
                                         src="http://placehold.it/120x44/999999/cccccc">
                                </li>
                            <?php endfor; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $user_id = $_SESSION['id'];
        echo $user_id;

        if (isset($_SESSION['id']) && $user_id == $_SESSION['id']) { ?>
            <!--         Trigger the modal with a button -->
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Info
            </button>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Adventure</h4>
                        </div>
                        <form action="edit_adventure.php" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="usr">Adventure Name:</label>
                                    <input type="text" class="form-control" name="adventureName"
                                           value="<?php echo $adventureName ?>">

                                    <label for="usr">Country:</label>
                                    <input type="text" class="form-control" name="country" value="">

                                    <label for="usr">City:</label>
                                    <input type="text" class="form-control" name="city" value="">

                                    <label for="usr">Description;</label>
                                    <textarea class="form-control" name="description" rows="5"
                                              cols="80"><?php echo $description; ?></textarea>

                                    <input type="hidden" class="form-control" name="adventureID"
                                           value="<?php echo $id; ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-default">Submit</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        <?php }
        ?>

        <form action="delete_adventure.php" method="post">
            <input type="hidden" class="form-control" name="test" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-default">Delete Adventure</button>
        </form>

        <script type="text/javascript">
            $('#adventureCarousel').carousel({
                interval: 4000
            });
        </script>


</body>
</html>