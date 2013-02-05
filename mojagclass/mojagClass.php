<?php
/*
 * Mojag Class (PHP version)
 * Copyright : no one, use it and enjoy it.
 * author : Chris McCreadie
 * date added : 10/09/2012
 * date updated : 10/09/2012
 * 
 * This class handles all the calls to the Mojag REST API and very nice it is too.
 * 
 * This class is has been coded it be as simple as possible to make it as accessable as possible, please if it is to simplistic for your needs
 * create a super duper mutexed version with all the trimmings, we would love to invclude it,
 * 
 */
                                error_reporting(E_ALL);
 
class mojagClass
{
	
	var $url='';
	var $useurl='http://www.mojag.co/index.php/rest/rest/';
	//var $useurl='http://localhost:8888/mojag/index.php/rest/rest/';
	
	
    function __construct() {
		$this->url[]='http://www.mojag.co/index.php/rest/rest/';
	 	$this->url[]= 'http://localhost:8888/mojag/index.php/rest/rest/';
		//$this->workingurl();
    }
	
	
	function version()
	{
		echo $this->version;
	}
	
	function update()
	{
		//check to see which version we are using.
	}
	
	 function getAttributes($type,$object)
	 {
	 	//echo $object;
	 
	 	if ($type == 'image')
		{
			
			$doc = new DOMDocument();
    		$doc->loadHTML($object);
    		$imageTags = $doc->getElementsByTagName('img');

    		foreach($imageTags as $tag) {
        		//return($tag->getAttribute('src'));
    			$pic[]=array("src"=>$tag->getAttribute('src'));
			}
			
			//print_r($pic);
			//exit;
			return($pic);
			}
		if ($type == 'href')
		{
			$tmp = explode('href="',$object);
			$tmp2 = explode('">',$tmp[1]);
			return($tmp2[0]);
			
		}
	 }
	
	/*
	 * GENERIC FUNCTION
	 */
	 function ping()
	 {
	 	//might add oauth here to stop people tring to dos us.
	 	//echo 'in';
	 	$url = "ping/";
	 	$hearbeat = $this->fetchPage($url);
		return($hearbeat->hearbeat);

		//echo $hearbeat;
	 }
	 
	 
	function workingurl()
	{
		//TO DO.
		//print_r($this->url);
		//and check by echoing
		$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
		$context = stream_context_create($opts);
		$str = file_get_contents($this->url,false,$context);	
		//print_r($str);
		//exit;
	}
	

	

	//this function fetches the page.
	function fetchPage($url)
	{
		//if its a heartbeast set the timeout to one second
		if ($url == "ping/")
			$opts = array(  'http' => array( 'timeout' => 1   ) ) ;
		else
	 		$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
		
		//define the page to call here
		$url = $this->useurl.$url;
		//debug information
		//echo $url.'</br>';
		//exit;
		//get the contents, this would be better in CURL but its not on 100% of all servers.
		
		$context = stream_context_create($opts);
		$str = file_get_contents($url,false,$context);
	//	echo "str".$str;
		//exit;
		//decode the json
		$data = json_decode($str);
		//print_r($data);
		//exit;
		return($data);
		//print_r($data);
	}
	
	function searchContent($search,$pagecontent,$default='')
	{
		//loop through the content
		foreach ($pagecontent as $data)
		{
			//force it to be a object, damn you PHP behave.
	    	$dobj = (object) $data;
			//check if this is the object you are looking for
			if (strtolower($dobj->key) == strtolower($search))
			{
				//return the value.
				return($dobj->value);
			}
		}
		//return the default
		return($default);
	}
	
	//this function will fetch and element from a object.
	function searchContentNew($search,$pagecontent,$default='')
	{
		//loop through the content
		//print_r($pagecontent);
		if (!is_object($data)) {
			//echo 'objects not supported yet';
			return($default);
			exit;
		}
	else {
	

		////exit;
		foreach ($pagecontent as $data)
		{
			//echo 'kk';
			//print_r($data);
			//force it to be a object, damn you PHP behave. Also check it is not already one
	    	//if (!is_object($data)) {
	    		//echo 'not object';
				//exit;
				$dobj = (object) $data;
			//}
			//else {
				//$dobj = $data;
			//}
			
			//echo $dobj->key;
			//exit;
			////echo $dobj->key;
			//check f this is the object you are looking for
			if (strtolower($dobj->key) == strtolower($search))
			{
				//return the value.
			//	echo 'iii';
				return($dobj->value);
			}
		}
		//return the default
		exit;
		return($default);
		}
	}

	
	/*
	 * END OF GENERIC FUNCTIONS
	 */
	 
	 
	 function fecthSeo($pageid)
	 {
		$url = "seoData?id=$pageid";
		$seo = $this->fetchPage($url);
			//exit;
		return($seo);
		
	 }
	 
	 function getKeyword($siteid,$keywords)
	 {
		//This function get the objects which match the keywords.
		
		$url = "meta/?id=$siteid&keywords=$keywords";

		$meta = $this->fetchPage($url);
		//echo 'meta';
		//print_r($meta);
		//echo 'end';
		return($meta);
	 }
	 
	 function getArchiveMeta($id,$keywords)
	 {
	 	//update function to work with more than one keyword.
		//	/index.php/rest/rest/archivepages?id=15
		$url = "archivepages/?id=$id=$keywords";
		$meta = $this->fetchPage($url);
		return($meta);		
	 }
	
	 
	 
	 
	 function getSitemap($siteid,$format=1)
	 {
	 	$url = "sitemap?siteid=$siteid";
		$sitemap = $this->fetchPage($url);
		//print_r($sitemap);		
	 	
	 	
	 	//deal with the sitemap
	 	//we will format it or return it as an array.
	 	if ($format == 1)
		{
			$sm = "<ul>";
			foreach ($sitemap as $site)
			{
				if ($site->url == '')
					$u = '#';
				else {
					$u = $site->url;
				}
				$sm=$sm."<li><a href='$u'>$site->name</a></li>";
			}
			$sm = $sm."</ul>";
			return($sm);
		}
		else {
			return($data);
		}
	 }
	 
	 
	 function getRawMenu($siteid)
	 {
		$url = "menu/?id=$siteid";
		$menu = $this->fetchPage($url);
		return $menu;	 	
	 }
	 
	 function getMenu($siteid,$class='navigation',$active='',$target='_self')
	 {
		//get the menu using the site id
		//update
		
		$url = "menu/?id=$siteid";
		$menu = $this->fetchPage($url);
		//echo 'data'.print_r($data);
		//echo $data;
		//exit;
		//check it is not a protected domain and if it is return false
		//to do the above.
		$menuo ="<ul class=\"$class\">";
		
		
		if ($active == '')
		{
				//get the name of the page (can update to use the getname function) and if its blank set it to index.php
				$sr = explode("/",$_SERVER['REQUEST_URI']);
				$name = $sr[count($sr)-1];
				//set blank to index.php (may want to change this to site default)
				if ($name == '')
				{
					$name = 'index.php';
				}			
		}
		else {
			$name = $active;
		}

		//loop through and build the menu
		foreach ($menu as $item)
		{
			if ($name == $item->url)
			{
				$menuo = $menuo."<li><a href=\"$item->url\" target=\"$target\" class=\"sel\">$item->outputname</a></li>";
			
			}
			else	
			{
				$menuo = $menuo."<li><a href=\"$item->url\" target=\"$target\" id=\"\">$item->outputname</a></li>";
			}
		}
		$menuo = $menuo."</ul>";
		return($menuo);
	 }
	
	
	//This function get the outname and checks for that
	function getContentObjectByOutputname($siteid,$counter=1,$outputname='')
	{
		//get the output name, it will return the last url part but you can override it.
		if($outputname == '')
		{
			$url = $_SERVER["PATH_INFO"];
			$url2 = explode('/',$url);
			$url3 = $url2[count($url2)-$counter];
			
		}
		else
		{
			$url3 = $outputname;
		}
		
		$url = "pageoutputname?id=$siteid&on=$url3";
		$data = $this->fetchPage($url);
		
		//return the  data
		$data2 = $data[0]->pagedata;
		foreach($data2 as $index=>$val){    
		foreach($data2[$index] as $key => $value) {
			$datafin[] = array('key' => $key,'value' =>$value);
			}
		}
		$datafin['user'] = $data[0]->user;
		return($datafin);
	}
	
	//this function gets the pageid
	function getPage($pageid)
	{
		$url = "page/?id=$pageid";
		$page = $this->fetchPage($url);
		//echo 'meta';
		//print_r($page);
		//exit;
		//echo 'end';
		return($page);
	}
	

	
	//this function gets the site
	function getSite($siteid)
	{
		$url = "site/?id=$siteid";
		$site = $this->fetchPage($url);
		//echo 'meta';
		//print_r($meta);
		//echo 'end';
		if ($site != 0)
		{
			return($site);
		}
		else
		{
			return( array("error"=>'Site information not found'));
		}
	}
}
	
?>
