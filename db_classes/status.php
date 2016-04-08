<?php

	/*
		This class corresponds to the table 'status' in the database
	*/

	class Status extends Database_Object
	{
		public static $table_name = "status";
		protected static $db_fields = array("status_wk", "name");
		
		public $status_wk;
		public $name;
	}

?>