<?php

	// initialize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "Search Parks";
	$page["file_name"] = "search_parks.php";
	$page["is_user_only"] = false;
	$page["is_admin_only"] = false;
	
	
	// grab the set of parks to display
	$sql = "SELECT `p`.* FROM `park` AS `p` ";
	$sql .= "INNER JOIN `status` AS `s` ON `s`.`status_wk` = `p`.`status_wk` ";
	$sql .= "INNER JOIN `city` AS `c` ON `c`.`city_wk` = `p`.`city_wk` ";
	$sql .= "INNER JOIN `state` AS `st` ON `st`.`state_wk` = `c`.`state_wk` ";
	$sql .= "INNER JOIN `country` AS `cn` ON `cn`.`country_wk` = `st`.`country_wk` ";
	$sql .= "WHERE `p`.`is_deleted` = 0;";
	
	$body = display_park_table($sql);
	
	// include header
	require_once "header.php";


	// display the table
	echo $body;
	

	// include footer
	require_once "footer.php";

?>