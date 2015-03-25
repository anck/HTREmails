/**
 * 
 */
function showValues() 
{
     var str = $("form").serialize();
     $(".results-box").fadeIn();
     $(".results").text(str);
}

//adds a row in the give HTML table.
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

//Deletes a row in a given HTML table.
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

//Cahnges the color of the text box in use.
$(document).ready(function()
{
  $("input").focus(function(){
    $(this).css("background-color","#cccccc");
  });
  $("input").blur(function(){
    $(this).css("background-color","#ffffff");
  });
});

//Converts a Form into text.
$(document).ready(function()
{
	$("#btn1").click(function()
	{
		
			$(".HTRForm").replaceWith(function()
			{
			   return "<span class=\"HTRTable\" id=\""+ this.id +"\">" + this.value + "</span>";
			});

			
		
	});
});

//Converts text into form
$(document).ready(function()
{
	$("#btn2").click(function()
		{
		
			$(".HTRTable").replaceWith(function()
			{
				return "<input type=\"text\" class=\"HTRForm\" id=\"" + this.id + "\" value=\"" + $(this).text() + "\">";
			  // return "<span id=\"HTRTable\">"this.value"</span>;
			});
			
	});
});

