<?php

	/*
		This class corresponds to the table 'role' in the database
	*/

	class Role extends Database_Object
	{
		public static $table_name = "role";
		protected static $db_fields = array("role_wk", "name");
		
		public $role_wk;
		public $name;
	}

?>