<?php

/*
 * Mojag Cache (PHP version)
 * Copyright : none, use it and enjoy it.
 * author : Chris McCreadie
 * date added : 05/10/2012
 * date updated : 01/03/2013
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
 * TODO: add memcachier support.
 * 
 * Memcachier.
 * 
 * http://www.memcachier.com/
 * 
 * Using memcachier is very convient for many sites that do have write access to their files.  You can store the data in the cloud.
 * 
 */

class mojagCache {
	
	//the live url checker
	//expiration time.
	var $expiration = 3600;  // 1 hour
   
    function __construct()
    {
    	//set the cache dir.
        $this->dir = $_SERVER['DOCUMENT_ROOT'].'/mojagclass/cache';
		//print_r($this->dir);
		//exit;    
	}
	

	//set the name.
    private function _name($key)
    {
        return sprintf("%s/%s", $this->dir, sha1($key));
    }

	//get the cached object
    public function get($key,$exipre=0)
    {

		//check the dir exists and is writeable.
        if ( !is_dir($this->dir) OR !is_writable($this->dir))
        {
            return FALSE;
        }
		//set the cache path
        $cache_path = $this->_name($key);
		//return false if it does not exist
        if (!@file_exists($cache_path))
        {
            return FALSE;
        }
		
		//check if we are using an expiry, it defaults to never expire the content
		if ($exipre == 1)
		{
			//the cached file is older than the expiry time
			 if (filemtime($cache_path) < (time() - $this->expiration))
       		 {
       			//clear the cached file
          	  	$this->clear($key);
				//return to recache
            	return FALSE;
        	}			
		}

		//open the file.
        if (!$fp = @fopen($cache_path, 'rb'))
        {
            return FALSE;
        }
		//lock it.
        flock($fp, LOCK_SH);
		
        $cache = '';
		//read it
        if (filesize($cache_path) > 0)
        {
            $cache = unserialize(fread($fp, filesize($cache_path)));
        }
        else
        {
        	//the file is blank so we need to recache.
        	//echo 'in fileszie else';
			//exit;
            $cache = FALSE;
        }
		//unclock it.
        flock($fp, LOCK_UN);
        fclose($fp);

        return $cache;
    }

	//set the cache object
    public function set($key, $data)
    {
    		//check we can write the data
 	   		if ( !is_dir($this->dir) OR !is_writable($this->dir))
	        {
	            return FALSE;
	        }
			//set the cache path
	        $cache_path = $this->_name($key);
			//open it
	        if ( ! $fp = fopen($cache_path, 'wb'))
	        {
	            return FALSE;
	        }
			//lock it
	        if (flock($fp, LOCK_EX))
	        {
	        	//set a cahce time and add it to the object, we could use file time it was created as well.
	        	$data->mojagcachetime = time();	
		       // $data['mojagcached] = time();	
	        	//print_r($data);
				//exit;
				//save the file
	            fwrite($fp, serialize($data));
				//rekease it.
	            flock($fp, LOCK_UN);
	        }
	        else
	        {
	            return FALSE;
	        }
	        fclose($fp);
	        @chmod($cache_path, 0777);
	        return true;
	
    }

	//clear the cache.
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