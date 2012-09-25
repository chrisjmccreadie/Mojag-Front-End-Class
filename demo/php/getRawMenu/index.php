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
//fetch the content
$menu = $mojag->getRawMenu($siteid);

//debug
//print_r($menu);
?>
<!DOCTYPE HTML>
<html>
<body>
<?php
	//this is the menu
echo $menu;
?>
</body>
</html>