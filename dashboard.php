<?php
session_start();


?>






<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="pingle/pingle_css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="utf-8">
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top full_opacity">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand head" id = "brand" href="landing_page.html">CommeHub</a>
        </div>

          <ul class="nav navbar-nav navbar-right" id="search">
            <li><div class="input-group" style="width:40vw;margin-top:10px;">
              <input type="text" class="form-control" placeholder="Search for anything...">
              <span class="input-group-btn">
                <button class="btn btn-success" type="button" style="padding:8px;"><img src="pingle/images/search-magnifier-interface-symbol(1).png" alt=""></button>
              </span>
            </div></li>
            <li><a href="flash_deals.html">Flash Deals</a></li>
            <li><a href="Active_votes.html">Active Votes</a></li>
            <li><a href="#"><img src="project_images\notifications-button (1).png" alt=""></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="project_images\1021873-dark-angel-wallpapers-1920x1080-ios.jpg" alt="avatar" class="avatar"></a>
              <ul class="dropdown-menu">
                <li><a id="profile" href="#">Profile</a></li>
                <li><a id="profile" href="#">Saved</a></li>
                <li><a id="profile" href="#">Transactions</a></li>
                <li role="separator" class="divider"></li>
                <li><a id="profile" href="#">Settings</a></li>
                <li><a id="profile" href="#">Help Center</a></li>
                <li><a id="profile" href="#">Careers</a></li>
                <li role="separator" class="divider"></li>
                <li><a id="profile" href="#">Logout</a></li>
              </ul>
            </li>
          </ul>


        <!-- Collect the nav links, forms, and other content for toggling -->
      </div><!-- /.container-fluid -->
    </nav>

    <br><br><br><br><br><hr>

    <div class="container">
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="jumbotron jumbotron-fluid shard1">
                      <a href="new_post">
                      <img src="pingle/images/id-card (2).png" class="img-responsive" alt="">
                      <h4><strong>Create new Post</strong></h4>
                      <p><h5 style="color:gray;">Have a product in mind? create a post for the community to vote on</h5></p>
                      </a>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="jumbotron jumbotron-fluid shard1">
                      <img src="project_images/vote.png" class="img-responsive" alt="">
                      <h4><strong>Votes</strong></h4>
                      <p><h5 style="color:gray;">Learn all you need to know about our product voting system</h5></p>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="jumbotron jumbotron-fluid shard1">
                      <img src="project_images/sell-product.png" class="img-responsive" alt="">
                      <h4><strong>Flash deals</strong></h4>
                      <p><h5 style="color:gray;">Understand how our flashdeals work</h5></p>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="jumbotron jumbotron-fluid shard1" style="height:231px;">
                      <img src="project_images/respect.png" class="img-responsive" alt="">
                      <h4><strong>Partnerships and Collaborations</strong></h4>
                      <p><h5 style="color:gray;">All you need to know about partnering and selling your products on our platform</h5></p>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="jumbotron jumbotron-fluid shard1">
                      <img src="project_images/online-order.png" class="img-responsive" alt="">
                      <h4><strong>Your Orders</strong></h4>
                      <p><h5 style="color:gray;">How to track your packages and more</h5></p>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="jumbotron jumbotron-fluid shard1">
                      <img src="project_images/cash (2).png" class="img-responsive" alt="">
                      <h4><strong>Payments</strong></h4>
                      <p><h5 style="color:gray;">learn about the payments options available to you</h5></p>
                    </div>
                  </div>

                  <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                    <div class="jumbotron jumbotron-fluid shard1">
                      <img src="project_images/technical-support.png" class="img-responsive" alt="">
                      <h4><strong>Account settings</strong></h4>
                      <p><h5 style="color:gray;">How to manage and control your account</h5></p>
                    </div>
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
