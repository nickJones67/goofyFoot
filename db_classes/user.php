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
	}

?>