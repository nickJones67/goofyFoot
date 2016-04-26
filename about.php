<?php

	// initialize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "About Us";
	$page["is_user_only"] = false;
	$page["is_admin_only"] = false;
	
	// include header
	require_once "header.php";
	
?>
	<head>
    <!-- Custom CSS -->
	<link href="css/templatemo_style.css" rel="stylesheet">
   	<link rel="stylesheet" href="css/templatemo_misc.css">
    <link href="css/about-custom.css" rel="stylesheet">
	</head>
	
	<!-- Error message -->
	<p id="message"><?php echo $_SESSION['message']; ?></p>
	
    <!-- Main Content -->
	<div class="content">
				<section id="about-section-1">
					<br>
					<h1>About Skate View</h1>
					<h3 class="dropcase2">Skate View is a skate park review website where users can find, post, review and comment on skate parks in their local area. We are a community-centric non-profit organization dedicated to bringing skateboarding enthusiasts together. </h3>
					<h3><a href=\"create_new_user.php\">Join Skate View </a> today to immediately begin receiving email notifications when parks or reviews are added in your local area!</h3>
					<br><br><br><br>
				</section>				
				
				<section id="about-section-2">
					<div class="about-background-2">
						<br>
						<h1>Meet the Team</h1>
						<br>
						<div class="container">
							<div class="row">
								<div id="small-img" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center">
									<ul class="list-inline text-center">
										<li>
											<span >
												<img alt="member 1" src="img/members/member1.jpg" class="img-responsive inline-block img-circle" width="150px" height="150px">
											</span>
										</li>
										<li>
											<span >
												<img alt="member 2" src="img/members/member2.jpg" class="img-responsive inline-block img-circle" width="150px" height="150px">
											</span>
										</li>
										<li>
											<span >
												<img alt="member 3" src="img/members/member3.jpg" class="img-responsive inline-block img-circle" width="150px" height="150px">
											</span>
										</li>
										<li>
											<span >
												<img alt="member 4" src="img/members/member4.jpg" class="img-responsive inline-block img-circle" width="150px" height="150px">
											</span>
										</li>
										<li>
											<span >
												<img alt="member 5" src="img/members/member5.jpg" class="img-responsive inline-block img-circle" width="150px" height="150px">
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<br>
						<h3>From left to right - Project Lead Adam Drew, Jason Ball, Nicholas Jones, John Nelson, and Michael Smith</h3>
					</div>
				</section>
				
				<section id="about-section-3">
					<br>
					<h1>Our Founding</h1>
					<p class="dropcase">Skate View was founded by a team of five UNF computer science students with a shared passion for skateboarding and web development. Many skaters face a common obstacle; they don't know where they can skate. To solve this problem we set out to create a skate park review website that simplified the process of finding skate parks in your local area - Skate View. </p>
					<br><br>
				</section>
				
				<section id="about-section-4">
					<br>
					<h1>Mission Statement</h1>
					<p>Bringing the best spots to you - with a friendly blog-like interface and social media integration. </p>
					<br><br>
				</section>
				
				<section id="about-section-5">
					<div class="about-background-1">
						<br>
						<h1>Reasons to Choose Us?</h1>
						<p class="dropcase">Skate View is the only place where skaters can share local skate parks and review them for the convenience of others. Additionally Skate View is easy to use and provides park information in an easy to understand format. We have a small but rapidly growing community of avid enthusiasts and casual skaters alike. </p>
						<br><br>
					</div>
				</section>
				
				<section id="about-section-6">
					<br>
					<h1>Our Partners</h1>
					<br>
						<div class="container">
							<div class="row">
								<div id="small-img" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center">
									<ul class="list-inline text-center">
										<li>
											<a href="#">
												<span >
													<img alt="partner 1" src="img/partners/partner1.jpg" class="img-responsive inline-block">
												</span>
											</a>
										</li>
										<li>
											<a href="#">
												<span >
													<img alt="partner 2" src="img/partners/partner2.jpg" class="img-responsive inline-block">
												</span>
											</a>
										</li>
										<li>
											<a href="#">
												<span >
													<img alt="partner 3" src="img/partners/partner3.jpg" class="img-responsive inline-block">
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					<br><br><br>
				</section>
				
				<section id="about-section-7">
					<br>
					<h1>Contact Us</h1>	
					<p>Drop us a line! We're glad to answer any questions and concerns.</p>
						<div class="container">
							<div class="clear"></div>
							<div class="container">
						<div class="row">
						  <div class="col-md-12">
							<div class="_maps">
							  <div class="fluid-wrapper">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12084.143170610365!2d-73.96770330299584!3d40.783227259584116!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2589a018531e3%3A0xb9df1f7387a94119!2sCentral+Park!5e0!3m2!1sen!2s!4v1391601567888"></iframe> 
							  </div>
							</div>
						  </div>
						  <div class="container">
						<div class="row">
						  <div class="col-md-3">
							<form role="form">
							  <div class="form-group">
								<input name="fullname" type="text" class="form-control" id="fullname" placeholder="Your Name" maxlength="30">
							  </div>
							  <div class="form-group">
								<input name="email" type="text" class="form-control" id="email" placeholder="Your Email" maxlength="30">
							  </div>
							  <div class="form-group">
								<input name="subject" type="text" class="form-control" id="subject" placeholder="Your Subject" maxlength="40">
							  </div>
							  <div><button type="button" class="btn btn-primary">Send Message</button></div>
							</form>
						  </div>
						  <div class="col-md-9">
							<div class="txtarea">
							  <textarea name="message" rows="10" class="form-control" id="message"></textarea>
							</div>
						  </div>
						</div>
					  </div>
						</div>
					  </div>
						</div>	
					<br><br>
				</section>
	</div>

<?php 
	
	// reset error messages
	$_SESSION['message'] = "";
	
	// include footer
	require_once "footer.php"; 
	
?>
