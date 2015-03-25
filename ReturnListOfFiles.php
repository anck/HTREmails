<?php

function returnFileList($dir)
{
	$files = scandir($dir, SCANDIR_SORT_DESCENDING);
	//$newest_file = $files[0];
	return $files;
}
?>