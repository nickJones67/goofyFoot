<?php

	/*
		This class corresponds to the table 'log' in the database
	*/

	class Log extends Database_Object
	{
		public static $table_name = "log";
		protected static $db_fields = array("log_wk", "user_wk", "url", "ip");
		
		public $log_wk;
		public $user_wk;
		public $url;
		public $ip;
	}

?>