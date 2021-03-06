<!DOCTYPE>
<?php
	session_start();
	include ("functions/functions.php");
	if (!isset($_SESSION['customer_email'])) {
			echo "<script>window.open('save.php', '_self')</script>";
		}else{
?>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <meta name="description" content="Nepal">
	    <meta name="author" content="Sulabh Shrestha">
	    <link rel="icon" href="favicon.ico">
	    <title>Beautiful Nepal</title>
	    <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>

	   	<!-- Custom Made CSS -->
		<link href="styles/mycss.css" rel="stylesheet" type="text/css">
		<link href="styles/footer.css" rel="stylesheet" type="text/css">
		
	    <!-- Bootstrap core CSS -->
	    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

  	</head>

  	<body>
  		<div class="main_wrapper" id="favo">	
  			<!-- Navigation Section -->
  			<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
			  	<div class="" ="navbar-header">
				    <a class="navbar-brand" href="index.php">Nepal</a>
			  	</div>
			  	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    	<ul class="nav navbar-nav">
				      	<li><a href="index.php">Home</a></li>
				      	<li><a href="pointofinterest.php">PointOfInterest</a></li>
				      	<li>
					      	<a href="
					      		<?php
									if (isset($_SESSION['customer_email'])) {
										echo "customer/my_account.php";
									}else{
										echo "save.php";
									}

								?>
					      		">My Account
					      	</a>
				      	</li>
				      	<li class="active"><a href="favourites.php">Favourites</a></li>
				      	<li>
				      		<a href="
						      	<?php
						      		if (isset($_SESSION['customer_email'])) {
										echo "customer_logout.php";
									}else{
										echo "customer_register.php";
									}
						      	?>
					      		">
					      		<?php
									if (isset($_SESSION['customer_email'])) {
										echo "Logout";
									}else{
										echo "Sign Up";
									}
								?>
					      	</a>
					    </li>
					    <li>
				      		<a href="
						      	<?php
						      		if (isset($_SESSION['customer_email'])) {
										echo "";
									}else{
										echo "save.php";
									}
						      	?>
					      		">
					      		<?php
									if (isset($_SESSION['customer_email'])) {
										echo "";
									}else{
										echo "Sign In";
									}
								?>
					      	</a>
					    </li>
					    <li>
				      		<a href="
						      	<?php
						      		if (isset($_SESSION['customer_email'])) {
										echo "";
									}else{
										echo "admin_area/login.php";
									}
						      	?>
					      		">
					      		<?php
									if (isset($_SESSION['customer_email'])) {
										echo "";
									}else{
										echo "Admin";
									}
								?>
					      	</a>
					    </li>
			    	</ul>
				    <div class="col-sm-3 col-md-3" id="fullSearchButton">
				        <form method="get" action="results.php" enctype="multipart/form-data" class="navbar-form" role="search">
					        <div class="input-group">
					            <input type="text" class="form-control" id="searchTextBox" placeholder="Search" name="user_query">
					            <div class="input-group-btn">
					                <button class="btn btn-default" type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
					                <!-- <input type="submit" name="search" value="Search"> -->
					            </div>
					        </div>
				        </form>
				    </div>
			  	</div>
			</nav>
			<!-- Body Section -->
			<div id="favouritesPage">
				<section id="portfolio" class="bg-light-gray">
					<div class="container">
					  	<div class="row">
							<div class="col-lg-12 text-center">
								<h2 class="section-heading">Favourites</h2>
								<h3 class="section-subheading text-muted">These are your reserved favourites from the various points of interests.</h3>
							</div>
						</div>
					</div>
				</section>
				<form action="" method="post" enctype="multipart/form-data"> 
					<table align="center">
						<tr align="center" >
							<th></th>
							<th></th>
						</tr>
						<!-- Getting the Favourites From Your Personal ID -->
						<?php
							global $con;
							$c_email = $_SESSION['customer_email'];
							$get_email = "select * from customers where customer_email = '$c_email'";
							$run_email = mysqli_query($con, $get_email);
							$row_email = mysqli_fetch_array($run_email);
							$c_id = $row_email['customer_id'];	//Got the id of he customer

							$get_highlight_id = "select * from favourites where customer_id = '$c_id' ";	
							//taking their customer id, from where we get the highlight id (1)
								
							$run_highlight_id = mysqli_query($con, $get_highlight_id);		//2

							while($get_favourite_id = mysqli_fetch_array($run_highlight_id)){	//getting the highlght id from the favourites
								$high_id = $get_favourite_id['favourite_id'];		//got the favurite id of many favourites that s/he 
								$high_check = "select * from highlights where highlight_id='$high_id'";	//checking for that highlight
								$run_high_check = mysqli_query($con, $high_check);
								//processing part for those individual id's name and short description
								$new_high_data = mysqli_fetch_array($run_high_check);
								$high_name = $new_high_data['highlight_name'];
								$high_address = $new_high_data['highlight_address'];
								$high_image = $new_high_data['highlight_image'];
								$high_short_description = $new_high_data['highlight_short_description'];
						?>
						<tr align="center">
							<td>
								<section id="portfolio" class="bg-light-gray">
									<div class="container">
										<div class="row">
											<div class="col-md-4 col-sm-4">
												<a href="#">
												    <a href=""><img src="admin_area/highlight_images/<?php echo "$high_image"; ?>" class="img-responsive" alt=""></a>
								                </a>
											</div>
											<div class="col-md-4 col-sm-4" >
												<p id="favMid"><?php echo "$high_name"; ?></p>
												<p id="favMid"><?php echo "$high_short_description"; ?></p>
											</div>
											<div class="col-md-4 col-sm-4">
												<span id="deleteOption">Delete this highlight?</span>
												<input type="checkbox" name="remove[]" value="<?php echo $high_id; ?>" />	
											</div>
											<br />
											<br />
										</div>
									</div>
								</section>
								<br />
											<br />
							</td>
						</tr>
						<?php 	}  ?>	<!-- These are the braces of the while loop from getting the favourites -->
						<tr>
							<td><input type="submit" name="delete_favourites" id="deleteButton" class="btn btn-primary btn-block" value="Delete Favourites"></td>
							<br />
						</tr>
					</table>
					<br />
					<br />
				</form>
				<!-- For Deleting Favourites -->
				<?php
					global $con;
					$c_email = $_SESSION['customer_email'];
					$get_email = "select * from customers where customer_email = '$c_email'";
					$run_email = mysqli_query($con, $get_email);
					$row_email = mysqli_fetch_array($run_email);
					$c_id = $row_email['customer_id'];
			
					if (isset($_POST['delete_favourites'])) {
						if (isset($_POST['remove'])) {
							foreach ($_POST['remove'] as $remove_id) {
								$delete_highlight = "delete from favourites where favourite_id = '$remove_id' AND customer_id = '$c_id'";
								$run_delete = mysqli_query($con, $delete_highlight);
								if ($run_delete){
									echo "<script>window.open('favourites.php', '_self')</script>";
								}
							}
						}else{
							echo "<script>alert('You Have Not Selected Any Favourites!')</script>";
						}
					}
				?>
			</div>
			<!-- Footer Section -->
			<footer>
				<div class="container">
				    <div class="row">
				      	<div class="col-md-4 col-sm-6 footerleft ">
					        <div class="logofooter"> Nepal </div>
					        <p>Officially the Federal Democratic Republic of Nepal is a landlocked central Himalayan country in South Asia. It has a population of 26.4 million and is the 93rd largest country by area. Bordering China in the north and India in the south, east, and west, it is the largest sovereign Himalayan state.</p>
					        <p><i class="fa fa-map-pin"></i> Total Area: 147,181 km2 (56,827 sq mi) (95th). <br />Population: 26,494,504</p>
					        <p><i class="fa fa-phone"></i> Capital: Kathmandu</p>
					        <p><i class="fa fa-envelope"></i> Republic declared: 28 May 2008</p>
				    	</div>
					    <div class="col-md-2 col-sm-6 paddingtop-bottom">
					        <h6 class="heading7">GENERAL LINKS</h6>
					        <ul class="footer-ul">
					          <li><a href="#"> Career</a></li>
					          <li><a href="#"> Privacy Policy</a></li>
					          <li><a href="#"> Terms & Conditions</a></li>
					          <li><a href="#"> Client Gateway</a></li>
					          <li><a href="#"> Ranking</a></li>
					          <li><a href="#"> Case Studies</a></li>
					          <li><a href="#"> Frequently Ask Questions</a></li>
					        </ul>
					    </div>
					    <div class="col-md-3 col-sm-6 paddingtop-bottom">
					        <h6 class="heading7">LATEST POST</h6>
					        <div class="post">
					          <p> Nepal declared a secular state for the first time <span>August 3,2016</span></p>
					          <p> Reserve Bank of India To Give Nepal Rs. 1 Billion In 100-Rupee Notes <span>September 30,2016</span></p>
					          <p> Nepal fails to reach final for the first time <span>January 3,2017</span></p>
					        </div>
					    </div>
					    <div class="col-md-3 col-sm-6 paddingtop-bottom">
					        <div class="fb-page" data-href="https://www.facebook.com" data-tabs="timeline" data-height="300" data-small-header="false" style="margin-bottom:15px;" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
					          	<div class="fb-xfbml-parse-ignore">
					            	<blockquote cite="https://www.facebook.com"><a href="https://www.facebook.com">Facebook</a></blockquote>
					          	</div>
					        </div>
					        <div data-href="https://www.twitter.com" data-tabs="timeline" data-height="300" data-small-header="false" style="margin-bottom:15px;" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
					          	<div class="fb-xfbml-parse-ignore">
					            	<blockquote cite="https://www.twitter.com"><a href="https://www.twitter.com">Twitter</a></blockquote>
					          	</div>
					        </div>
					        <div class="fb-page" data-href="https://www.linkedln.com" data-tabs="timeline" data-height="300" data-small-header="false" style="margin-bottom:15px;" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
					          	<div class="fb-xfbml-parse-ignore">
					            	<blockquote cite="https://www.linkedln.com"><a href="https://www.linkedln.com">Linkedln</a></blockquote>
					          	</div>
					        </div>
					    </div>
				    </div>
				</div>
			</footer>
			<div class="copyright">
				<div class="container">
				    <div class="col-md-6">
				      <p>© 2017 - All Rights Received</p>
				    </div>
					<div class="col-md-6">
					    <ul class="bottom_ul">
					        <li><a href="#">nepal.com</a></li>
					        <li><a href="#">About us</a></li>
					        <li><a href="#">Blog</a></li>
					        <li><a href="#">Faq's</a></li>
					        <li><a href="#">Contact us</a></li>
					        <li><a href="#">Site Map</a></li>
					    </ul>
					</div>
				</div>
			</div>
	    </div>
     	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="dist/js/bootstrap.min.js"></script>   
  	</body>
</html>

<?php } ?> <!-- bracket of else from the top of the page -->
