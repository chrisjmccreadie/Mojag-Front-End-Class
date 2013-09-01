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
//tell Mojag Class to do the caching for us
$mojag->cacheit = 1;
//turn off debugging
$mojag->debug = 0;
//set your site id
$siteid = 16;
//set which url segement you want 0 means ignore
$urlsegement =0;
//set the url segement name, this is optional if you do not want to use a url segement
$urlsegementname="home";
//fetch the content
$pagecontent = $mojag->getContentObjectByOutputname($siteid,$urlsegement,$urlsegementname);
?>
<!DOCTYPE HTML>
<html>
<body>
<h1>
<?php  
	//search for the title and output it, you specify a default incase it is not found
	echo $mojag->searchContent('title',$pagecontent['pagedata'],'This is the title'); 
?>
</h1>

</body>
</html>