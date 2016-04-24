<?php

	// initialize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "View Park";
	$page["file_name"] = "view_park.php";
	$page["is_user_only"] = false;
	$page["is_admin_only"] = false;

	
	// check if pet_wk is set
	if (!isset($_GET["park_wk"])) 
	{
		$session->message("There is an error with the park you were trying to view.");
		header("Location: index.php");
		die();
	}
	
	// get the park info
	$park = Park::find_by_id($_GET["park_wk"]);	

	
	// check that the park_wk exists
	if (!$park) 
	{
		$session->message("There is an error with the park you were trying to view.");
		header("Location: index.php");
		die();
	}
	
	// check if the pet is deleted
	if ($park->is_deleted == "1") 
	{
		$session->message("The park you are trying to view has been deleted.");
		header("Location: index.php");
		die();
	}
	
	
	// include the header
	require_once "header.php";
	
?>
	
	<!-- Park name -->
	<h2><?php echo $park->name; ?></h2>
	
	<!-- Error message -->
	<p id="message"><?php echo $_SESSION['message']; ?></p>
	
	<!-- Picture of the park -->
	<p><img src="uploads/<?php echo $park->image_wk->file_name; ?>"><br /></p>
	
	<!-- Park info -->
	<label>Status: </label><?php echo ucwords($park->status_wk->name); ?><br />
	<label>Address: </label><?php echo $park->address; ?><br />
	<label>Country: </label><?php echo $park->city_wk->state_wk->country_wk->name; ?><br />
	<label>State/Province: </label><?php echo $park->city_wk->state_wk->name; ?><br />
	<label>City: </label><?php echo $park->city_wk->name; ?><br />
	
	<hr />
	
	<!-- Comments -->
	
<?php

	// reset error messages
	$_SESSION['message'] = "";

	// include the footer
	require_once "footer.php";

?>