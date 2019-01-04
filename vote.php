<?php

require 'includes/posts.php';

$id;
$hash;
$post;

if (isset($_GET['id']) && isset($_GET['hash'])){
    $id = $_GET['id'];
    $hash = $_GET['hash'];

    if (!empty($hash) && !empty($id)){
        $post = posts::getPostById($id);
    }

    if (isset($_GET['vote'])&&isset($_GET['option'])){
        #implement one man one vote!
        $voteId = $_GET['vote'];
        $voteOption = $_GET['option'];
        #check if the user is actually logged in
        if (isset($_SESSION['username'])){
            #check the integrity of the link before proceeding with the voting
            //var_dump($post);
            if ($post->getPostOptions()[--$voteOption]->getId() == $voteId){
                $voteRecords = $baseData->getMultipleRecords('votes','voter',$_SESSION['username']);
                $alreadyVoted = FALSE;
                /* Check to see if $voteRecord is NULL or not, if it is NULL, that means that the has not voted in
                 * any item before, hence has no voting record in database
                 */
                //var_dump($voteRecords);
                if ($voteRecords != NULL){
                    #echo 'not null debug point';
                    foreach ($voteRecords as $voteRecord){
                        //echo 'running a debug loop';
                        #loop through all the voting records of the user and check if he has already voted the item
                        if ($voteRecord['option'] == $voteId){
                            #user has already voted this item
                            $alreadyVoted = TRUE;
                        }
                    }
                }

                #var_dump($alreadyVoted);

                if (!$alreadyVoted){
                    #user has not voted this item and is eligible to vote this item
                    #vote item
                    $post->getPostOptions()[$voteOption]->vote();
                    header('Location:'.$_SERVER['PHP_SELF'].'?id='.$post->getId().'&hash=ffac144');
                }else {
                    echo "voted already";
                }

            }else{
                echo "voting link not valid";
            }

        }else {
            echo "please log in first to vote";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <link rel="stylesheet" href="pingle_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <meta charset="utf-8">
    <title>CommeHub - <?php echo $post->getName(); ?></title>
  </head>
  <body>

    <nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top">
     <!-- Brand -->
	<a class="navbar-brand" href="#">CommeHub</a>
	<div >
  		<form class="form-inline" action="/action_page.php">
    		<input class="form-control mr-sm-1" type="text" placeholder="Search anything ...">
    		<button class="btn btn-success" type="submit">Search</button>
  		</form>
  	</div>

  		<!-- Links -->
  		<ul class="navbar-nav ml-auto" style="margin-right:8%;">
    		<li class="nav-item">
     			<a class="nav-link" href="#">Flash deals</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link" href="#">Active votes</a>
    		</li>
    		<!-- Dropdown -->
    		<li class="nav-item dropdown">
      			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">avatar</a>
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
	</nav>
    <div class="card">
  <div class="card-body">
    <h4 class="card-title"><strong><?php echo $post->getName();?></strong></h4>
    <p class="card-text">by <a href="#" title="<?php echo $post->getCreator()?>'s profile"><?php echo $post->getCreator();?></a></p>
    <p class="card-text"><?php echo $post->getDescription();?></p>
    <button type="button" class="btn btn-outline-dark"><?php echo $post->getCategory();?></button>
  </div>
</div>
<br>
<div class="row" style="margin-left: 1%">
<?php
$options = $post->getPostOptions();
foreach ($options as $option){
    echo '<div class="col-sm-4">';
    $option->appendHTML();
    echo '</div>';
    echo '<br>';
}

?>
</div>

  	<script>
	$(document).ready(function(){
    $('#comment').tooltip();
	});
	</script>

    <script src="http://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>  <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="transparent_to_solid_navbar.js"></script>
    <script src="animated_arrow.js"></script>
    <script src="back_to_top.js"></script>



  </body>
</html>
