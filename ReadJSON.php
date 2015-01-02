<?php
// Read the file contents into a string variable,
// and parse the string into a data structure
$str_data = file_get_contents("./HTRjson.json");
$data = json_decode($str_data,true);
//print_r($data);

$jsonIterator = new RecursiveIteratorIterator(
		new RecursiveArrayIterator($data),
		RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) 
	{
		if(is_array($val)) 
		{
			echo "$key:\n";
			
		} 
		else 
		{
			echo "$key => $val\n";
		}
		//echo "\n\n\n";
	}

?>
