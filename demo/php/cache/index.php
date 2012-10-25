<?php
//include the header Mojag Class
include ('../../../mojagclass/mojagClass.php');
include ('../../../mojagclass/mojagCache.php');
$cache = new mojagCache('../../../mojagclass/cache');  //Make sure it exists and is writeable  

//load the class
if (class_exists('mojagClass')) {
	$mojag = new mojagClass();
}
else
{
	echo 'class does not exist';
}
//set your site id
$siteid = 16;
//set which url segement you want 0 means ignore
$urlsegement =0;
//set the url segement name, this is optional if you do not want to use a url segement
$urlsegementname="home";
//fetch the content

$pagecontent = $cache->get($urlsegementname.$siteid);  
  
if ($pagecontent === FALSE)  
{  
    echo  'This will be cached';  
	$pagecontent = $mojag->getContentObjectByOutputname($siteid,$urlsegement,$urlsegementname);
    $cache->set($urlsegementname.$siteid, $pagecontent);  
} 
else
{
	echo 'served from cache';
}
//debug
//print_r($pagecontent);
//check fro a content error here and process if you find.
?>
<!DOCTYPE HTML>
<html>
<body>
<h1>
<?php  
	//search for the title and output it, you specify a default incase it is not found
	echo $mojag->searchContent('title',$pagecontent,'This is the title'); 
?>
</h1>

</body>
</html>