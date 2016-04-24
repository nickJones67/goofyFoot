<?php

	/*
		This class corresponds to the table 'park' in the database
	*/

	class Park extends Database_Object
	{
		public static $table_name = "park";
		protected static $db_fields = array("park_wk", "image_wk", "status_wk", "city_wk", "address", "name", "is_deleted");
		
		public $park_wk;
		public $image_wk;
		public $status_wk;
		public $city_wk;
		public $address;
		public $name;
		public $is_deleted;
	}

	
	//function to display the pet table based on results
	function display_park_table($sql, $is_folder = false) {
		global $mysqli_connection;
		global $session;
		$return = "";
		
		
		// get all of the parks
		$parks = Park::find_by_sql($sql);
		
		
		//only display the table with results if
		//there are more than 0 parks
		if(count($parks) > 0) 
		{
			$return = "<table style=\"width:100%\">
								<tr>
									<th></th>
									<th>Name</th>
									<th>City</th>
									<th>State</th>
									<th>Country</th>
									<th>Status</th>";
			$return .= "</tr>";
			
			
			// loop through all parks
			foreach($parks as $value) 
			{
				$return .= "<tr id=\"".$value."_row\">
									<td><img src=\"";
				if($is_folder) 		$return .= 	"../";
				$return .= 			"uploads/".$value->image_wk->file_name."\" style=\"width:75px;height:75px;\" ></td>
									<td><a href=\"".ROOT_URL."view_park.php?park_wk=".$value->park_wk."\">".$value->name."</a></td>
									<td>".$value->city_wk->name."</td>		
									<td>".$value->city_wk->state_wk->name."</td>
									<td>".$value->city_wk->state_wk->country_wk->name."</td>
									<td>".$value->status_wk->name."</td>";					
				$return .= "</tr>";
			}					
			$return .= "</table>";
		}
		$return .= "<p><em>Your search returned ".count($parks)." park(s).</em></p>";
		
		return $return;
	}
	
?>