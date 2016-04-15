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
	
	if (isset($_POST))
	{
		
	}
	
	// include header
	require_once "header.php";
	
?>

    <!-- Main Content -->
	<h1>Add a Park</h1>
	
	
	<!-- Form to add a park -->
	<form action="<?php echo $page["file_name"]; ?>" method="post">
	
		<label>Park Name</label>
			<input type="text" name="name" value="" /><br />
			
		<label>Address</label>
			<input text="text" name="address" value="" /><br />
			
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
	
	// include footer
	require_once "footer.php"; 
	
?>