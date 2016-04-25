<?php

	// initialize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "View Park";
	$page["file_name"] = "view_park.php";
	$page["is_user_only"] = false;
	$page["is_admin_only"] = false;

	
	// check if park_wk is set
	if (!isset($_GET["park_wk"])) 
	{
		$_SESSION['message'] = "There is an error with the park you were trying to view.";
		header("Location: index.php");
		die();
	}
	
	// get the park info
	$park = Park::find_by_id($_GET["park_wk"]);	
	
	
	// check that the park_wk exists
	if (!$park) 
	{
		$_SESSION['message'] = "There is an error with the park you were trying to view.";
		header("Location: index.php");
		die();
	}
	
	// check if the pet is deleted
	if ($park->is_deleted == "1") 
	{
		$_SESSION['message'] = "The park you are trying to view has been deleted.";
		header("Location: index.php");
		die();
	}
	
	
	/*
		New comments form processing
	*/
	
	if (isset($_POST['submit']))
	{
		// make sure the user is logged in
		if (!isset($_SESSION['user_wk']))
		{
			$_SESSION['message'] = "Your comment was not added successfully.<br />";
			header("Location: ".$page['file_name']."?park_wk=".$_GET['park_wk']);
			die();
		}
		
		$new_comment = new Comment();
		$new_comment->user_wk = $_SESSION['user_wk'];
		$new_comment->park_wk = $park->park_wk;
		$new_comment->body = $_POST['body'];
		
		// attempt to save
		if ($new_comment->create()) 
		{
			$_SESSION['message'] = "Your comment was added successfully!<br />";
			header("Location: ".$page['file_name']."?park_wk=".$_GET['park_wk']);
			die();		
		} 
		else 
		{
			// the comment did not save successfully, for whatever reason
			$_SESSION['message'] = "Your comment was not added successfully.<br />";
			header("Location: ".$page['file_name']."?park_wk=".$_GET['park_wk']);
			die();		
		}
	}
	
	
	/*
		Flag comments form processing
	*/
	
	if (isset($_GET['flag_comment_wk'])) 
	{
		// make sure user has access to do this
		if (!isset($_SESSION['user_wk'])) 
		{
			$_SESSION['message'] = "You do not have sufficient rights to flag this comment.";
			header("Location: ".$page['file_name']."?park_wk=".$_GET['park_wk']);
			die();		
		}
		
		// first, make sure the comment exists
		$comment_to_flag = Comment::find_by_id($_GET['flag_comment_wk']);
		if (!$comment_to_flag) 
		{
			// if the item does not exist in the database
			$_SESSION['message'] = "You must've clicked on a bad URL; please try again.";
			header("Location: ".$page['file_name']."?park_wk=".$_GET['park_wk']);
			die();
		}
		
		// now we make sure the comment is not already flagged
		if ($comment_to_flag->is_flagged == '1') 
		{
			$_SESSION['message'] = "That comment is already flagged.";
			header("Location: ".$page['file_name']."?park_wk=".$_GET['park_wk']);
			die();
		}
		
		// if we're here, go ahead and flag the comment
		$comment_to_flag->is_flagged = 1;
		if ($comment_to_flag->update()) 
		{
			$_SESSION['message'] = "The comment was successfully flagged.";
			header("Location: ".$page['file_name']."?park_wk=".$_GET['park_wk']);
			die();
		}
	}
	
	
	// get the park comments
	$park->get_my_comments();
	
	
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
	// display the comments here
	if (empty($park->comment)) 
	{
		// if there are no comments for this park 
		echo "<p><em>There are no comments.</em></p>";
	} 
	else 
	{
		// loop through each comment
		foreach ($park->comment AS $value) 
		{
			echo "<p><strong>".$value->user_wk->user_name."</strong><i> said</i>";
			
			// flag comments section
			// display the links to update the park for admins/staff
			if (isset($_SESSION['user_wk']))	
			{
				echo " <a href=\"".$page["file_name"]."?park_wk=".$_GET['park_wk']."&flag_comment_wk=".$value->comment_wk."\"><img src=\"img/flag.png\" atl=\"Flag\"></a>";
			}
			
			echo "<br />".$value->body;
			echo "<p>";
		}
	}
	
	
	// Create new comment (only for logged in users)
	if(isset($_SESSION['user_wk'])) {
		echo "<br />
		<!-- form -->
		<form action=\"".$page['file_name']."?park_wk=".$_GET['park_wk']."\" method=\"post\">
			<textarea name=\"body\" cols=\"45\" rows=\"5\" placeholder=\"enter a new comment\"/></textarea><br />
			<input type=\"submit\" value=\"Comment\" name=\"submit\"/>
		</form>";
	}
	

	// reset error messages
	$_SESSION['message'] = "";

	// include the footer
	require_once "footer.php";

?>