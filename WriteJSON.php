<?php
// Modify the value, and write the structure to a file "data_out.json"
//
$data["boss"]["Hobbies"][0] = "Swimming";
 
$fh = fopen("data_out.json", 'w')
      or die("Error opening output file");
fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
fclose($fh);
?>