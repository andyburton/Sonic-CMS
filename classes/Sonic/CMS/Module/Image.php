<?php

// Define namespace

namespace Sonic\CMS\Module;

// Start Image class

class Image extends \Sonic\CMS\Module
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
		
		// If no data (happens for an admin page edit)
		
		if ($data === 'true')
		{
			return TRUE;
		}
		
		// Load object
		
		$imageID	= isset ($data['image_id'])? $data['image_id'] : FALSE;
		$obj = $this->getModuleObject ($pageID, $imageID); 
		
		// Set details
		
		$obj->fromArray ($data);
		
		if (\Sonic\Message::count ('error') > 0)
		{
			return FALSE;
		}
		
		if (isset ($data['file']))
		{
			if (!$obj->Upload ($data['file']))
			{
				return FALSE;
			}
		}
		
		// Begin transaction
		
		$obj->db->beginTransaction ();
		
		// Create or update
		
		if ($obj->getPK ())
		{
			$return	= $obj->Update ();
		}
		else
		{
			$return	= $obj->Create ();
			if (!$return)
			{
				$obj->RemoveFile ();
			}
		}
		
		if (!$return)
		{
			$obj->db->rollBack ();
			return FALSE;
		}
		
		$obj->db->commit ();
		return $obj;
		
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
		$view->assign ('images',	$this->getModuleObjects ($pageID));

		// Return rendered template

		return $view->fetch ('admin/cms/modules/image/load.tpl');
		
	}
	
	
	/**
	 * Load the image objects for the page
	 * @param integer $pageID Page ID
	 * @return \Sonic\Resource\Model\Collection
	 */
	
	public function getModuleObjects ($pageID)
	{
		return \Sonic\Model\CMS\Page\Image::_getObjects (array (
			'where' => array (
				array ('page_id', $pageID)
			),
			'orderby'	=> 'order_id ASC'
		));
	}
	
	
	/**
	 * Load an image object
	 * @param integer $pageID Page ID
	 * @param integer $imageID Image ID
	 * @return \Sonic\Model\CMS\Page\Image
	 */
	
	public function getModuleObject ($pageID, $imageID = FALSE)
	{
		if ($imageID)
		{
			return \Sonic\Model\CMS\Page\Image::_read (array (
				'where'	=> array (
					array (\Sonic\Model\CMS\Page\Image::$pk, $imageID),
					array ('page_id', $pageID)
			)));
		}
		else
		{
			$image	= new \Sonic\Model\CMS\Page\Image;
			$image->set ('page_id', $pageID);
			return $image;
		}
		
	}
	
}