<?php
//include the header Mojag Class
include ('../../../mojagclass/mojagClass.php');
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
//get the sitemap
$sitemap = $mojag->getSitemap($siteid);
//debug
//print_r($pagecontent);
?>
<!DOCTYPE HTML>
<html>
<body>
<?php  
	//search for the title and output it, you specify a default incase it is not found
	echo $sitemap;
?>

</body>
</html>