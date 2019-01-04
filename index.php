<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";

$pmail = new PHPMailer;
$from = "no-reply@commehub.com";
$fromName = "CommeHub";
$subject = "Thanks for Subscribing";
$message = 'Thank you for subscribing, we will notify you once <a href="http://commehub.com">CommeHub</a> is fully launched.<br>
	Please, if you have not yet participated in our online survey, endeavour to do so by 
	<a href="https://docs.google.com/forms/d/e/1FAIpQLSf2rBM4fyfQZz9VCmqzIaaTFP1aWATexO4P8n4mPOYjfHjCrA/viewform"><b>Clicking here</b></a> 
	and stand a chance to win free giveaways when we lauch.<br><br>
	<center>Thanks for believing in us, we promise you an amazing experience with us</center>';
$mail = new PHPMailer;

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "thehub";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['submit'])){
		//send mail to the subscriber
		$mail->From=$from;
		$mail->FromName=$fromName;
		$mail->addAddress($email);
		$mail->isHTML(true);
		$mail->Subject=$subject;
		$mail->Body=$message;
		if($mail->send()){
		    //mail sent
		}
		$conn = new mysqli($servername, $username, $password, $dbName);
		if(!$conn->connect_error){
			$sql="INSERT INTO subscribers (email) VALUES('$email')";
			if($conn->query($sql)){
				//data inserted successfully
				echo "inserted successfully";
			}
		}
		
	}
}




?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">

	
<!-- Mirrored from www.athenadesignstudio.com/themes/selene/image.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Dec 2018 22:37:26 GMT -->
<head>
	
		<!-- Meta -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<!-- Title -->
		<title>CommeHub-Launching soon</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">
		
		<!-- Font awesome -->
		<link rel="stylesheet" type="text/css" href="layout/plugins/fontawesome/css/fontawesome-all.min.css" />
		
		<!-- Google web fonts -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,600,700,700italic" rel="stylesheet" type="text/css">
		
		<!-- Stylesheet -->
		<link rel="stylesheet" href="layout/style.css" type="text/css">
		<link rel="stylesheet" href="layout/media.css" type="text/css">
		
		<!-- Color schema -->
		<link class="colors" rel="stylesheet" href="layout/colors/blue.css" type="text/css">
		
		<!-- Settings (Remove it on your site) -->
		<link rel="stylesheet" href="layout/plugins/settings/settings.css" type="text/css">
	
		<!-- Modernizr -->
    	<script src="layout/plugins/modernizr/modernizr.custom.js"></script>
    	
    	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    	<!--[if lt IE 9]>
      		<script src="layout/plugins/html5shiv/html5shiv.js"></script>
      		<script src="layout/plugins/respond/respond.min.js"></script>
      	<![endif]-->
	
	</head>
	
	<body>
		<div class="wrap" id="bg-image">
	
			<!-- Main -->
			<div id="main">
				<div class="inner">
	
					<!-- Header -->
					<header>
						<h1 class="logo fade-in">
							<img src="images/ogo.png" width="200" height="200" alt="" />
						</h1>
					</header>
	
					<!-- Content -->
					<section class="content">
	
						<h1 class="title">
							<span>CommeHub</span> Is Coming Soon
						</h1>
						
						<p class="slogan">
							Our website is under construction, we are working very hard to give you the best experience with this one.<br />
							You will love CommeHub as much as we do. It will morph perfectly on your needs! 
						</p>
						<p class="slogan">Grab a chance to win our free giveaways when we finally launch by participating in our <a href="https://docs.google.com/forms/d/e/1FAIpQLSf2rBM4fyfQZz9VCmqzIaaTFP1aWATexO4P8n4mPOYjfHjCrA/viewform" title="CommeHub Survey"><b>Online Survey</b></a>.</p>
	
						<!-- Countdown timer -->
						<div id="timer"></div>
	
						<p class="subtitle">Notify Me When It's Ready</p>
	
						<!-- Newsletter form -->
						<div id="newsletter" class="form-wrap">
						
							<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="newsletter-form">
							
								<p class="form-field">
									<input type="email" name="email" id="email" value="" placeholder="Your email" />
								</p>
								
								<p class="form-submit">
									<input type="submit" name="submit" id="submit" value="Subscribe" />
								</p>
								
							</form>
							
						</div>
	
						<!-- Social links -->
						<div class="social">
							<ul>
								
								<li>
									<a href="#" class="twitter" title="Twitter">
										<i class="fab fa-twitter"></i>
									</a>
								</li>
								
								<li>
									<a href="http://facebook.com/commehub" class="facebook" title="Facebook">
										<i class="fab fa-facebook-f"></i>
									</a>
								</li>
								
								<li>
									<a href="#" class="google-plus" title="Google+">
										<i class="fab fa-google-plus-g"></i>
									</a>
								</li>
								
								<li>
									<a href="#" class="instagram" title="Instagram">
										<i class="fab fa-instagram"></i>
									</a>
								</li>
								
								<li>
									<a href="#" class="vimeo" title="Vimeo">
										<i class="fab fa-vimeo-v"></i>
									</a>
								</li>
							
							</ul>
						</div>
	
					</section>
	
					<!-- Modal page toggle -->
					<div class="modal-toggle">
						<a href="#" id="modal-open" title="More Info">
							<i class="fas fa-angle-right"></i>
						</a>
					</div>
	
				</div>
			</div>
	
			<!-- Modal page: About Us -->
			<div id="modal">
				<div class="inner">
	
					<!-- Modal toggle -->
					<div class="modal-toggle">
						<a href="#" id="modal-close" title="Close">
							<i class="fas fa-times"></i>
						</a>
					</div>
	
					<!-- Content -->
					<section class="content">
						
						<h1 class="title">About <span>CommeHub</span></h1>
					
						<!-- Columns -->
						<div class="row">
							
							<div class="one-half">
								<p>CommeHub is a retailer/consumer focused social e-commerce company. We offer retailers and consumers a platform to share, connect and buy with other retailer/consumers who has similar interest on products.</p>
								<p>CommeHub consistently uses the collective purchasing capacity of it's community users; retailers and consumers alike to get products from vendor(s) at wholesale price for it's retailers and at huge discounts for it's general purpose consumers. </p>
								<p></p>
							</div>
							
							<div class="one-half">
								<h2><i class="fas fa-phone"></i> Phone</h2>
								<p>
									Phone: +234 (0) 8108529112<br />
								</p>
								
								<h2><i class="fas fa-envelope"></i> Email</h2>
								<p>
									<a href="#"><span class="__cf_email__" data-cfemail="3f5a525e56537f4c564b5a515e525a115c5052">inquiry@commehub.com</span></a>
								</p>
								
								<h2><i class="fas fa-map"></i> Address</h2>
								<p>
									Onitsha, Anambra State Nigeria
								</p>
							</div>
							
						</div>
	
					</section>
	
				</div>
			</div>
	
		</div>
	
		<!-- Background overlay -->
		<div class="body-bg"></div>
	
		<!-- Loader -->
		<div class="page-loader">
			<div class="progress">Loading...</div>
		</div>
	
	<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script></body>
	
	<!-- jQuery -->
	<script type="text/javascript" src="layout/plugins/jquery/jquery.js"></script>
	
	<!-- Plugins -->
	<script type="text/javascript" src="layout/plugins/backstretch/jquery.backstretch.min.js"></script>
	<script type="text/javascript" src="layout/plugins/plugin/jquery.plugin.min.js"></script>
	<script type="text/javascript" src="layout/plugins/countdown/jquery.countdown.min.js"></script>
	<script type="text/javascript" src="layout/plugins/validate/jquery.validate.min.js"></script>
	<script type="text/javascript" src="layout/plugins/placeholder/jquery.placeholder.min.js"></script>
	<script type="text/javascript" src="layout/plugins/tubular/jquery.tubular.js"></script>
	
	<!-- Main -->
    <script type="text/javascript" src="layout/js/main.js"></script>
	
	<!-- Settings (Remove it on your site) -->
	<script type="text/javascript" src="layout/plugins/settings/jquery.cookies.min.js"></script>
	<script type="text/javascript" src="layout/plugins/settings/settings.js"></script>
	

<!-- Mirrored from www.athenadesignstudio.com/themes/selene/image.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 19 Dec 2018 22:37:36 GMT -->
</html>