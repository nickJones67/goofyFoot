<?php

	// initiallize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "Create Account";
	$page["file_name"] = "create_new_user.php";
	$page["is_user_only"] = false;
	$page["is_admin_only"] = false;
	
	// check to see if a user is already logged in
	if (isset($_SESSION['user_wk'])) 
	{
		$_SESSION['message'] = "You are already logged in! To create a new account, please logout first.";
		header("Location: ".ROOT_URL);
		die();
	}
	
	
	// if the form is submitted, attempt to create their new user account
	if(isset($_POST["submit"])) 
	{
		$new_user = new User();
		
		$new_user->user_name = $_POST['user_name'];
		$new_user->role_wk = '2'; // user
		$new_user->hashed_password = sha1($_POST['password']);
		$confirmed_password = sha1($_POST['confirmed_password']);
		$new_user->first_name = $_POST['first_name'];
		$new_user->last_name = $_POST['last_name'];
		$new_user->email = $_POST['email'];

		
		// make sure the username does not already exist
		if (User::find_by_name($new_user->user_name, "user_name")) 
		{
			$_SESSION['message'] = "That username is already taken, please enter a new username. ";
			$new_user->user_name = "";
		}
		
		// make sure the email address is not already taken
		if (User::find_by_name($new_user->email, "email")) 
		{
			$_SESSION['message'] = "That email address is already taken, please enter a new email address. ";
			$new_user->email = "";
		}
		
		// make sure passwords are the same
		if($new_user->hashed_password != $confirmed_password) 
		{
			$_SESSION['message'] = "The passwords you entered do not match.";
		}
		
		// only actually create the user if there are no errors
		if($_SESSION['message'] == "") 
		{
			if($new_user->create()) 
			{
				$_SESSION['message'] = "Your account was created successfully!";
				header("Location: user_login.php");
				die();
			} 
			else 
			{
				$_SESSION['message'] = "Your account was not created successfully.";
			}
		}
	}
	
	// include header
	require_once "header.php";
		
	?>
	
	<h2>Create an Account</h2>
	
	<!-- Error message -->
	<p id="message"><?php echo $_SESSION['message']; ?></p>
	
	
	<!-- create new user form -->
	<form action="<?php echo $page['file_name']; ?>" method="post">
		<input type="text" name="user_name" placeholder="Username" /><br />
		<input type="text" name="email" placeholder="Email" /><br />
		<input type="password" name="password" placeholder="Password" /><br />
		<input type="password" name="confirmed_password" placeholder="Confirm Password" /><br />
		<input type="text" name="first_name" placeholder="First Name" /><br />
		<input type="text" name="last_name" placeholder="Last Name" /><br />
		<input type="submit" value="Create" name="submit" >
	</form>
	
<?php

	// reset error messages
	$_SESSION['message'] = "";

	// include footer
	require_once "footer.php";

?>