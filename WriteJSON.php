<?php
// Modify the value, and write the structure to a file "data_out.json"
//
// Read the file contents into a string variable,
// and parse the string into a data structure

//$columns = array();
if(isset($_POST['index'])) 
{
	$columns = json_decode($_POST['index'],true);
	
	
}
else
{
	print_r ($_POST);
}

/* else 
{
	header("location: GetHotfix.php");
} */
$priority=$columns["priority"];
$hfname=$columns['hfname'];
$hfdate=$columns['hfdate'];
$hflead=$columns['hflead'];
$hfptr=$columns['hfptr'];
$hfhtr=$columns['hfhtr'];
$hfftr=$columns['hfftr'];
$hftype=$columns['hftype'];
//$hfnotes=$columns['hfnotes'];

$numEntries=sizeof($priority);

for ($x = 0; $x < $numEntries; $x++) {
	//$dyndata["HTR"][$x] = array('Priority'=> "{$priority[$x]}",'Hotfix'=> "{$hfname[$x]}","Received"=> "{$hfdate[$x]}","Lead"=> "{$hflead[$x]}","PTR"=> $hfptr[$x], "HTR"=> $hfhtr[$x],"Type"=> "{$hftype[$x]}","Notes"=> "{$hfnotes[$x]}");
	$dyndata["HTR"][$x] = array('Priority'=> "{$priority[$x]}",'Hotfix'=> "{$hfname[$x]}","Received"=> "{$hfdate[$x]}","Lead"=> "{$hflead[$x]}","PTR"=> $hfptr[$x], "HTR"=> $hfhtr[$x],"FTR"=> $hfftr[$x],"Type"=> "{$hftype[$x]}");
} 
//$staticdata["HTR"] = array(array('Priority'=>3,'Hotfix'=>'ICAWS750WX86X64020',"Received"=> "12-Oct-15","Lead"=> "Anchitk","PTR"=> 9, "HTR"=> 0,"Type"=> "PrivateVDA"),array('Priority'=>3,'Hotfix'=>'ICAWS760WX86X64004',"Received"=> "15-Oct-15","Lead"=> "Anchitk","PTR"=> 9, "HTR"=> 0,"Type"=> "PrivateVDA"));
$today = date("j_M_D_Y"); 
$fh = fopen("htrjsonfiles/HTR_{$today}.json", 'w')
      or die("Error opening output file");
$fhstatic = fopen("htrjsonfiles/HTRjson.json", 'w')
      or die("Error opening output file");

try 
{
	fwrite($fh, json_encode($dyndata, JSON_PRETTY_PRINT));
	fwrite($fhstatic, json_encode($dyndata, JSON_PRETTY_PRINT));
	print_r("write complete");
}
catch(Exception $e)
{
	print_r("write incomplete" + $e);
}
fclose($fh);
?>
