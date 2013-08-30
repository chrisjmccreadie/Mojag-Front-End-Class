<?php
/*
 * This is a standalone file to test and set the correct paramates for mojag.
 */

	echo 'testing rest servers<br/>';
	$url[]= 'http://localhost:8888/mojag/index.php/rest/rest/';
	$url[]= 'http://mojaguseast.aws.af.cm/rest/rest/';	
	$url[]= 'http://www.mojag.co/index.php/rest/rest/';
	foreach($url as $u)
	{
		echo "Testing ".$u.'</br>';
		$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
		$context = stream_context_create($opts);
		$str = file_get_contents($u.'ping/',false,$context);
		echo "str".$str;
		//exit;
		//decode the json
		//$data = json_decode($str);
		//echo $data;
		if ($str == '{"hearbeat":1}')
		{
			echo "Rest server $u is up".'<br/>';
			//save it
			file_put_contents($_SERVER['DOCUMENT_ROOT'].'/cache/server.txt',$u);	
		}
		else
		{
			echo "Rest server $u is NOT up".'<br/>';
			
		}
	}
		
		
?>