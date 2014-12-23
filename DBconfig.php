<?php

function DBconnect($hostname, $username, $password, $dbname)
{
	#$hostname=host;
	#$username=username;
	#$password=password;
	#$dbname=dbname;
	echo $hostname, $username, $password, $dbname;
	$conn = mysqli_connect($hostname, $username, $password, $dbname);
	if (!$conn)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT *FROM DemoHTR";
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) 
	{
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) 
	    {
	        echo $row["priority"];
	    }
	} 
	else 
	{
    	echo "0 results";
	}

mysqli_close($conn);
	
}

?>