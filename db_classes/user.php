<?php

	/*
		This class corresponds to the table 'user' in the database
	*/

	class User extends Database_Object
	{
		public static $table_name = "user";
		protected static $db_fields = array("user_wk", "role_wk", "first_name", "last_name", "user_name", "hashed_password", "email", "is_deleted");
		
		public $user_wk;
		public $role_wk;
		public $first_name;
		public $last_name;
		public $user_name;
		public $hashed_password;
		public $email;
		public $is_deleted;
		
		
		// login script
		public static function login($user_name="", $password="") 
		{
			// will retrieve user credentials if username and password are a match
			// if a match, it will spit out 1 user object
			// if not a match, it will return false
			global $mysqli_connection;
			global $page_file_name_with_get;
			global $page;
			$password = sha1($password);
		
			$sql  = "SELECT * FROM `".self::$table_name."` ";
			$sql .= "WHERE `user_name` = '{$user_name}' ";
			$sql .= "AND `hashed_password` = '{$password}' ";
			$sql .= "LIMIT 1;";
			$result_array = self::find_by_sql($sql);
			
			// if soft deleted, display error message
			if (!empty($result_array)) 
			{
				$user = array_shift($result_array);
				
				if ($user->is_deleted == 1) 
				{
					// account was found, but is disabled
					$_SESSION['message'] = $user->user_name.", your account has been disabled. If you feel this is an error please contact the administrator.<br>";
					header("Location: index.php");
					die();
					return false;
				} 
				else 
				{
					// successfully logged in
					$_SESSION['message'] = "Successfully logged in!";
					$_SESSION['user_wk'] = $user->user_wk;
					$_SESSION['user_name'] = $user->user_name;
					header("Location: index.php");
					die();
				}
			}
			//the username password combination does not exist

			$_SESSION['message'] = "The username and password combination does not exist.<br>";
			header("Location: ".$page['file_name']);
			die();
			return false;
		}
		
	}
	
	
	

?>