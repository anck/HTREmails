<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>SG 2 - #6</title>
	
<title> Add 'em up Again!</title>
</head>
<body>

<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<table>
	<tr>
		
		<td>First Name:</td><td> <input type="text" size="40" name="firstname" value=""></td>
		
	</tr>
	<tr>	
		<td>Last Name:</td><td> <input type="text" size="40" name="lastname" value=""></td>
	</tr>
	<tr>	
		<td>Date:</td><td><input type="text" size="40" name="date" value=" "></td>
	</tr>
	<tr>
		<td>Comment:</td><td><textarea rows="10" cols="40" name="ta" value=""> </textarea> </td>
	</tr>
	<tr>
		<td><td><input type="radio" name = "MOOD" value="Happy" checked="checked" />Happy</td>
	</tr>
	<tr>	
		<td>MOOD</td><td><input type="radio" name = "MOOD" value="Mad" />Mad</td> </tr>
	
	<tr>	
		<td></td><td><input type="radio" name = "MOOD" value="Indifferent" />Indifferent</td> </tr>
	</tr>
	<tr>
		<td><input type="reset" name="reset" value="Reset This Form"></td>
		<td><input type="submit" name="submit" value="Submit This Form"></td>
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

