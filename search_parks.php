<?php

	// initialize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "Search Parks";
	$page["file_name"] = "search_parks.php";
	$page["is_user_only"] = false;
	$page["is_admin_only"] = false;
	
	
	// get the user's current location
	$user_ip = $_SERVER['REMOTE_ADDR'];
	//if (file_exists ("http://ipinfo.io/".$user_ip."/json")) {
		$request = file_get_contents("http://ipinfo.io/".$user_ip."/json");
		$geo = json_decode($request);
		
		// find the parks in the city and state of the client
		$sql = "SELECT `p`.* FROM `park` AS `p` ";
		$sql .= "INNER JOIN `status` AS `s` ON `s`.`status_wk` = `p`.`status_wk` ";
		$sql .= "INNER JOIN `city` AS `c` ON `c`.`city_wk` = `p`.`city_wk` ";
		$sql .= "INNER JOIN `state` AS `st` ON `st`.`state_wk` = `c`.`state_wk` ";
		$sql .= "INNER JOIN `country` AS `cn` ON `cn`.`country_wk` = `st`.`country_wk` ";
		$sql .= "WHERE `p`.`is_deleted` = 0 ";
		$sql .= ( isset($geo->city) && $geo->city != NULL ? "AND `c`.`name` = '{$geo->city}' " : " " );
		$sql .= ( isset($geo->region) && $geo->region != NULL ? "AND `st`.`name` = '{$geo->region}' " : " " );
		$sql .= "LIMIT 4";
		$sql .= ";";
		
		$nearby_parks = display_park_table($sql);
	//}
	
	// grab the set of all parks to display
	$sql = "SELECT `p`.* FROM `park` AS `p` ";
	$sql .= "INNER JOIN `status` AS `s` ON `s`.`status_wk` = `p`.`status_wk` ";
	$sql .= "INNER JOIN `city` AS `c` ON `c`.`city_wk` = `p`.`city_wk` ";
	$sql .= "INNER JOIN `state` AS `st` ON `st`.`state_wk` = `c`.`state_wk` ";
	$sql .= "INNER JOIN `country` AS `cn` ON `cn`.`country_wk` = `st`.`country_wk` ";
	$sql .= "WHERE `p`.`is_deleted` = 0 ";
	$sql .= ";";
	
	$body = display_park_table($sql);
	
	
	// include header
	require_once "header.php";

	
	echo "<!-- Error message -->";
	echo "<p id=\"message\">".$_SESSION['message']."</p>";
	
	/*
		display the tables
	*/

	if ( (isset($geo->city) || isset($geo->region)) && $nearby_parks != "<p><em>Your search returned 0 park(s).</em></p>")
	{
		echo "<h2>Closest to you...</h2>";
		echo $nearby_parks;
		echo "<br /><hr /><br />";
	}
	
	echo "<h2>All Parks</h2>";
	echo $body;
	
	
	// reset error messages
	$_SESSION['message'] = "";
	
	// include footer
	require_once "footer.php";

?>