<?php

	/*
		This class corresponds to the table 'comment' in the database
	*/

	class Comment extends Database_Object
	{
		public static $table_name = "comment";
		protected static $db_fields = array("comment_wk", "park_wk", "user_wk", "body", "is_flagged");
		
		public $comment_wk;
		public $park_wk;
		public $user_wk;
		public $body;
		public $is_flagged;
	}

?>