<?php

	/*
		This class corresponds to the table 'park' in the database
	*/

	class Park extends Database_Object
	{
		public static $table_name = "park";
		protected static $db_fields = array("park_wk", "status_wk", "city_wk", "address", "name", "is_deleted");
		
		public $park_wk;
		public $status_wk;
		public $city_wk;
		public $address;
		public $name;
		public $is_deleted;
	}

?>