<?php

	/*
		This class corresponds to the table 'image' in the database
	*/

	class Image extends Database_Object
	{
		public static $table_name = "image";
		protected static $db_fields = array("image_wk", "park_wk", "file_name", "is_deleted");
		
		public $image_wk;
		public $park_wk;
		public $file_name;
		public $is_deleted;
	}

?>