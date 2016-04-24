<?php

	// initialize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "Login";
	$page["file_name"] = "user_login.php";
	$page["is_user_only"] = false;
	$page["is_admin_only"] = false;

	
	// check to see if a user is already logged in
	if (isset($_SESSION['user_wk'])) 
	{
		$_SESSION['message'] = "You are already logged in! To change users please logout first.";
		header("Location: index.php");
		die();
	}
	
	// user login
	if (isset($_POST['submit']))
	{
		User::login($_POST["username"], $_POST["password"]);
	}
	
	
	// include header
	require_once "header.php";
	
?>

	<h2>Login</h2>
	
	<!-- Error message -->
	<p id="message"><?php echo $_SESSION['message']; ?></p>
	
	<!-- Login form -->
	<form action="<?php echo $page['file_name']; ?>" method="post">
		<input type="text" name="username" placeholder="Username" /><br />
		<input type="password" name="password" placeholder="Password" /><br />
		<input type="submit" value="Login" name="submit" />
	</form>
	
	<!-- Create new user -->
	<p>No account? <a href="create_new_user.php">Create a new account!</a></p>

<?php

	// reset error messages
	$_SESSION['message'] = "";

	// include footer
	require_once "footer.php";

?>