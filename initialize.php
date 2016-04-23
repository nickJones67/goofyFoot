<?php

	/*
		Set up everything for each PHP page
	*/
	
	// Get constants
	require_once "constants.php";
	
	// Establish database connection
	require_once "db_connect.php";
	
	// Get database object class
	require_once "database_object.php";
	
	// Get all of the database classes
	require_once "db_classes/city.php";
	require_once "db_classes/comment.php";
	require_once "db_classes/country.php";
	require_once "db_classes/image.php";
	require_once "db_classes/log.php";
	require_once "db_classes/park.php";
	require_once "db_classes/reset_password.php";
	require_once "db_classes/role.php";
	require_once "db_classes/state.php";
	require_once "db_classes/status.php";
	require_once "db_classes/user.php";
	
	// start the session
	session_start();
	
?>