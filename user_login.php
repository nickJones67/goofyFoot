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

	<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
					<h2>Login</h2>
	
					<!-- Error message -->
					<p id="message"><?php echo $_SESSION['message']; ?></p>
					
					<!-- Login form -->
					<form action="<?php echo $page['file_name']; ?>" method="post">
						<input type="text" name="username" placeholder="Username" tabindex=1/><br />
						<input type="password" name="password" placeholder="Password" tabindex=2/><br />
						<input type="submit" value="Login" name="submit" tabindex=3/>
					</form>
					
					<!-- Create new user -->
					<p>No account? <a href="create_new_user.php">Create a new account!</a></p>
			</div>
		</div>
	</div>
	
<?php

	// reset error messages
	$_SESSION['message'] = "";

	// include footer
	require_once "footer.php";

?>