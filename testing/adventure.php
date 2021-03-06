<?php
error_reporting(E_ALL);
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
$tagString = "";
?>
<body>

<?php require_once("../resources/templates/menu.php"); ?>



<?php

$adv_id = $_GET["id"];


// create a SQL query as a string
//$sql_query = "SELECT description FROM adventures WHERE id = $adv_id";
// execute the SQL query
//$description = $mysqli->query($sql_query);

$stmt = new mysqli_stmt($mysqli, "SELECT user_id, description, name, admin_vote, country, city FROM adventures WHERE id = ?");

$stmt->bind_param("i", $adv_id);
$stmt->execute();
$stmt->bind_result($adventureUserID, $description, $adventureName, $adminVote, $country, $city);
$stmt->store_result();
if ($stmt->num_rows() == 1) {
while ($stmt->fetch()) {


$stmt1 = new mysqli_stmt($mysqli, "SELECT COUNT(adv_id) FROM votes WHERE adv_id = ?");

$stmt1->bind_param("i", $adv_id);
$stmt1->execute();
$stmt1->bind_result($voteCount);
$stmt1->store_result();
if ($stmt1->num_rows() == 1) {
while ($stmt1->fetch()) {

$stmt2 = new mysqli_stmt($mysqli, "SELECT id, file_ext FROM photos WHERE adv_id = ? AND is_cover = 1 ");

$stmt2->bind_param("i", $adv_id);
$stmt2->execute();
$stmt2->bind_result($coverPhotoID, $coverFileEXT);
$stmt2->store_result();
if ($stmt2->num_rows() == 1) {
while ($stmt2->fetch()) {

$stmt3 = new mysqli_stmt($mysqli, "SELECT first_name, last_name FROM users WHERE id = ?");

$stmt3->bind_param("i", $adventureUserID);
$stmt3->execute();
$stmt3->bind_result($authorFirstName, $authorLastName);
$stmt3->store_result();
if ($stmt3->num_rows() == 1) {
while ($stmt3->fetch()) {
?>
<div class="container">
    <div class="row">
        <h1 class="text-center">
            <?php echo $adventureName ?></h1>
    </div>
    <div class="row">
        <div
            class="col-md-10 col-md-offset-1">
            <img class="img-responsive" width="945" height="636px"
                 src="./img/contents/<?php echo $coverPhotoID; ?>.<?php echo $coverFileEXT; ?>">
        </div>
    </div>
    <div class="row">
        <div
            class="col-md-5 col-md-offset-1">
            <h2>Description</h2>

            <?php echo $description; ?>
            <br><br>
            Country: <?php echo $country ?><br>
            <?php If ($city != NULL): {
                echo "City: ";
                echo $city;
            }; endif; ?><br>
            Author: <?php echo $authorFirstName;
            echo " ";
            echo $authorLastName; ?>




        </div>
        <div
            class="col-md-3 col-md-offset-2 text-center">
            <h2>Rating</h2>
            <?php if ($login->isUserLoggedIn() == true): ?>
                <?php if (privilegeCheck($mysqli, $_SESSION['id']) == 0): ?>
                    <form action="admin_votes.php" method=post>
                        Current user vote: <?php echo $voteCount ?><br>
                        Current admin vote: <?php echo $adminVote ?><br>
                        Update admin vote to: <input type="number" name="admin_votes" min="-1000000" max="1000000"/>
                        <input type="hidden" name="adv_id" value="<?php echo $adv_id; ?>">
                        <input type='submit' value="<?php echo "Update" ?>"/><br>
                        <?php $combinedVoteCount = $voteCount + $adminVote; ?>
                        Combined vote: <?php echo $combinedVoteCount ?>

                    </form>
                <?php elseif (($adventureUserID != $_SESSION['id']) && (isUserVerified($mysqli, $_SESSION['id']) == TRUE)): ?>

                    <form action="like_adv.php" method="post">
                        <input type="submit" name="like" value="like"/>
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="adv_id" value="<?php echo $adv_id; ?>">
                    </form>
                    <?php
                endif;
            endif; ?>
            <?php
            $combinedVoteCount = $voteCount + $adminVote;
            echo "Current likes: ";
            echo $combinedVoteCount;
            ?>
            <h2>Tags</h2>
            <ul class="list-unstyled">
                <?php
                $tagsStmt = new mysqli_stmt($mysqli, "SELECT keywords FROM adventures WHERE id = ?");
                $tagsStmt->bind_param("i", $adv_id);
                $tagsStmt->execute();
                $tagsResult = $tagsStmt->get_result();
                $tagsTemp = $tagsResult->fetch_array();
                $tagString = $tagsTemp['keywords'];
                $tags = multiexplode(array(";", ","), $tagsTemp['keywords']);
                foreach ($tags as $tag) {
                    echo "<li>" . $tag . "</li>";
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <div
            class="col-md-5 col-md-offset-1 comments-section">
            <h2>Comments <br></h2>
        </div
    </div
    <?php }
    }
    }
    }
    }
    }
    }
    } ?>
    <?php $commentArray[] = array();
    $sql = "SELECT * FROM comments WHERE adv_id = $adv_id";
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
                                <textarea rows="3" cols="50" name='editComment' id='editComment'
                                          placeholder="<?php echo $row['comment'] ?>"></textarea><br/>
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="adv_id" value="<?php echo $adv_id; ?>">
                                        <input type='submit'
                                               value="<?php echo "Click to submit your edited comment"; ?>""/>
                                    </form>
                                <?php endif; ?>
                                <?php if ((privilegeCheck($mysqli, $_SESSION['id']) == 0) || ($adventureUserID == $_SESSION['id']) || ($row['user_id'] == $_SESSION['id'])): ?>
                                    <form action="delete_comment.php" method="post">
                                        <input type="submit" name="deleteComment" value="Click here to delete comment"/>
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="adv_id" value="<?php echo $adv_id; ?>">
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </section>
                    </div>
                </div>
            <?php }
        }
    } ?>

    <div class="row">
        <div
            class="col-md-5 col-md-offset-1 comments-section">
            <?php if (($login->isUserLoggedIn() == true) && (isUserVerified($mysqli, $_SESSION['id']) == TRUE)): ?>
                <form action="insert_comment.php" method=post>
                <textarea rows="3" cols="50" name='comment' id='comment'
                          placeholder="Insert comment here"></textarea><br/>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <input type="hidden" name="adv_id" value="<?php echo $adv_id; ?>">
                    <input class="btn btn-success" type='submit' value="<?php echo "Click to submit your comment" ?> "/>
                </form>
            <?php endif; ?>
            <br>
            <br>


        </div>


        <?php

        $photosArray[] = array();

        $sql2 = "SELECT id, file_ext FROM photos WHERE adv_id = $adv_id";
        $res = $mysqli->query($sql2) or trigger_error($mysqli->error . "[$sql2]");
        while ($row = $res->fetch_assoc()) { ?>


            <img class="displayed" width="600" height="220px"
                 src="./img/contents/<?php echo $row['id']; ?>.<?php echo $row['file_ext']; ?>"><br>

            <?php if ($login->isUserLoggedIn() == true): ?>
                <?php if ((privilegeCheck($mysqli, $_SESSION['id']) == 0) || ($adventureUserID == $_SESSION['id']) || ($row['user_id'] == $_SESSION['id'])): ?>

                    <form action="delete_photo.php" method="post">
                        <input class="btn btn-danger" type="submit" name="deletePhoto"
                               value="Click here to delete Photo">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="adv_id" value="<?php echo $adv_id; ?>">
                    </form>

                <?php endif;
            endif;
        }
        ?>

        <?php
        If ($login->isUserLoggedIn() == true):

            if ((privilegeCheck($mysqli, $_SESSION['id']) == 0) || ($adventureUserID == $_SESSION['id'])): ?>
                <!--         Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Info
                </button>
                <form class="form" name="upload_file" method="post" action="./php/upload_photo.php"
                      enctype="multipart/form-data">
                    <label class="label">upload photo</label>
                    <input class="" type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <input class="" type="hidden" name="adv_id" value="<?php echo $adv_id; ?>">
                    <input class="" type="file" name="photos">
                    <button class="btn btn-default" type="submit" name="uploadSubmit">Submit</button>
                </form>

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
                                        <input type="text" class="form-control" name="country"
                                               value="<?php echo $country ?>">

                                        <label for="usr">City:</label>
                                        <input type="text" class="form-control" name="city" value="<?php echo $city ?>">

                                        <label for="usr">Description;</label>
                                    <textarea class="form-control" name="description" rows="5"
                                              cols="80"><?php echo $description; ?></textarea>

                                        <label for="usr">Tags:</label>
                                        <input type="text" class="form-control" name="keywords"
                                               value="<?php echo $tagString ?>">

                                        <input type="hidden" class="form-control" name="adventureID"
                                               value="<?php echo $adv_id; ?>">
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


                <form action="delete_adventure.php" method="post">
                    <input type="hidden" class="form-control" name="test" value="<?php echo $adv_id; ?>">
                    <button type="submit" class="btn btn-default">Delete Adventure</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>


</body>
</html>