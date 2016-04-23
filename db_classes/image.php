<?php

	/*
		This class corresponds to the table 'image' in the database
	*/

	class Image extends Database_Object
	{
		public static $table_name = "image";
		protected static $db_fields = array("image_wk", "file_name", "size", "type", "is_deleted");
		
		public $image_wk;
		public $file_name;
		public $size;
		public $type;
		public $is_deleted;
		
		//image attribute fields during upload
		public $temp_path;
		public static $upload_directory = "uploads";
		public $error;
		public $is_image = 0;
		
		
		//dictionary to define all errors
		public static $error_dictionary = array(
			UPLOAD_ERR_OK 			=> "No errors.",
			UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
			UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
			UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
			UPLOAD_ERR_NO_FILE 		=> "No file.",
			UPLOAD_ERR_NO_TMP_DIR 	=> "No temporary directory.",
			UPLOAD_ERR_CANT_WRITE 	=> "Can't write to disk.",
			UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
		);
		
		
		//get the form data from the server and apply it
		public function get_form_data($file_return_array) {
			$this->file_name = strtolower(str_replace(' ', '_', $file_return_array['name']));
			$this->type = $file_return_array['type'];
			$this->size = $file_return_array['size'];
			$this->temp_path = $file_return_array['tmp_name'];
			$this->error = $file_return_array['error'];
			
			//check to see if the file is an actual image
			if ( strpos( $this->type, 'image' ) !== false ) 
				// this is an image 
				$this->is_image = 1;
				
			//if we're here, success
			return true;
		}
		
		
		//check for any potential errors
		public function check_errors() {
			global $session;
			global $page;
			
			//first, we check to make sure the file was uploaded successfully
			if(Image::$error_dictionary[$this->error] != 'No errors.') {
				$_SESSION["message"] = "There was an issue uploading your file: <strong>".Image::$error_dictionary[$this->error]."</strong>";
				header("Location: {$page["file_name"]}");
				die();
			}
			
			//second, we check to make sure the file is image
			if($this->is_image != 1) {
				$_SESSION["message"] = "You did not upload an image file; you can only upload images.";
				header("Location: {$page["file_name"]}");
				die();
			}
			
			//if we're here, success
			return true;
		}
		
		
		// move the file to the actual location
		public function move_file() {
			// pre-append the key to the beggining, followed by an underscore
			// this ensures image uniqueness and no overrides
			$this->file_name = $this->image_wk."_".basename($this->file_name);
			

			if(!move_uploaded_file($this->temp_path, BASE."uploads/".$this->file_name)) {
				// remove the record from the database
				$this->delete();
				
				$_SESSION["message"] = "There was an issue uploading the image, please try again.";
				header("Location: {$page["file_name"]}");
				die();
			}
			
			$this->update();
			
			// if we're here, success
			return true;
		}
		
	}

?>