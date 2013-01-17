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
$siteid = 15;
//set the keyword that you want to search on.
$keywords = "Blog";
//fetch the content
$data = $mojag->getKeyword($siteid,$keywords);
//debug
//print_r($data);
?>
<!DOCTYPE HTML>
<html>
<body>
<?php
	//this is the menu
	print_r($data);
?>
</body>
</html>