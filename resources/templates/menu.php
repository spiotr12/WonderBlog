<?php
$url = basename($_SERVER['PHP_SELF']) . "?";
if (strlen($_SERVER['QUERY_STRING'])) {
    $url .= $_SERVER['QUERY_STRING'] . "&";
}
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./#">WanderBlog</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class=""><a href="./#">Home</a></li>
                <?php if ($login->isUserLoggedIn() == true): ?>
                    <li><a href="./author.php?id=<?php echo $_SESSION['id']; ?>">
                            <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>
                        </a>
                    </li>
                    <li>
                        <a href="./<?php echo $url; ?>logout">
                            Log out
                        </a>
                    </li>
                    <?php if (privilegeCheck($mysqli, $_SESSION["id"]) == 0): ?>
                        <li>
                            <a href="./admin.php">Admin</a>
                        </li>
                    <?php endif; ?>

                    <?php
                    if (isUserVerified($mysqli, $_SESSION["id"])): ?>
                        <li>
                            <a href="./CreateAdventure.php">Create Adventure</a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class=""><a href="./login.php">Login</a></li>
                <?php endif; ?>
            </ul>
            <div class="col-sm-6 col-md-6 pull-right">
                <form class="navbar-form" role="search" method="get" action="./search.php">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="q" id="srch-term"
                            <?php
                            if (isset($_GET['q'])) {
                                echo 'value="' . $search . '"s';
                            }
                            ?>
                        >
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="search_type" value="author"><span
                                    class="glyphicon glyphicon-search"> Author</span>
                            </button>
                            <button class="btn btn-default" type="submit" name="search_type" value="adventure"><span
                                    class="glyphicon glyphicon-search"> Adventure</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!--/.nav-collapse -->
    </div>
</nav>