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
    "css/main.css"
);
$js = array(
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
    "js/main.js"
);
renderHeader("Admin Tools", $meta, $css, $js);
?>
<body>

<?php require_once("../resources/templates/menu.php"); ?>

<div class="container">
    <div class="row">
        <?php
        echo "PRIVILAGES: " . privilegeCheck($mysqli, $_SESSION['id']);
        if (privilegeCheck($mysqli, $_SESSION['id']) == 0): ?>
            <h1>Hello Boss xD</h1>
            <h2>Notifications</h2>

            <h2>Vew users</h2>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a class=collapsed" role="button" data-toggle="collapse" href="#usersTable"
                               aria-expanded="false" aria-controls="collapseExample">Users</a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="usersTable">
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>

            <h2>Vew adventures</h2>
        <?php else: ?>
            <h2>You do not have a rights to access this page</h2>
        <?php endif; ?>
    </div>
</div>

</body>
</html>