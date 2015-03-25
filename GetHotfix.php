<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<style>
.centerAlign {
  width: 700px ;
  margin-left: auto ;
  margin-right: auto ;
}
input[type="text"]
{
	width: 200px;
}
</style>
</head>
<body>
<!-- begin bootstrap div -->
<div class="container-fluid">
<script>

/* //calculates resources when PTR or HTR is changed.
function calculateAvilableResources()
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
} */

//Adds a row form the table
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
			
		}
	}
}

//Deletes a row form the table
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


	
//onFocus & blur eventHandler	


//onClick eventhandler for btn1
$(document).ready(function()
{
	$("#btn1").click(function()
	{
		$("#btn3").attr("disabled", false);
		$("#btn4").attr("disabled", false);
		$("span#dropdown").hide();
		$(".HTRCheckbox").hide();
		$(".result").show();
		$(":button").filter("#tablebuttons").attr("disabled", true);
		
		$(".HTRForm").replaceWith(function()
		{
		   return "<span class=\"HTRTable\" name=\""+ this.id +"[]\" oninput=\"" + $(this).attr("oninput") + "\" id=\""+ this.id +"\">" + this.value + "</span>";
		});

			
		
	});
});

//onClick event handler for button 2.
$(document).ready(function()
{
	$("#btn2").click(function()
	{
		$('#btn3').attr("disabled", true);
		$('#btn4').attr("disabled", true);
		$(":button").filter("#tablebuttons").attr("disabled", false);
		$("span#dropdown").show();
		$(".HTRCheckbox").show();
		$(".HTRCheckbox").show();
		$(".result").hide();
		$(".result").text( "" );
		$(".finalrow").remove();
		$(".HTRTable").replaceWith(function()
		{
			return "<input type=\"text\" class=\"HTRForm\" id=\"" + this.id + "\" oninput=\"" + $(this).attr("oninput") + "\" value=\"" + $(this).text() + "\">";
		  // return "<span id=\"HTRTable\">"this.value"</span>;
		});
			
	});
});

//calculate sum for coloums
function columnSum($ColHead)
{
	
	$columnTh = $("#dataTable th:contains(" + $ColHead +")");
	$totalRows = $("#dataTable tr").length;

	$columnIndex = $columnTh.index() + 1; 
	
	$total = 0;
	 
		
	$("#dataTable tr td:nth-child(" + $columnIndex + ")").each(function()
			{
				$total += Number($(this).text());

			});
	
    //$('#dataTable tbody').append('<tr class="child"><td>blahblah</td></tr>');
    
	return $total;
	
}

//load dropdown
$(document).ready(function()
{
	$("select").load("PopulateFileDropDown.php"); 
});

//defunct
//generate total of PTR and HTR coloumns 
$(document).ready(function()
		{
			$("#btn3").click(function()
			{
				var $PTRtotal=0;
				var $HTRtotal=0;
				if($(".HTRTable").length)
				{
					$PTRtotal = columnSum('PTR Resources');
					$HTRtotal = columnSum('HTR Resources');
					$('#dataTable tbody').append("<tr class=\"finalrow\"><td></td><td colspan=\"4\" >TOTAL</td><td>" + $PTRtotal + "</td><td >" + $HTRtotal + "</td><td colspan=\"2\"></td></tr>");
				}
				else if($(".HTRForm").length)
				{
					alert("Please create a table before generating resources");
				}
				$('#btn3').attr("disabled", true);
				
			});
		});


//load table the first time
$(document).ready(function()
{
	var select = "HTRjson.json";
	$.post("GenerateTable.php", {selection : select }, function(data){ $(".maindiv").html(data);} );
	$('#btn3').attr("disabled", true);
	$('#btn4').attr("disabled", true);
	
});

//reload table
function reloadTable($selectedValue)
{
	var select = $selectedValue;
	$.post("GenerateTable.php", {selection : select }, function(data){ $(".maindiv").html(data);} );
}

//Write JSON
function writeJSON()
{

	$totalRows = $("#dataTable tr").length;
	$htmlIndex = ['priority','hfname','hfdate','hflead','hfptr','hfhtr','hfftr','hftype'];
	var columns = {};
	$index ="";
	
	for($i=0;$i<$htmlIndex.length;$i++)
	{
		$index = $htmlIndex[$i];
		columns[$index] = [];
		//get values from each row.
		for($j=0;$j<$totalRows-1;$j++)
		{
			columns[$index][$j] = document.getElementsByName($index +"[]")[$j].innerHTML;

		}

	}
	
		
		console.log(JSON.stringify(columns));
	
	$.ajax({
		   type: "POST",
		   data: {index:JSON.stringify(columns)}, 
		   url: "WriteJSON.php",
		   success: function(data){
			   $(".result").html(data); 
		   }
		});

}


function myFunction() 
{

//Get
//var bla = $('').val();

//Set
//$('#result').text("bla" + "asd");
$("#result").html(bla);  
}



</script>


<div class="maindiv ">

</div>
<br />

<span id=dropdown>Choose File To Load  <select  onchange="reloadTable(this.value)"></select></span>

<hr />
<br />
<?php
echo "<div class=\"mainbuttondiv centerAlign\">";
echo "<input type=\"button\" class=\"btn btn-primary\" value=\"Add Row\" id=\"tablebuttons\" onclick=\"addRow2('dataTable')\">";
echo "<input type=\"button\" class=\"btn btn-primary\" value=\"Delete Row\" id=\"tablebuttons\" onclick=\"deleteRow('dataTable')\">";


echo "<button id=\"btn1\" class=\"btn btn-primary\">Generate Table</button>";
echo "<button id=\"btn2\" class=\"btn btn-primary\">Generate Form</button>";
//echo "<button id=\"btn3\">Generate Total Resources</button>";
echo "<button id=\"btn4\" class=\"btn btn-primary\" onclick=\"writeJSON()\">Write Json</button>";
echo "</div>";

?>
<!-- begin bootstrap div -->
</div>
</body>
</html>