<?php
require_once("../resources/config.php");
require_once(LIBRARY_PATH . "/templating_functions.php");
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
    //"css/login.css",


);
$js = array(
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js",
    "js/main.js",
    "js/login.js",
    
);
renderHeader("WonderBlog!", $meta, $css, $js);
?>
<body>

<?php require_once("../resources/templates/menu.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-7 col-sm-9">

            <h4 style="border-bottom: 1px solid #c5c5c5;">
                <i class="glyphicon glyphicon-user">
                </i>
                Account Access
            </h4>
            <div style="padding: 20px;" id="form-olvidado">
                <form accept-charset="UTF-8" role="form" id="login-form" method="post">
                    <h4 class="">
                        Signin!
                    </h4>
                    <fieldset>
                        <div class="form-group input-group">
          <span class="input-group-addon">
            @
          </span>
                            <input class="form-control" placeholder="Email" name="email" type="email" required="" autofocus="">
                        </div>
                        <div class="form-group input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock">
            </i>
          </span>
                            <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Access
                            </button>
                            <p class="help-block">
                                <a class="pull-right text-muted" href="#" id="olvidado"><small>Forgot your password?</small></a>
                                <a class="pull-left text-muted" href="#" id="olvidado2"><small>Signup!</small></a>

                            </p>
                        </div>
                    </fieldset>
                </form>
            </div>

            <div style="display: none;" id="form-olvidado1">
                <h4 class="">
                    Forgot your password?
                </h4>
                <form accept-charset="UTF-8" role="form" id="login-recordar" method="post">
                    <fieldset>
        <span class="help-block">
          Email address you use to log in to your account
          <br>
          We'll send you an email with instructions to choose a new password.
        </span>
                        <div class="form-group input-group">
          <span class="input-group-addon">
            @
          </span>
                            <input class="form-control" placeholder="Email" name="email" type="email" required="">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" id="btn-olvidado">
                            Continue
                        </button>
                        <p class="help-block">
                            <a class="text-muted" href="#" id="acceso1"><small>Account Access</small></a>

                        </p>
                    </fieldset>
                </form>
            </div>
            <div style="display: none;" id="form-olvidado2">
                <h4 class="">
                    Welcome!
                </h4>
                <form accept-charset="UTF-8" role="form" id="login-recordar" method="post">
                    <fieldset>
        <span class="help-block">
          Signup page
          <br>
          Please sign up and start!
        </span>
                        <div class="form-group input-group">
          <span class="input-group-addon">
            @
          </span>
                            <input class="form-control" placeholder="Email" name="email" type="email" required="">
                        </div>

                        <div class="form-group input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock">
            </i>
          </span>
                            <input class="form-control" placeholder="Password" name="password_new" type="password" required="">
                        </div>
                        <div class="form-group input-group">
          <span class="input-group-addon">
            <i class="glyphicon glyphicon-lock">
            </i>
          </span>
                            <input class="form-control" placeholder="Repeat Password" name="password_new_2" type="password" required="">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" id="btn-olvidado">
                            Continue
                        </button>
                        <p class="help-block">
                            <a class="text-muted" href="#" id="acceso2"><small>Account Access</small></a>
                        </p>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>>

</body>
</html>