<?php

#defunt
function connectMongoDB($dbName)
{
	
	// Configuration
	$dbhost = "10.108.24.166";
	//$dbName = "HTRdb_test";
	
	// Connect to test database
	//$m = new Mongo("mongodb://$dbhost");
	//$db = $m->$dbname;
	
	try 
	{
		$mongo = new MongoClient("mongodb://$dbhost");
		$db = $mongo->$dbName;
		
		print_r($db);
		return $db;
	}
	catch ( MongoConnectionException $e )
	{
		echo '<p>Couldn\'t connect to mongodb, is the "mongo" process running?</p>';
		exit();
	}
}
//connectMongoDB("HTRdb_test");

?>