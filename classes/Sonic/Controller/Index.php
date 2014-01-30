<?php

// Define namespace

namespace Sonic\Controller;

// Start Index Class

class Index extends \Sonic\Controller
{
	
	public function robots ()
	{
		$this->template	= 'cms/robots.tpl';
	}
	
	public function sitemap ()
	{
		
		// Get pages

		$pages	= \Sonic\Model\CMS\Page::_getObjects (array (
			'where'	=> array (
				array ('state_active', '1')
			)
		));

		$this->view->assign ('pages', $pages);
		
		// Output header

		header ('Content-Type: text/xml');
		
		// Set template
		
		$this->template	= 'cms/sitemap.tpl';
		
	}
	
}