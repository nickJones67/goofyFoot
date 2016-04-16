<?php

	
	require_once "initialize.php";

	/* part 1
	$states = array(
		"Alabama" => array("abbr" => "AL", "wk" => 1),
		"Alaska" => array("abbr" => "AK", "wk" => 2),
		"Arizona" => array("abbr" => "AZ", "wk" => 3),
		"Arkansas" => array("abbr" => "AR", "wk" => 4), 
		"California" => array("abbr" => "CA", "wk" => 5), 
		"Colorado" => array("abbr" => "CO", "wk" => 6), 
		"Connecticut" => array("abbr" => "CT", "wk" => 7), 
		"Delaware" => array("abbr" => "DE", "wk" => 8), 
		"Florida" => array("abbr" => "FL", "wk" => 9), 
		"Georgia" => array("abbr" => "GA", "wk" => 10), 
		"Hawaii" => array("abbr" => "HI", "wk" => 11), 
		"Idaho" => array("abbr" => "ID", "wk" => 12), 
		"Illinois" => array("abbr" => "IL", "wk" => 13), 
		"Indiana" => array("abbr" => "IN", "wk" => 14), 
		"Iowa" => array("abbr" => "IA", "wk" => 15), 
		"Kansas" => array("abbr" => "KS", "wk" => 16), 
		"Kentucky" => array("abbr" => "KY", "wk" => 17), 
		"Louisiana" => array("abbr" => "LA", "wk" => 18), 
		"Maine" => array("abbr" => "ME", "wk" => 19), 
		"Maryland" => array("abbr" => "MD", "wk" => 20), 
		"Massachusetts" => array("abbr" => "MA", "wk" => 21), 
		"Michigan" => array("abbr" => "MI", "wk" => 22), 
		"Minnesota" => array("abbr" => "MN", "wk" => 23), 
		"Mississippi" => array("abbr" => "MS", "wk" => 24), 
		"Missouri" => array("abbr" => "MO", "wk" => 25), 
		"Montana" => array("abbr" => "MT", "wk" => 26),
		"Nebraska" => array("abbr" => "NE", "wk" => 27), 
		"Nevada" => array("abbr" => "NV", "wk" => 28), 
		"New Hampshire" => array("abbr" => "NH", "wk" => 29), 
		"New Jersey" => array("abbr" => "NJ", "wk" => 30), 
		"New Mexico" => array("abbr" => "NM", "wk" => 31), 
		"New York" => array("abbr" => "NY", "wk" => 32), 
		"North Carolina" => array("abbr" => "NC", "wk" => 33), 
		"North Dakota" => array("abbr" => "ND", "wk" => 34), 
		"Ohio" => array("abbr" => "OH", "wk" => 35), 
		"Oklahoma" => array("abbr" => "OK", "wk" => 36), 
		"Oregon" => array("abbr" => "OR", "wk" => 37), 
		"Pennsylvania" => array("abbr" => "PA", "wk" => 38), 
		"Rhode Island" => array("abbr" => "RI", "wk" => 39), 
		"South Carolina" => array("abbr" => "SC", "wk" => 40), 
		"South Dakota" => array("abbr" => "SD", "wk" => 41), 
		"Tennessee " => array("abbr" => "TN", "wk" => 42),
		"Texas" => array("abbr" => "TX", "wk" => 43),
		"Utah" => array("abbr" => "UT", "wk" => 44), 
		"Vermont" => array("abbr" => "VT", "wk" => 45), 
		"Virginia" => array("abbr" => "VA", "wk" => 46), 
		"Washington" => array("abbr" => "WA", "wk" => 47), 
		"West Virginia" => array("abbr" => "WV", "wk" => 48), 
		"Wisconsin" => array("abbr" => "WI", "wk" => 49), 
		"Wyoming" => array("abbr" => "WY", "wk" => 50)
	);
	
	var_dump($states);
	
	// declarations
	$last_city = "";
	$last_state = "";
	
	// open the csv file to change
	$fp = fopen("cities.csv", "r");
	$fpw = fopen("new_cities.csv", "w+");
	
	// skip the first line
	$line = fgetcsv($fp, 1000, ",");
	
	// loop through the file for each state and replace that state's 
	// abbreviation with that state's wk
	foreach ($states as $state)
	{
		while ($line = fgetcsv($fp, 1000, ","))
		{
			// check if the line applies to current state
			// AND that the city and state are not the same as the previous entry
			if ($line[1] == $state["abbr"] && !($line[1] == $last_state && $line[2] == $last_city))
			{
				fwrite($fpw, $state["wk"].",".$line[2]."\n");
				$last_state = $line[1];
				$last_city = $line[2];
			}
			else // if line does not apply, skip it
			{
				continue;
			}
		}
		
		// reset the file pointer to the beginning
		rewind($fp);
	}
	
	// close the files
	fclose($fp);
	fclose($fpw);
	 */
	
	
	/* part 2 */
	
	// open the new cities file
	$fp = fopen("new_cities.csv", "r");
	
	// loop through each line and insert into database
	while ($line = fgetcsv($fp, 1000, ","))
	{
		$sql = "INSERT INTO `skate_park`.`city` (`city_wk`, `state_wk`, `name`) VALUES (NULL, ".$line[0].", '".$line[1]."');";
		
		if (mysqli_query($mysqli_connection, $sql))
		{
			echo "row successfully entered!\n";
		}
		
	}
	
	// close the file
	
	
?>