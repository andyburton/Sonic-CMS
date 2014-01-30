<?php

// Define namespace

namespace Sonic\Controller;

// Start CMS Class

class CMS extends \Sonic\Controller
{

	
	/**
	 * CMS_Page object
	 * @var \Sonic\Model\CMS\Page
	 */
	
	protected $page			= FALSE;
	
	
	/**
	 * Instantiate class
	 * @return void
	 */
	
	public function __construct ()
	{
		
		// Call parent constructor
		
		parent::__construct ();
		
		// Set smarty view
		
		$this->view	= new \Sonic\View\Smarty;
		
	}
	
	
	/**
	 * Detect which page we are viewing from the URL
	 * @throws Exception
	 * @return void
	 */
	
	public function findPage ()
	{
		
		// Get URL
		
		$url	= isset ($_SERVER['REDIRECT_URL'])? $_SERVER['REDIRECT_URL'] : FALSE;
		
		// Remove initial /
		
		if ($url[0] == '/')
		{
			$url	= substr ($url, 1);
		}
		
		// Check for page ID
		
		$id		= (int)$this->getURLArg ('pid');
		
		// If there is a page id then attempt to load it
		
		if ($id)
		{
			$this->page	= \Sonic\Model\CMS\Page::_Read ($id);
		}
		
		// Else if there is a url attempt to load the page from it
		
		else if ($url)
		{
			
			$this->page	= \Sonic\Model\CMS\Page::_getRedirect ($url);
			
			// No redirect attempt 301 redirects
			
			if (!$this->page && \Sonic\Model\CMS\Module::_checkExists ('Redirect'))
			{
				
				$redirect = \Sonic\Model\CMS\Page\Redirect::_Read (array (
					'where'	=> array (
						array ('redirect', $url)
					)
				));
				
				if ($redirect)
				{
					$this->page	= $redirect->getRelated ('\Sonic\Model\CMS\Page');
					header ('HTTP/1.1 301 Moved Permanently');
					new \Sonic\Resource\Redirect ($this->page->generateURL ());
					exit;
				}
				
			}
			
		}
		
		// Else if there is nothing load the homepage
		
		else
		{
			$this->page	= \Sonic\Model\CMS\Page::_getHomepage ();
		}
		
		// Error if no page has been loaded
		
		if (!($this->page instanceof \Sonic\Model\CMS\Page))
		{
			throw new \Sonic\Exception ('Invalid page', 404);
		}
		
	}
	
	
	/**
	 * Render view
	 * @return void 
	 */
	
	public function View ()
	{
		
		// Redirect to external URL
		
		if ($this->page->get ('external_url'))
		{
			new \Sonic\Resource\Redirect ($this->page->get ('external_url'));
			exit;
		}
		
		// Load page template
		
		$template	= \Sonic\Model\CMS\Template::_Read ($this->page->get ('template_id'));
		
		if (!$template)
		{
			throw new \Sonic\Exception ('Invalid template');
		}
		
		// Load smarty template
		
		if ($this->view->templateExists ('cms/' . $template->get ('file')))
		{
			
			// Set template
			
			$this->template	= 'cms/' . $template->get ('file');
			
			// Assign page

			$this->view->assign ('page',	$this->page);

			// Render view

			parent::View ();
			
		}
		
		// Else load template file
		
		else
		{
			require_once (ABS_ROOT . 'templates' . DS . $template->get ('file'));
			return;
		}
		
	}
	
	
}