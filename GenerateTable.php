<style>
input[type="text"]
{
	width: 170px;
}
td[id="hfptr"]
{
	width: 90px;
}
#hfhtr, #hfptr, #priority, #hfftr
{
	width: 25px;
}
</style>
<script>
//calculates resources when PTR or HTR is changed.
function calculateAvilableResources()
{
		
			$("input#hfptr, input#hfhtr, input#hfftr ").on('input propertychange paste', function() 
			{
				var totalAssigned = [];
				var totalResources = $("input#TotalResources").val();

				//adding the resources to array.
				$("input#hfptr").each(function()
				{
					totalAssigned.push(Number($(this).val()));
				});
				$("input#hfhtr").each(function()
				{
					totalAssigned.push(Number($(this).val()));
				});
				$("input#hfftr").each(function()
				{
					totalAssigned.push(Number($(this).val()));
				});
				
				var span = $('span#summary');
				var total =0;
				for(i=0;i<totalAssigned.length;i++)
				{
					total = total + totalAssigned[i];
				}
				var value = span.text((totalResources - total));
				span.append(value);
				$('div#result').append(span);
				 
			});
}

//script to calculate total resources.
/* $(document).ready(function()
	{
		
	
		$("input#hfptr, input#hfhtr").on('input propertychange paste', function() 
		{
			var totalAssigned = [];
			var totalResources = $("input#TotalResources").val();

			$("input#hfptr").each(function()
			{
				totalAssigned.push(Number($(this).val()));
			});
			$("input#hfhtr").each(function()
			{
				totalAssigned.push(Number($(this).val()));
			});
			
			var span = $('span#summary');
			var total =0;
			for(i=0;i<totalAssigned.length;i++)
			{
				total = total + totalAssigned[i];
			}
			var value = span.text('Avilable Testers: ' + (totalResources - total));
			span.append(value);
			$('div#result').append(span);
			 
		});
	}); */


</script>
<?php
// Read the file contents into a string variable,
// and parse the string into a data structure
// if(isset($_GET['selection'])) 
// {
// 	echo "yeah"+$_GET['selection'];
	
// }
// else echo "fail";
if(isset($_POST['selection'])) 
{
	$fileName = $_POST['selection'];
	$str_data = file_get_contents("./htrjsonfiles/$fileName");
	$data = json_decode($str_data,true);
}
else 
{
	header("location: GetHotfix.php");
}

//print_r($data);

echo " <br /><div  class=\"centerAlign\"> Total Resources: <input type=\"text\" class=\"HTRForm\" id=\"TotalResources\" value=\"19\"></div><br />";

echo "<div class=\"centerAlign\" id=\"result\" ><hr />Avilable Testers: <span style=\"background-color: #FFFF00\" id=\"summary\"> </span></div>";
echo "<hr />";

echo "<table class=\"tg table table-bordered table-hover \" id=\"dataTable\">
<tr>
<th>Checkbox</th>
<th>Priority</th>
<th>Package Name</th>
<th>Received Date</th>
<th>Lead</th>
<th>PTR Resources</th>
<th>HTR Resources</th>
<th>FTR Resources</th>						
<th>Type</th>
<!--<th>Notes</th>-->
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
	echo "<tr>\n<td><input class=\"HTRCheckbox\" type=\"checkbox\" name=\"chk[]\"></td>";
	foreach($HF as $k => $v)
	{
		
		switch($k)
		{
			case "Priority":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" name=\"priority[]\" id=\"priority\" value=\"$v\"></td>";
				break;
			case "Hotfix":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" name=\"hfname[]\" id=\"hfname\"  value=\"$v\"></td>";
				break;
			case "Received":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" name=\"hfdate[]\" id=\"hfdate\" value=\"$v\"></td>";
				break;
			case "Lead":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" name=\"hflead[]\" id=\"hflead\" value=\"$v\"></td>";
				break;
			case "PTR":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" name=\"hfptr[]\" id=\"hfptr\" oninput=\"calculateAvilableResources()\" value=\"$v\"></td>";
				break;
			case "HTR":
				
				echo "<td><input type=\"text\" class=\"HTRForm\" name=\"hfhtr[]\" id=\"hfhtr\" oninput=\"calculateAvilableResources()\" value=\"$v\"></td>";
				break;
			case "FTR":
			
				echo "<td><input type=\"text\" class=\"HTRForm\" name=\"hfftr[]\" id=\"hfftr\" oninput=\"calculateAvilableResources()\" value=\"$v\"></td>";
				break;
			case "Type":
				//3/20/15- remove - this is crap! Need to change but too lazy.
				echo "<td><input type=\"text\" class=\"HTRForm\" name=\"hftype[]\" id=\"hftype\" value=\"$v\"></td>";
				//echo "<td><input type=\"text\" class=\"HTRForm\" name=\"hfnotes[]\" id=\"hfnotes\" value=\"NA\"></td>\n</tr>";
				break;
			default:
				break;
	
		}
	}
	
}


echo "</table>";
//populate available resources by default.
echo "<script>calculateAvilableResources();</script>"



?>