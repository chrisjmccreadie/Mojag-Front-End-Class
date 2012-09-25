<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mojagtest extends CI_Controller {

	/**
	 * 
	 * Mojag class code igniter versions 
	 * 
	 * just copy this into your controller directory and the library into libraries directory easy.
	 * 
	 * 
	 */
	 
	function __construct()
	{
			parent::__construct();
	
	
	}
	
	function testlib()
	{
		$this->load->library('mojagclass');
		$this->mojagclass->works();
	}
	
	function index()
	{
		echo 'ddd';
		//$this->load->library('mojagseo');
		
	}
	
}
		