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
$siteid = 16;
//set which url segement you want 0 means ignore
$urlsegement =0;
//set the url segement name, this is optional if you do not want to use a url segement
$urlsegementname="home";
//fetch the content
$pagecontent = $mojag->getContentObjectByOutputname($siteid,$urlsegement,$urlsegementname);
//print_r($pagecontent[1]['value']);
//debug
//fetch the content
$attribuates = $mojag->getAttributes('image',$pagecontent[1]['value']);

//debug
//print_r($menu);
?>
<!DOCTYPE HTML>
<html>
<body>
<?php
	//this is the menu
	print_r($attribuates);
?>
</body>
</html>