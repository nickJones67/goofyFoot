<?php

	/*
		This is a page to perform AJAX processing for the "add_park.php" page
		to populate the city form field when the user selects a state.
	*/
	
	
	// initialize
	require_once "initialize.php";
	
	 
	// if the default <option> is selected, return nothing
	if ($_POST["s"] == "default")
	{
		echo "";
	}
	else // get all cities in the state: $_POST["s"]
	{
		$sql = "SELECT * FROM `city` WHERE `state_wk` = {$_POST["s"]};";
		$cities = City::find_by_sql($sql);
		$response = "<option value=\"default\" selected>Select a City</option>";
		
		foreach ($cities as $city)
			$response .= "<option value=\"{$city->city_wk}\">{$city->name}</option>\n";
		
		echo $response;
	}
	 
	 

?>