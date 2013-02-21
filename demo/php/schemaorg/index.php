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
$siteid = 191;
//get the stock.
$stockdata = $mojag->getStock($siteid);
$stockdata = '[{"id":"11","name":"Ace Job","meta":"job,uk,showcase","itemtype":"http:\/\/schema.org\/JobPosting","itemscope":"","data":[{"id":"30","name":"Job Type","value":"Freelance","itemtype":"additionalType","itemscope":"eee"},{"id":"31","name":"Job Sector","value":"B2C","itemtype":"industry","itemscope":"eee"},{"id":"32","name":"Job Salary","value":"?80-100k","itemtype":"baseSalary","itemscope":"eee"},{"id":"33","name":"Job Location","value":"London","itemtype":"jobLocation","itemscope":"eee"},{"id":"34","name":"Job Ttile","value":"Account Executive","itemtype":"title","itemscope":"eee"},{"id":"35","name":"Job Org","value":"Agency","itemtype":"hiringOrganization","itemscope":"eee"},{"id":"36","name":"Job Ref","value":"sssdsdd","itemtype":null,"itemscope":"eee"},{"id":"37","name":"Job Description","value":"dukdddddd\n","itemtype":"description","itemscope":"eee"}]}]';
//debug
//print_r($pagecontent);
?>
<!DOCTYPE HTML>
<html>
<body>
<?php  
	//search for the title and output it, you specify a default incase it is not found
	$output = "<div>";
	foreach ($stockdata as $stock)
	{
		$output= $output.$mojag->processSchema($stock->value,$stock->data->itemtype);
		
	}
	$output = $output.'</div>';
	//output the formatted schema data
	echo $output;
?>

</body>
</html>