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
//set the keyword that you want to search on.
$keywords = "Home";
//fetch the content
$data = $mojag->getKeyword($siteid,$keywords);
//debug
//print_r($menu);
?>
<!DOCTYPE HTML>
<html>
<body>
<?php
	//this is the menu
	echo $data;
?>
</body>
</html>