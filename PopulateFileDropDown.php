<?php
include 'ReturnListOfFiles.php';
	$dir    = './htrjsonfiles';
	//$files1 = scandir($dir);
	$files = returnFileList($dir);
	//echo "<select class=\"htrdropdown\">";
	$options = "";
	foreach($files as $file)
	{
	/* echo $file;
	echo "<br />"; */
		//echo $file;
		 $options .= "<option value=" . $file . ">" . $file . "</option>";
		
		
	}
	echo $options;
	//echo "</select>";
	
	
?>