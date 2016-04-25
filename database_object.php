<?php

	/*
		This abstract class provides all of the operations associated with the database classes
	*/
	
	abstract class Database_Object
	{
		// Find object by sql
		public static function find_by_sql ($sql="") 
		{
			// Get the mysql connection
			global $mysqli_connection;
			
			$result_set = mysqli_query($mysqli_connection, $sql);
			$object_array = array();
			while ($row = mysqli_fetch_array($result_set, MYSQLI_ASSOC))
			{
				$object_array[] = static::instantiate($row);
			}
			
			return $object_array;
		}
		
		
		// Find object by key
		public static function find_by_id ($id=0) 
		{	
			// Check that the id is an int to prevent sql injection
			if (!is_numeric($id))
			{
				$_SESSION["message"] = "There is an error with the page you were trying to access.<br />";
				redirect_head(ROOT_URL);
			}
		
			$sql = "SELECT `".static::$table_name."`.* FROM `".
				static::$table_name."` WHERE `".static::primary_key_field()."`={$id} LIMIT 1;";
			$result_array = static::find_by_sql($sql);
			
			if ($result_array != null)
			{
				return array_shift($result_array);
			}
			else
			{
				return false;
			}
		}
		
		
		// Find an object by a field and its value
		public static function find_by_name ($name, $column_name="name")
		{
			// Get the mysql connection
			global $mysqli_connection;
			
			// Sanitize the arguments to prevent sql injection
			$name = mysqli_real_escape_string($mysqli_connection, $name);
			$column_name = mysqli_real_escape_string($mysqli_connection, $column_name);
			
			$sql = "SELECT * FROM `".static::$table_name."` WHERE {$column_name} = '{$name}';";
			$result_array = static::find_by_sql($sql);
			
			if ($result_array != null)
				return array_shift($result_array);
			else
				return false;
		}
		
		
		// Returns a string containing the name of the primary key
		public static function primary_key_field() 
		{
			return static::$db_fields[0];
		}
		
		
		// Returns an instantiated object of itself from the database
		public static function instantiate ($record) 
		{
			$object = new static;	
			
			// More dynamic, short-form approach:
			foreach ($record as $attribute=>$value)
			{
				if ($object->has_attribute($attribute)) 
				{
					$object->$attribute = $value;
					
					// if we see an attribute that is greater than 3 characters long
					// AND the attribute's last 3 characters are '_wk'
					// AND that attribute is not the primary key 
					// THEN we are going to instantiate the sub-objects automatically
					// this will support our relational DB model in PHP
					if (strlen($attribute) > 3) 
					{
						if (substr($attribute, -3) == '_wk' && $attribute != static::primary_key_field()) 
						{
							// the class name will always be the same as the attribute name
							// with no '_wk', also, with capital first letter for new words
							$class_name = str_replace(' ', '_', ucwords(str_replace('_', ' ', substr($attribute, 0, -3))));
							
							// at this point, we are going to instantiate the sub-object
							$object->$attribute = $class_name::find_by_id($object->$attribute);
						}
					}
				}
			}
			
			return $object;
		}
		
		
		protected function sanitized_attributes() 
		{
			global $mysqli_connection;
			$clean_attributes = array();
			// sanitize the values before submitting
			// Note: does not alter the actual value of each attribute
			foreach ($this->attributes() as $key => $value)
			{
				$clean_attributes[$key] = mysqli_real_escape_string($mysqli_connection, $value);
			}
			
			return $clean_attributes;
		}
		
		
		protected function attributes() 
		{ 
			// Get the mysql connection
			global $mysqli_connection;
			
			// Return an array of attribute names and their values
			$attributes = array();
			foreach (static::$db_fields as $field) 
			{
				if (property_exists($this, $field)) 
				{
					$attributes[$field] = $this->$field;
				}
			}
			return $attributes;
		}
		
		
		public function has_attribute($attribute) 
		{
			// Will return true or false if the key exists
			return array_key_exists($attribute, $this->attributes());
		}
		
		
		public function create() 
		{
			global $mysqli_connection;
			
			$attributes = $this->sanitized_attributes();
		
			$sql = "INSERT INTO `".static::$table_name."` (";
			$sql .= join(", ", array_keys($attributes));
			$sql .= ") VALUES ('";
			$sql .= join("', '", array_values($attributes));
			$sql .= "');";
			mysqli_query($mysqli_connection, $sql);
			
			return (mysqli_affected_rows($mysqli_connection) == 1) ? true : false;
		}
		
		
		public function delete() 
		{
			global $mysqli_connection;
			
			//if the item contains an is_deleted field
			if (in_array("is_deleted", static::$db_fields)) {
				//cleanse the attributes
				$attributes = $this->sanitized_attributes();				
				
				//if we're here, then the table does contain and is_deleted field
				//so we simply need to update the is_deleted flag
				$sql = "UPDATE `".static::$table_name."` SET `is_deleted` = 1";
			}
			else
			{
				$sql = "DELETE FROM `".static::$table_name."`";
				$sql .= " WHERE `".static::primary_key_field()."`=". $this->{static::primary_key_field()};
				$sql .= " LIMIT 1;";
			}
			mysqli_query($mysqli_connection, $sql);
			
			return (mysqli_affected_rows($mysqli_connection) == 1) ? true : false;
		}
		
		
		public function update() 
		{
			//updates status to database
			global $mysqli_connection;
			
			$attributes = $this->sanitized_attributes();
			
			//form everything into a string
			$attribute_pairs = array();
			foreach($attributes as $key => $value) 
			{
				$attribute_pairs[] = "`{$key}`='{$value}'";
			}

			//dynamically create the query
			$sql = "UPDATE `".static::$table_name."` SET ";
			$sql .= join(", ", $attribute_pairs);
			$sql .= " WHERE `".static::$table_name."`.`".static::primary_key_field()."`='".$this->{static::primary_key_field()}."';";
			mysqli_query($mysqli_connection, $sql);
			
			return (mysqli_affected_rows($mysqli_connection) == 1) ? true : false;
		}
		
		
		//the to_string method of all of these objects
		public function __toString() {
			return $this->{static::primary_key_field()};
		}
		
	} // end class
	
?>