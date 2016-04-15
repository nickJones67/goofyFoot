<?php

	/*
		This is a page to perform AJAX processing for the "add_park.php" page
		to populate the state form field when the user selects a country.
	*/
	
	
	// initialize
	require_once "initialize.php";
	
	
	// if the default <option> is selected, return nothing
	if ($_POST["c"] == "default")
	{
		echo "";
	}
	else // get all states in the country: $_POST["c"]
	{
		$sql = "SELECT * FROM `state` WHERE `country_wk` = {$_POST["c"]};";
		$states = State::find_by_sql($sql);
		$response = "<option value=\"default\" selected>Select a State/Province</option>";
		
		foreach ($states as $state)
			$response .= "<option value=\"{$state->state_wk}\">{$state->name}</option>\n";
		
		echo $response;
	}

?>