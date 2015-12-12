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
                        <a>Privilege: <?php echo privilegeCheck($mysqli, $_SESSION['id']); ?></a>
                    </li>
                    <li class="">
                        <a href="./<?php echo pathinfo($_SERVER['PHP_SELF'])['basename']; ?>?logout">Log out</a>
                    </li>
                <?php else: ?>
                    <li class=""><a href="./login.php">Login</a></li>
                <?php endif; ?>
            </ul>
            <div class="col-sm-6 col-md-6 pull-right">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">

                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"> Author</span>
                            </button>
                            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"> Adventure</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</nav>