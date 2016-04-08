<?php

	/*
		This class corresponds to the table 'state' in the database
	*/

	class State extends Database_Object
	{
		public static $table_name = "state";
		protected static $db_fields = array("state_wk", "country_wk", "name");
		
		public $state_wk;
		public $country_wk;
		public $name;
	}

?>