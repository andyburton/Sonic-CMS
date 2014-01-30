<?php

// Define namespace

namespace Sonic\CMS;

// Start Module Class

abstract class Module
{
	
	
	/**
	 * CMS Module ID
	 * @var integer 
	 */
	
	public $module_id = FALSE;
	
	
	/**
	 * Add the module to a page, return boolean or the module object
	 * Doing any module specific creation processes here
	 * @param \Sonic\Model\CMS\Page $page Page object
	 * @param array $data Data array
	 * @return boolean|object
	 */

	public function Add ($page, $data = array ())
	{
		return TRUE;
	}
	
	
	/**
	 * Edit the module for a page, return boolean
	 * @param \Sonic\Model\CMS\Page $page Page object
	 * @param array $data Data array
	 * @return boolean|object
	 */

	public function Edit ($page, $data = array ())
	{
		return TRUE;
	}
	
	
	/**
	 * Remove the module from a page
	 * Doing any module specific clean up processes here
	 * @param integer $pageID Page ID
	 * @return boolean
	 */

	public function Remove ($page)
	{
		return TRUE;
	}
	
	
	/**
	 * Load and return the admin template for the module
	 * @param integer $pageID Page ID
	 * @return string
	 */

	public function Load ($page)
	{
		return TRUE;
	}
	
	
	/**
	 * Display the module for a page
	 * @param \Sonic\Resource\View $view View
	 * @param \Sonic\Model\CMS\Page $page CMS Page
	 * @return string
	 */

	public function Display ($view, $page)
	{
		return NULL;
	}
	
	
	/**
	 * Return the data model object for the page module
	 * @param integer $pageID Page ID
	 * @return object|boolean
	 */
	
	public function getModuleObject ($pageID)
	{
		return FALSE;
	}


}