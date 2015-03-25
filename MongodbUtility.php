<?php

class MongodbUtility
{
	
	private $db;
	private $dbHost;
	private $dbName;
	private $collection;
	private $collectionName;
	
	//counstruct 
	//$dbhost - host IP address
	//$dbname - name of the database
	//$collection - table name
	public function MongodbUtility($_dbHost, $_dbName, $_collectionName)
	{
		
		$this->dbHost = $_dbHost;
		$this->dbName = $_dbName;
		$this->collectionName = $_collectionName;
		
	}
	
	function connectMongoDB()
	{
	
		// Configuration
		//$dbhost = "10.108.24.166";
		//echo $this->dbName;
		//echo $this->dbHost;
	
		try
		{
			$mongo = new MongoClient("mongodb://$this->dbHost");
			$dbName = $this->dbName;
			$this->db = $mongo->$dbName;
			
			//var_dump($this->db);
			
			//remove
			//print_r($this->db);
			$this->collection = $mongo->selectCollection($this->dbName, $this->collectionName);
			
			//print_r($this->collection);
			
		}
		catch ( MongoConnectionException $e )
		{
			echo '<p>Couldn\'t connect to mongodb, is the "mongo" process running?</p>';
			exit();
		}
	}
	
	//metod to write to db. Pass Json as an array
	public function insertToMongodb($_json)
	{
		var_dump($_json);
		$finalJson = json_decode($_json);
		
		$this->collection->insert($finalJson);
		
		
	}
	
	
}

?>