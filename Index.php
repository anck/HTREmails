<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>SG 2 - #6</title>
	<link rel="stylesheet" type="text/css" href="table.css">
<title> Add 'em up Again!</title>
</head>
<body>
<script>
function addRow2(tableID)
{
	var table=document.getElementById(tableID);
	var rowCount=table.rows.length;
	var row=table.insertRow(rowCount);
	var colCount=table.rows[0].cells.length;
	//document.write(colCount);
	for(var i=0;i<colCount;i++)
	{
		var newcell=row.insertCell(i);
		newcell.innerHTML=table.rows[2].cells[i].innerHTML;
		switch(newcell.childNodes[0].type)
		{
			case"text":
				newcell.childNodes[0].value="";
			break;
			case"checkbox":
				newcell.childNodes[0].checked=false;
			break;
			case"select-one":
				newcell.childNodes[0].selectedIndex=0;
			break;
		}
	}
}

function deleteRow(tableID)
	{
		try
		{
			var table=document.getElementById(tableID);
			var rowCount=table.rows.length;
			for(var i=0;i<rowCount;i++)
			{
				var row=table.rows[i];
				var chkbox=row.cells[0].childNodes[0];
				if(null!=chkbox&&true==chkbox.checked)
				{
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			}
		}
		catch(e)
		{alert(e);}
	}
</script>

<!-- Self submit to php -->
<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<!-- Calling Javascipt methods -->
<input type="button" value="Add Row" onclick="addRow2('dataTable')">
<input type="button" value="Delete Row" onclick="deleteRow('dataTable')">

<table class="tg" id="dataTable">
  <tr>
  	<th></th>
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
  	<td><input type="checkbox" name="chk"></td>
    <td id="Priority">3</td>
    <td><input type="text" id="hfname" value="ICAWS750WX86X64020"></td>
    <td><input type="date" id="hfdate"></td>
    <td><input type="text" id="hflead" value="Anchitk"></td>
    <td><input type="text" id="hfptr" value="9"></td>
    <td><input type="text" id="hfhtr" value="0"></td>
    <td><input type="text" id="hftype" value="Private VDA"></td>
    <td><input type="text" id="hftype" value="NA"></td>
  </tr>
  <tr>
  	<td><input type="checkbox" name="chk"></td>
    <td id="Priority">3</td>
    <td><input type="text" id="hfname" value="ICAWS750WX86X64020"></td>
    <td><input type="date" id="hfdate"></td>
    <td><input type="text" id="hflead" value="Anchitk"></td>
    <td><input type="text" id="hfptr" value="9"></td>
    <td><input type="text" id="hfhtr" value="0"></td>
    <td><input type="text" id="hftype" value="Private VDA"></td>
    <td><input type="text" id="hftype" value="NA"></td>
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