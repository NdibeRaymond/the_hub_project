<?php

require '../includes/datacontrol.php';

$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email;
    $password;
    $baseData = new Database('thehub');

    if (isset($_POST['email_field']) && !empty($_POST['email_field'])){
        $email = $baseData->parseInput($_POST['email_field']);
        #make sure that the email and password are provided and is not empty
        if (isset($_POST['password']) && !empty($_POST['password'])){
            //encrypt password with salt and match to the record in the database
            $password = $_POST['password'];
            $salt = sha1(md5($password));
            $password = md5($password.$salt);
            #check if the user exists in the database
            if ($baseData->getRecord(USERS,EMAIL,EMAIL,$email) != NULL){
                #get the actual password and compare
                $storedPassword = $baseData->getRecord(USERS,PASSWORD,EMAIL,$email);
                if ($password === $storedPassword){
                    #password matches!
                    session_start();
                    $_SESSION['logged'] = TRUE;
                    $_SESSION['username'] = $baseData->getRecord(USERS,USERNAME,EMAIL,$email);
                    $_SESSION['photo'] = $baseData->getRecord(USERS,PHOTO,EMAIL,$email);
                    $_SESSION['email'] = $email;
                    header("Location:../dashboard.php");
                }else {
                    $errorMsg = 'Password incorrect!';
                }

            }else{
                $errorMsg = 'Sorry, User with this email doesn\'t exist';
            }
        }
    }



}





?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="pingle_css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>CommeHub - Login</title>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top full_opacity">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar head"></span>
            <span class="icon-bar head"></span>
            <span class="icon-bar head"></span>
          </button>
          <a class="navbar-brand head" id = "brand" href="./">CommeHub</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <!-- <li class="active el1"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
            <!-- <li><a href="#">Link</a></li> -->
            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>
          <!-- <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control form1" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default form1">Submit</button>
          </form> -->
          <ul  class="nav navbar-nav navbar-right">
            <li><a href="flash_deals.html">Flash Deals</a></li>
            <li><a href="Active_votes.html">Active Votes</a></li>
            <li><a href="help_center.html">Help</a></li>
            <li><a href="./signup" id= "login">Signup</a></li>
            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li> -->
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <br>
    <br>
    <br>
    <br>


    <div class="contentDiv">
      <div>

        <div class="container jumbotron edge" style="background-color:rgba(255,255,255,1);border-radius:10px;">
          <h1>Login</h1>
          <p><h3>Don't have account yet? <a href="../signup">Sign up!</a></h3></p>


        </div>

        <div class="container">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
          <div style="color:red"><?php echo $errorMsg; ?></div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" name="email_field" class="form-control" id="exampleInputEmail1" placeholder="Email" required>
              <small id = "emailhelp" class = "form-text text-muted">we'll never share your email with anyone else</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
              <small id = "passwordhelp" class = "form-text text-muted">your password should be more than 8 characters length and must contain capital letters, small letters, numbers and special characters</small>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> keep me logged in
              </label>
            </div>
            <a href="forgot_password.html"><h5>Forgot password?</h5></a>

            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>

      </div>
    </div>


    <script src="http://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>  <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="transparent_to_solid_navbar.js"></script>
    <script src="animated_arrow.js"></script>
    <script src="back_to_top.js"></script>



  </body>
</html>
