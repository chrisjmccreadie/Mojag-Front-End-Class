<?php
echo 'Checking version<br>';
$version = '1';
$versionurl = 'http://www.mojag.co/index.php/rest/rest/version';
//debug
$versionurl = 'http://localhost:8888/index.php/rest/rest/version';
$context = stream_context_create($opts);
$str = file_get_contents($versionurl,false,$context);	
echo "Current version ".$version.'<br>';
if ($str != $version)
{
	echo 'You are not running the latest version please update from <a href="https://github.com/chrisjmccreadie/Mojag-Front-End-Class" target="_blank">here</a>';
	//echo 'Or auto update (need write permissions) by clicking here.'
}
//print_r($str);

?>