<?php

//require 'MongodbConnect.php';
require 'MongodbUtility.php';

//$db = connectMongoDB();
//var_dump($db);
$obj = new MongodbUtility("10.108.24.166", "HTRdb_test", "HTRdata");
$obj -> connectMongoDB();

$str_data = file_get_contents("./htrjsonfiles/HTRjson.json");
$data = json_decode($str_data,true);
//var_dump($data);
$obj->insertToMongodb($data);

?>