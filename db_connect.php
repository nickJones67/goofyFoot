<?php
	
	// Create MySQL access
	$mysqli_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
	
	if(!$mysqli_connection)
	{
		die('Could not connect: ' . mysqli_error($mysqli_connection));
    }
	
?>