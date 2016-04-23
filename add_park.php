<?php

	// initialize page
	require_once "initialize.php";
	
	// Set page
	$page = array();
	$page["name"] = "Add a Park";
	$page["file_name"] = "add_park.php";
	$page["is_user_only"] = true;
	$page["is_admin_only"] = true;
	
	
	// Pre-load data for country, state, and city
	$countries = Country::find_by_sql("SELECT * FROM `country`;");
	
	
	/*
		Form Processing
	*/
	
	if (isset($_POST["submit"]))
	{
		// flag for improper for submission
		$flag = false;
		
		/* Form Validation */
		// check that Country is set
		if ($_POST["country"] == "default")
		{
			$_SESSION["message"] = "You must select a country!<br>";
			$flag = true;
		}
		
		// check that state/province is set
		if ($_POST["state"] == "default")
		{
			$_SESSION["message"] = "You must select a state/province!<br>";
			$flag = true;
		}
		
		// check that city is set
		if ($_POST["city"] == "default")
		{
			$_SESSION["message"] = "You must select a city!<br>";
			$flag = true;
		}
		
		// if the form has been properly fill out
		if ($flag == false)
		{
			// create the new park
			$new_park = new Park();
			$new_park->status_wk = '1';
			$new_park->city_wk = $_POST["city"];
			$new_park->address = $_POST["address"];
			$new_park->name = $_POST["name"];
			
			//proces the image
			$default_image = new Image();
			$default_image->get_form_data($_FILES['file_upload']);
			
			//if there is no file, that is fine - we can set to 0 for default
			if(!(Image::$error_dictionary[$default_image->error] == 'No file.')) {
				$default_image->check_errors(true);
				//save the image record to the database
				if(!$default_image->create()) {
					$_SESSION["message"] = "There was an issue saving the image: ".mysqli_error($mysqli_connection)."<br>";
					header("Location: {$page['file_name']}");
					die();
				}
				//get the key, and associate it to the image record
				$default_image->image_wk = mysqli_insert_id($mysqli_connection);
				//now we move the file and save
				$default_image->move_file();
			
				//if the image changed, set it
				if($default_image) 
				{
					$new_park->image_wk = $default_image->image_wk;
				}
			} 
			else
			{
				$new_park->image_wk = 0;
			}
			
			// if the park successfully saves to the database
			if ($new_park->create())
			{
				$_SESSION["message"] = "The park {$new_park->name} has been successfully added!<br>";
			}
			// if the park does not successfully save to the databse
			else
			{
				$_SESSION["message"] = "Unable to add the park {$new_park->name} at this time.<br>";
			}
		}
		
		// refresh the page
		header("Location: {$page["file_name"]}");
		die();
	}
	
	// include header
	require_once "header.php";
	
?>

    <!-- Main Content -->
	<h1>Add a Park</h1>
	
	<!-- Error messages -->
	<?php
		if (isset($_SESSION["message"]))
			echo "<p id=\"message\">".$_SESSION["message"]."</p>";
	?>
	
	
	<!-- Form to add a park -->
	<form action="<?php echo $page["file_name"]; ?>" enctype="multipart/form-data" method="post">
	
		<label>Park Name</label>
			<input type="text" name="name" value="" required/><br />
			
		<label>Image</label>
			<input type="file" name="file_upload" /><br />
			
		<label>Address</label>
			<input text="text" name="address" value="" required/><br />
			
		<label>Country</label>
			<select id="country" name="country">
				<option value="default" selected>Select a Country</option>
				<?php
				foreach ($countries as $country)
				{
					echo "<option value=\"".$country->country_wk."\">".$country->name."</option>";
				}
				?>
			</select><br />
			
		<label class="state">State/Province</label>
			<select id="state" class="state" name="state">
			</select><br />
			
		<label class="city">City</label>
			<select id="city" class="city" name="city">
			</select><br />
			
		<input type="submit" value="Add Park!" name="submit" />
			
	</form>
	
	
	<!-- jQuery to show/hide form elements -->
	<script>
		// hide the state and city selects initially
		$('.state').hide();
		$('.city').hide();
		
		
		// When the country is selected, show the states
		$('#country').change(function() 
		{
			// remove all previous <option>s
			$('#state').empty();
			
			// populate the list of states
			getState( $('#country').val() );
			
			// show the state <select> and its label
			if ($('.state').is(':hidden'))
			{
				$('.state').show();
			}
			
			return;
		});
		
		
		// When the state is selected, show the cities
		$('#state').change(function() 
		{
			// remove all previous <option>s
			$('#city').empty();
			
			// populate the list of cities
			getCity( $('#state').val() );
			
			// show the city <select> and its label
			if ($('.city').is(':hidden'))
			{
				$('.city').show();
			}
			
			return;
		});
	</script>
	
	
	<!-- jQuery/AJAX to load state and city -->
	<script>
		// function called when the country is selected
		function getState(country) 
		{
			$.post("process_country.php", "c=" + country, successState, 'html');
			
			return;
		}
		
		
		// function called when the state is selected
		function getCity(state)
		{
			$.post("process_state.php", "s=" + state, successCity, 'html');
			
			return;
		}
		
		
		// if getState() call is successful, place the <option>s in the state select
		// portion of the form and display
		function successState(data) 
		{
			// add the <option>s for the states
			$('#state').append(data);
			
			return;
		}
		
		
		// if getCity call is successful, place the <option>s in the city select
		// portion of the form and display
		function successCity(data) 
		{
			// add the <option>s for the cities
			$('#city').append(data);
			
			return;
		}
		
	</script>
	
<?php 
	
	// unset the error message
	if (isset($_SESSION["message"]))
		unset($_SESSION["message"]);
	
	// include footer
	require_once "footer.php"; 
	
?>