<?php

require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
require_once("./php/db_connect.php");

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
    "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">");

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
$id = $_GET['id'];
$stmt = new mysqli_stmt($mysqli, "SELECT first_name, last_name, description, country, dob FROM users WHERE id = ?");
$stmt1 = new mysqli_stmt($mysqli, "SELECT COUNT(user_id)FROM adventures WHERE user_id = ?");

if ($stmt1) {
    $stmt1->bind_param("i", $id);
if ($stmt1->execute()) {
    $stmt1->bind_result($adventure_no);
    $stmt1->store_result();
if ($stmt1->num_rows() == 1) {

    while ($stmt1->fetch()) {

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
                        src="https://upload.wikimedia.org/wikipedia/commons/9/93/Evan_Roth_head_shot.jpg"
                        class="img-rounded" alt="Mountain View" style="width:250px; height:260px;">
                </div>
                    <?php
                    if(isset($_SESSION['id']) && $id == $_SESSION['id']) { ?>

                        <h2><?php echo $first_name . " " . $last_name; ?></h2>

                        <p>Date of Birth: <?php echo $dob ?></p>

                        <p>Country: <?php echo $country ?></p>

                        <p>Adventures: <?php echo $adventure_no; ?> </p>

                        <p>Memeber Since: 01/10/15 </p>

                        <p><?php echo $description; ?></p>

                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit Info</button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Info</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="usr">Description:</label>
                                            <input type="text" class="form-control" id="usr">
                                            <label for="usr">First Name:</label>
                                            <input type="text" class="form-control" id="usr">
                                            <label for="usr">Second Name:</label>
                                            <input type="text" class="form-control" id="usr">
                                            <label for="usr">Date Of Birth:</label>
                                            <input type="text" class="form-control" id="usr">
                                            <label for="usr">Country:</label>
                                            <input type="text" class="form-control" id="usr">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    <?php }

                   else{
                        ?>
                        <h2><?php echo $first_name . " " . $last_name; ?></h2>

                        <p>Date of Birth: <?php echo $dob ?></p>

                        <p>Country: <?php echo $country ?></p>

                        <p>Adventures: <?php echo $adventure_no; ?> </p>

                        <p>Memeber Since: 01/10/15 </p>

                        <p><?php echo $description; ?></p>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
                            }
                        }
                    }
                }
            }
        }
    }
}

?>

<div id="Contributions" class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Contributions </h2>
        </div>
    </div>
</div>

<?php
$author = array(
    'id' => $_GET['id'],
    'first_name' => "",
    'last_name' => ""
);

// Author
$stmtUser = mysqli_prepare($mysqli, "SELECT fisrt_name, last_name FROM users WHERE id = ?");
if ($stmtUser) {
    mysqli_stmt_bind_param($stmtUser, "i", $author['id']);
    // execute statement
    if (mysqli_stmt_execute($stmtUser)) {
        mysqli_stmt_bind_result($stmtUser, $fisrt_name, $last_name);
        mysqli_stmt_store_result($stmtUser);
        // save variables
        if (mysqli_stmt_num_rows($stmtUser) == 1) {
            mysqli_stmt_fetch($stmtUser);
            $author['first_name'] = $fisrt_name;
            $author['last_name'] = $last_name;
        }
    }
}

// preapre adventure data
$adventure = array();
$total_progress = 0;
// adventure
$stmtAdventure = new mysqli_stmt($mysqli, "SELECT id, description FROM adventures WHERE user_id = ?");
if ($stmtAdventure) {
    $stmtAdventure->bind_param("i", $author['id']);
    if ($stmtAdventure->execute()) {
        $stmtAdventure->bind_result($ad_id, $ad_description
        );
        while ($stmtAdventure->fetch()) {
            $temp_arr = array(
                'id' => $ad_id,
                'description' => $ad_description,
                //'progress' => $ad_progress
            );
            array_push($adventure, $temp_arr);
        }
    }
}

//$ad_total = $total_progress;
foreach ($adventure as $stone) {
    ?>

    <div id="top1" class="container">
        <div class="row">
            <div class="col-md-3">
                <img
                    src="http://www.wallpaperup.com/uploads/wallpapers/2014/05/04/349132/big_thumb_f3d6cfe01fbc551c76dce58d36d9f090.jpg"
                    class="img-rounded" alt="Cinque Terre" width="250" height="228px">
            </div>
            <div class="col-md-9">
                <p> <?php echo $stone['description'] ?></p>

                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
            </div>
        </div>
    </div>

    <?php
}
?>




</body>
</html>