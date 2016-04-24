<?php

	// initialize page
	require_once "initialize.php";

	// logout
	unset($_SESSION['user_wk']);
	unset($_SESSION['user_name']);
	
	//close connection
	if(isset($mysqli_connection)) 
		mysqli_close($mysqli_connection);
	
	$_SESSION['message'] = "You were successfully logged out.<br>";
	header("Location: index.php");
	die();
		
?>