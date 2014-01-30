<?php

// Define namespace

namespace Sonic\CMS\Module;

// Start Redirect class

class Redirect extends \Sonic\CMS\Module
{
	
	
	/**
	 * Add the module to a page
	 * @param \Sonic\Model\CMS\Page $page Page object
	 * @param array $data Data array
	 * @return boolean
	 */
	
	public function Add ($page, $data = array ())
	{
		return $this->AddEdit ($page->getPK (), $data);
	}
	
	
	/**
	 * Edit the module for a page
	 * @param \Sonic\Model\CMS\Page $page Page object
	 * @param array $data Data array
	 * @return boolean
	 */
	
	public function Edit ($page, $data = array ())
	{
		return $this->AddEdit ($page->getPK (), $data);
	}
	
	
	/**
	 * Add or edit an existing module object
	 * @param integer $pageID Page ID
	 * @param array $data Module Data
	 * @return type
	 */
	
	public function AddEdit ($pageID, $data)
	{
		
		// Load object
		
		$obj = $this->getModuleObject ($pageID);
		
		// Get redirects
		
		$redirects	= $this->getModuleObjects ($pageID);
		
		// Begin transaction
		
		$obj->db->beginTransaction ();
		
		// Create/update entries
		
		foreach ($data['redirects'] as $id => $redirect)
		{
			
			if (!$redirect)
			{
				continue;
			}
			
			if (strpos ($id, 'new') !== FALSE)
			{
				$id	= FALSE;
			}
			else
			{
				foreach ($redirects as $key => $existingRedirect)
				{
					if ($key == $id)
					{
						unset ($redirects[$key]);
					}
				}
			}
			
			$redirectObj	= $this->getModuleObject ($pageID, $id);
			$redirectObj->set ('redirect', $redirect);
			
			// Check redirect doesnt exist for a page
			
			if (($page = \Sonic\Model\CMS\Page::_getRedirect ($redirect)))
			{
				new \Sonic\Message ('error', 'The redirect path `' . $redirect . '` already exists for the `' . $page->name . '` page!');
				$obj->db->rollBack ();
				return FALSE;
			}
			
			// Check redirect doesnt exist already as another redirect rule
			
			if ($redirectObj::_Count (array (
				'where'	=> array (
					array ('redirect',	$redirect),
					array ($redirectObj::$pk, $id, '!=')
				)
			)))
			{
				new \Sonic\Message ('error', 'The redirect path `' . $redirect . '` already exists!');
				$obj->db->rollBack ();
				return FALSE;
			}
			
			$return			= $redirectObj->getPK ()? $redirectObj->Update () : $redirectObj->Create ();
			
			if (!$return)
			{
				$obj->db->rollBack ();
				return FALSE;
			}
			
		}
		
		// Delete remaining redirects
		
		foreach ($redirects as $old)
		{
			if (!$old->delete ())
			{
				$obj->db->rollBack ();
				return FALSE;
			}
		}
		
		// Commit and return
		
		$obj->db->commit ();
		return TRUE;
		
	}
	
	
	/**
	 * Remove a module from a page
	 * @param integer $page Page ID
	 * return boolean
	 */
	
	public function Remove ($pageID)
	{
		
		// Get objects
		
		$objs	= $this->getModuleObjects ($pageID);
		
		// If no objects
		
		if (!$objs)
		{
			return TRUE;
		}
		
		// Remove objects
		
		foreach ($objs as $obj)
		{
			if (!$obj->delete ())
			{
				return FALSE;
			}
		}
		
		// All removed
		
		return TRUE;
		
	}
	
	
	/**
	 * Load the module for a page in the admin
	 * @param integer $page Page ID
	 * @return string
	 */

	public function Load ($pageID)
	{
		
		// View to render template
		
		$view = new \Sonic\View\Smarty;

		// Assign objects

		$view->assign ('module_id',	$this->module_id);
		$view->assign ('name',		'cms_module[' . $this->module_id . ']');
		$view->assign ('redirects',	$this->getModuleObjects ($pageID));

		// Return rendered template

		return $view->fetch ('admin/cms/modules/redirect/load.tpl');
		
	}
	
	
	/**
	 * Load the redirect objects for the page
	 * @param integer $pageID Page ID
	 * @return \Sonic\Resource\Model\Collection
	 */
	
	public function getModuleObjects ($pageID)
	{
		return \Sonic\Model\CMS\Page\Redirect::_getObjects (array (
			'where' => array (
				array ('page_id', $pageID)
			)
		));
	}
	
	
	/**
	 * Load a redirect object
	 * @param integer $pageID Page ID
	 * @param integer $redirectID Redirect ID
	 * @return \Sonic\Model\CMS\Page\Redirect
	 */
	
	public function getModuleObject ($pageID, $redirectID = FALSE)
	{
		if ($redirectID)
		{
			return \Sonic\Model\CMS\Page\Redirect::_read (array (
				'where'	=> array (
					array (\Sonic\Model\CMS\Page\Redirect::$pk, $redirectID),
					array ('page_id', $pageID)
			)));
		}
		else
		{
			$obj	= new \Sonic\Model\CMS\Page\Redirect;
			$obj->set ('page_id', $pageID);
			return $obj;
		}
		
	}
	
}