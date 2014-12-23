<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>SG 2 - #6</title>
	<link rel="stylesheet" type="text/css" href="table.css">
<title> Add 'em up Again!</title>
</head>
<body>

<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<table class="tg">
  <tr>
    <th >Prioirty</th>
    <th>Package Name</th>
    <th>Receieved Date</th>
    <th>Lead</th>
    <th>Resources</th>
    <th>HTR Resources</th>
    <th>Type</th>
    <th>Notes</th>
  </tr>
  <tr>
    <td class = "tg-pr">3</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td class = "tg-pr">3</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>
<?php

if(isset($_POST['submit']))
{	
	
	$fn = $_POST['firstname'];
	$ln =  $_POST['lastname'];
	$date =	$_POST['date'];
	$mood = $_POST['MOOD'];
	$textarea = $_POST['ta'];
 
	echo "Today is date $date <br /> Hello $fn $ln I am glad that you are in a $mood mood today<br/>";
	echo "Your Comments: $textarea;";
	 
	/*
	if(isset($_POST['num1']) && isset($_POST['num2']) )
	{
		$num1 = $_POST['num1'];
		$num2 = $_POST['num2'];
		$sum = $num1 + $num2;
		echo "<strong> The sum of $num1 and $num2 is $sum. </strong>";
	}*/

}

?>

</body>
</html>