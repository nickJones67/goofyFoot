<?php

	// initialize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "Homepage";
	$page["is_user_only"] = false;
	$page["is_admin_only"] = false;
	
	// include header
	require_once "header.php";
	
?>

	<!-- Error message -->
	<p id="message"><?php echo $_SESSION['message']; ?></p>

	
	<!-- Display nearby parks -->
	<?php
		// get the client's location
		$user_ip = $_SERVER['REMOTE_ADDR'];
		if (file_exists ("http://ipinfo.io/".$user_ip."/json")) {
			$request = file_get_contents("http://ipinfo.io/".$user_ip."/json");
			$geo = json_decode($request);
			
			// find the parks in the city and state of the client
			$sql = "SELECT `p`.* FROM `park` AS `p` ";
			$sql .= "INNER JOIN `status` AS `s` ON `s`.`status_wk` = `p`.`status_wk` ";
			$sql .= "INNER JOIN `city` AS `c` ON `c`.`city_wk` = `p`.`city_wk` ";
			$sql .= "INNER JOIN `state` AS `st` ON `st`.`state_wk` = `c`.`state_wk` ";
			$sql .= "INNER JOIN `country` AS `cn` ON `cn`.`country_wk` = `st`.`country_wk` ";
			$sql .= "WHERE `p`.`is_deleted` = 0 ";
			$sql .= ( $geo->city != NULL ? "AND `c`.`name` = '{$geo->city}' " : " " );
			$sql .= ( $geo->region != NULL ? "AND `st`.`name` = '{$geo->region}' " : " " );
			$sql .= "LIMIT 4";
			$sql .= ";";
			
			$nearby_parks = display_park_table($sql);
			
			echo "
			<div class=\"container\">
				<div class=\"row\">
					<div class=\"col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1\">
						<h2>Parks near you...</h2>
						".$nearby_parks."
					</div>
				</div>
			</div>
			";
		}
	?>
	
	
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <a href="post.html">
                        <h2 class="post-title">
                            Sample Skatepark Post
                        </h2>
                        <h3 class="post-subtitle">
							Example Description
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#">John Doe</a> on September 24, 2014</p>
                </div>
                <hr>

                <hr>

                <hr>

                <hr>
                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<?php 
	
	// reset error messages
	$_SESSION['message'] = "";
	
	// include footer
	require_once "footer.php"; 
	
?>
