<?php

require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
require_once(LIBRARY_PATH . "/functions.php");
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
<body>

<?php require_once("../resources/templates/menu.php"); ?>


<!-- Modal -->
<div id="createAdventure" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
       <div class="modal-content">
           <div class="modal-header">
           </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="usr">First Name:Description:</label>
                    <input type="text" class="form-control" id="usr" value="">

                    <label for="usr">Second Name:</label>
                    <input type="text" class="form-control" id="usr" value="">

                    <label for="usr">Description:</label>
                    <textarea class="form-control" id="usr"  rows="5" cols="80"></textarea>

                    <label for="usr">Date Of Birth:</label>
                    <input type="text" class="form-control" id="usr" value="">

                    <label for="usr">Country:</label>
                    <input type="text" class="form-control" id="usr" value=" ">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default" data-dismiss="modal" >Submit</button>

            </div>
        </div>

    </div>
</div>

</body>

</html>




<?php $mysqli->close(); ?>
