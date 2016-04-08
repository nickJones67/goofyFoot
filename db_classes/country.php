<?php

	/*
		This class corresponds to the table 'country' in the database
	*/

	class Country extends Database_Object
	{
		public static $table_name = "country";
		protected static $db_fields = array("country_wk", "name");
		
		public $country_wk;
		public $name;
	}

?>