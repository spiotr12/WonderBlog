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
                    <li class=""><a href="./author.php?id=<?php echo $_SESSION['id']; ?>">
                            <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>
                        </a>
                    </li>
                    <li class="">
                        <a href="./<?php echo $url; ?>logout">
                            Log out
                        </a>
                    </li>
                    <?php if (privilegeCheck($mysqli, $_SESSION["id"]) == 0): ?>
                        <li>
                            <a href="./admin.php">Admin</a>
                        </li>

                    <?php endif; ?>

                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Create Adventure<strong class="caret"></strong></a>
                            <div class="dropdown-menu">
                                <form method="post" action="login" accept-charset="UTF-8">
                                     class="form-group">
                                        <label for="usr">First Name:Description:</label>
                                        <input type="text" class="form-control" id="usr" value="">

                                        <label for="usr">Second Name:</label>
                                        <input type="text" class="form-control" id="usr" value="">

                                        <label for="usr">Description:</label>
                                        <textarea class="form-control" id="usr"  rows="5" cols="80" ></textarea>

                                        <label for="usr">Date Of Birth:</label>
                                        <input type="text" class="form-control" id="usr" value="">

                                        <label for="usr">Country:</label>
                                        <input type="text" class="form-control" id="usr" value="">

                                </form>
                            </div>
                        </li>
                    </ul>
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
                                echo 'value="' . $_GET['q'] . '"s';
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