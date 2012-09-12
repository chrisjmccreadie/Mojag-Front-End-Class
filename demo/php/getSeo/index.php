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
$pageid = $_GET['id'];
if ($pageid == '')
	$pageid = 103;
//fetch the content
$seo = $mojag->fecthSeo($pageid);
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
Seo in the in the title and description tags
</body>
</html>