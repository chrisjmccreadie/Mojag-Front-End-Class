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
//fetch the content
$site = $mojag->getSite($siteid);
//debug
//print_r($menu);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $seo->title;?> </title>
<meta name="description" content="<?php echo $seo->description;?>">
<meta name="viewport" content="width=device-width">

</head>
<body>
	Site Information.
<?php
	print_r($site);

?>
</body>
</html>