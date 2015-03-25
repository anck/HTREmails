<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- <script src="jqueryUtility.js"></script> -->
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>
<script type="text/javascript">
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

$(document).ready(function(){
  $("input").focus(function(){
    $(this).css("background-color","#cccccc");
  });
  $("input").blur(function(){
    $(this).css("background-color","#ffffff");
  });
});

$(document).ready(function()
{
	$("#btn1").click(function()
	{
		
			$(".HTRForm").replaceWith(function()
			{
			  	return "<span class=\"HTRTable\" data-type=\""+this.type+"\" id=\""+ this.id +"\">" + this.value + "</span> \n";
				//return "<span class=\"HTRTable\" id=\""+ this.id +"\">" + this.value + "</span>";
			});
			
			//addColumns('PTR Resources');
			//addColumns('HTR Resources');
		
	});
});

$(document).ready(function()
{
	$("#btn2").click(function()
		{
		
			$(".HTRTable").replaceWith(function()
			{
				
				//return "<input type=\""+ $(this).data-type +"\" class=\"HTRForm\" id=\"" + this.id + "\" value=\"" + $(this).text + "\">";
				return "<input type=\"text\" class=\"HTRForm\" id=\"" + this.id + "\" value=\"" + $(this).text() + "\">";
			  // return "<span id=\"HTRTable\">"this.value"</span>;
			});
			
	});
});

$(document).ready(function()
{
	$("#btn3").click(function()
	{
		if($(".HTRTable").length)
		{
					addColumns('PTR Resources');
					addColumns('HTR Resources');
		}
		else if($(".HTRForm").length)
		{
			alert("Please create a table before generating resources");
		}
	});
});

function addColumns($ColHead)
{
	
	$columnTh = $("#dataTable th:contains(" + $ColHead +")");
	$totalRows = $("#dataTable tr").length;

	$columnIndex = $columnTh.index() + 1; 
	
	$total = 0;
	 
		
	$("#dataTable tr td:nth-child(" + $columnIndex + ")").each(function()
			{
				$total += Number($(this).text());

			});
	
	
	alert($total);
	// Set the heading red too!
	//$columnTh.css("color", "#F00"); 
	/*
	$(document).ready(function()
			{
				$("#btn3").click(function()
					{
					
						$(".HTRTable #hfptr ").
						
				});
			}); */
}

</script>
<?php
// Read the file contents into a string variable,
// and parse the string into a data structure
$str_data = file_get_contents("./HTRjson.json");
$data = json_decode($str_data,true);
//print_r($data);


echo "<input type=\"button\" value=\"Add Row\" onclick=\"addRow2('dataTable')\">\n
<input type=\"button\" value=\"Delete Row\" onclick=\"deleteRow('dataTable')\">";

echo "<button id=\"btn1\">Generate Table</button>";
echo "<button id=\"btn2\">Generate From</button>";
echo "<button id=\"btn3\">Add table</button>";

echo "<table class=\"tg\" id=\"dataTable\">
<tr>
<th></th>
<th>Prioirty</th>
<th>Package Name</th>
<th>Receieved Date</th>
<th>Lead</th>
<th>PTR Resources</th>
<th>HTR Resources</th>
<th>Type</th>
<th>Notes</th>
</tr>";


// <td><input type="checkbox" name="chk"></td>
// <td id="Priority">3</td>
// <td><input type="text" id="hfname" value="ICAWS750WX86X64020"></td>
// <td><input type="date" id="hfdate"></td>
// <td><input type="text" id="hflead" value="Anchitk"></td>
// <td><input type="text" id="hfptr" value="9"></td>
// <td><input type="text" id="hfhtr" value="0"></td>
// <td><input type="text" id="hftype" value="Private VDA"></td>
// <td><input type="text" id="hftype" value="NA"></td>


$HTR= $data['HTR'];

foreach($HTR as $HF)
{
	echo "<tr>\n<td><input type=\"checkbox\" name=\"chk\"></td>";
	foreach($HF as $k => $v)
	{
		
		switch($k)
		{
			case "Priority":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" id=\"priority\" value=\"3\"></td>";
				break;
			case "Hotfix":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" id=\"hfname\" value=\"$v\"></td>";
				break;
			case "Received":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" id=\"hfdate\" value=\"$v\"></td>";
				break;
			case "Lead":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" id=\"hflead\" value=\"$v\"></td>";
				break;
			case "PTR":
				
				echo "<td><input type=\"number\" class=\"HTRForm\" id=\"hfptr\" value=\"$v\"></td>";
				break;
			case "HTR":
				
				echo "<td><input type=\"number\" class=\"HTRForm\" id=\"hfhtr\" value=\"$v\"></td>";
				break;
			case "Type":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" id=\"hftype\" value=\"$v\"></td>";
				echo "<td><input type=\"text\" class=\"HTRForm\" id=\"hfnotes\" value=\"NA\"></td>\n</tr>";
				break;
			default:
				break;
	
		}
	}
	
}


echo "</table>";


/*
 * Add the colums of a table
 */
function addColomns($tableID)
{
	
	
	
}

?>
</body>
</html>