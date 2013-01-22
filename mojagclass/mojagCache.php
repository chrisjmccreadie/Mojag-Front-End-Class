<?php

/*
 * Mojag Cache (PHP version)
 * Copyright : none, use it and enjoy it.
 * author : Chris McCreadie
 * date added : 05/10/2012
 * date updated : 05/10/2012
 * 
 * This class handles all the caching at an object level.
 * 
 * This class is has been coded it be as simple as possible to make it as accessable as possible, please if it is to simplistic for your needs
 * create a super duper mutexed version with all the trimmings, we would love to invclude it,
 * 
 * Based othe JGCache class which can be found here
 * 
 * 	http://www.jongales.com/blog/2009/02/18/simple-file-based-php-cache-class/
 * 
 */

class mojagCache {
	
	//the live url checker
	var $checkurls = array("url" =>'http://www.mojag.co/index.php/rest/rest/checkliveserver/');
	//expiration time.
	var $expiration = 3600;

    function __construct($dir)
    {
        $this->dir = $_SERVER['DOCUMENT_ROOT'].'mojagclass/cache';
		print_r($this->dir);
		exit;
    }
	
	private function checkServerLive()
	{
		/*
		 * This function checks that the server is live.  This is an array of server to check which one is alive.
		 */
		foreach ($checkurls as $url)
		{
			//print_r($url);
			$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
			$context = stream_context_create($opts);
			$str = file_get_contents($url,false,$context);
			if ($str == "true")
				return($str);
		}
		return('false');		
				//print_r($urls);
		
	}

    private function _name($key)
    {
        return sprintf("%s/%s", $this->dir, sha1($key));
    }

    public function get($key,$exipre=1)
    {

        if ( !is_dir($this->dir) OR !is_writable($this->dir))
        {
            return FALSE;
        }

        $cache_path = $this->_name($key);

        if (!@file_exists($cache_path))
        {
            return FALSE;
        }
		
		//over the exipre as the server is down, oh noez.
		if ($exipre == 1)
		{
			//echo 'expiring';
			 if (filemtime($cache_path) < (time() - $this->expiration))
       		 {
          	  	$this->clear($key);
            	return FALSE;
        	}			
		}
		else
		{
			//echo 'not expiring';
		}


        if (!$fp = @fopen($cache_path, 'rb'))
        {
            return FALSE;
        }

        flock($fp, LOCK_SH);

        $cache = '';

        if (filesize($cache_path) > 0)
        {
            $cache = unserialize(fread($fp, filesize($cache_path)));
        }
        else
        {
            $cache = NULL;
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        return $cache;
    }

    public function set($key, $data)
    {

        if ( !is_dir($this->dir) OR !is_writable($this->dir))
        {
            return FALSE;
        }

        $cache_path = $this->_name($key);

        if ( ! $fp = fopen($cache_path, 'wb'))
        {
            return FALSE;
        }

        if (flock($fp, LOCK_EX))
        {
            fwrite($fp, serialize($data));
            flock($fp, LOCK_UN);
        }
        else
        {
            return FALSE;
        }
        fclose($fp);
        @chmod($cache_path, 0777);
        return TRUE;
    }

    public function clear($key)
    {
        $cache_path = $this->_name($key);

        if (file_exists($cache_path))
        {
            unlink($cache_path);
            return TRUE;
        }

        return FALSE;
    }
}