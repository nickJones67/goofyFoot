<?php

	/*
		This class corresponds to the table 'reset_password' in the database
	*/

	class Reset_Password extends Database_Object
	{
		public static $table_name = "reset_password";
		protected static $db_fields = array("reset_password_wk", "user_wk", "random_key", "is_reset");
		
		public $reset_password_wk;
		public $user_wk;
		public $random_key;
		public $is_reset;
	}

?>