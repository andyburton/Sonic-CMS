<?php

// Define namespace

namespace Sonic\Controller;

// Start Admin Class

class Admin extends \Sonic\Controller\Session
{
	
	
	/**
	 * Display the admin index page
	 */
	
	public function index ()
	{
	}
	
	
	/**
	 * Clear the view cache
	 */
	
	public function clearcache ()
	{
		
		if ($this->view instanceof \Sonic\View\Smarty)
		{
			$this->view->clearCompiledTemplate ();
			$this->view->clearAllCache ();
		}
		
		new \Sonic\Message ('success', 'Cache Cleared');
		$this->template = 'admin/index.tpl';
		
	}
	
	
}