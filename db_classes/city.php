<?php

	/*
		This class corresponds to the table 'city' in the database
	*/

	class City extends Database_Object
	{
		public static $table_name = "city";
		protected static $db_fields = array("city_wk", "state_wk", "name");
		
		public $city_wk;
		public $state_wk;
		public $name;
	}

?>