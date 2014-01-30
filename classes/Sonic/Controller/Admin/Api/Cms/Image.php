<?php

// Define namespace

namespace Sonic\Controller\Admin\Api\CMS;

// Start Image Class

class Image extends \Sonic\Controller\JSON\Session
{
	
	
	/**
	 * Load module admin interface
	 */
	
	public function load ()
	{
		
		$module	= \Sonic\Model\CMS\Module::_loadObject ('Images');
		
		if (!($module instanceof \Sonic\CMS\Module))
		{
			return $this->Error ('Invalid module');
		}
		
		return $this->Success (array (
			'template'	=> $module->Load ($this->getArg ('page_id'))
		));
		
	}
	
	
	/**
	 * Add a new image
	 */
	
	public function add ()
	{
		
		if (!($page = $this->getPageObject ()))
		{
			return FALSE;
		}
		
		if (!isset ($_FILES['imagefile']))
		{
			return $this->Error ('No image file uploaded');
		}
		
		if (!($image = $page->addModule ('Images', array (
			'file'	=> $_FILES['imagefile']
		))))
		{
			return $this->Error (\Sonic\Message::getString ('error'));
		}
		
		return $this->success (array ('obj' => $image->exportJSON()));
		
	}
	
	
	/**
	 * Update image details
	 */
	
	public function update ()
	{
		
		if (!($image = $this->getImageObject ()))
		{
			return FALSE;
		}
		
		$image->set ('title',		$this->getArg ('image_title'));
		$image->set ('description',	$this->getArg ('image_description'));
		$image->set ('order_id',	$this->getArg ('order_id'));
		
		if (!$image->update ())
		{
			return $this->Error ('Unable to update image');
		}
		
		return $this->Success ();
		
	}
	
	
	/**
	 * Remove an image
	 */
	
	public function remove ()
	{
		
		if (!($image = $this->getImageObject ()))
		{
			return FALSE;
		}
		
		if (!$image->delete ())
		{
			return $this->Error ('Unable to remove image');
		}
		
		return $this->Success ();
		
	}
	
	
	/**
	 * Update image order
	 */
	
	public function update_order ()
	{
		
		if (!$this->getArg ('images'))
		{
			return $this->Error ('No images specified');
		}
		
		if (!($page = $this->getPageObject ()))
		{
			return FALSE;
		}
		
		if (!($module = $this->getModuleObject ($page)))
		{
			return FALSE;
		}
		
		// Update image order IDs
		
		foreach ($this->getArg ('images') as $image)
		{
			
			$imgObj	= $module->getModuleObject ($page->getPK (), $image['image_id']);
			
			if (!($imgObj instanceof \Sonic\Model\CMS\Page\Image) || !$imgObj->getPK ())
			{
				continue;
			}
			
			if (!$imgObj->updateAttribute ('order_id', (int)$image['order_id']))
			{
				continue;
			}
			
		}
		
		return $this->Success ();
		
	}
	
	
	/**
	 * Load the CMS module object for a page
	 * @return \Sonic\CMS\Module
	 */
	
	private function getModuleObject ($page)
	{
		
		$module	= $page->getModuleObject ('Images');
		
		if (!($module instanceof \Sonic\CMS\Module))
		{
			return $this->Error ('Invalid module');
		}
		
		return $module;
		
	}
	
	
	/**
	 * Load the CMS page object from a page_id argument
	 * @return \Sonic\Model\CMS\Page
	 */
	
	private function getPageObject ()
	{
		
		$page	= \Sonic\Model\CMS\Page::_Read ($this->getArg ('page_id'));
		
		if (!($page instanceof \Sonic\Model\CMS\Page))
		{
			return $this->Error ('Invalid page');
		}
		
		return $page;
		
	}
	
	
	/**
	 * Return a page image object
	 * @return \Sonic\Model\CMS\Page\Image|boolean
	 */
	
	private function getImageObject ()
	{
		
		if (!$this->getArg ('cms_image_id'))
		{
			return $this->Error ('No image specified');
		}
		
		if (!($page = $this->getPageObject ()))
		{
			return FALSE;
		}
		
		if (!($module = $this->getModuleObject ($page)))
		{
			return FALSE;
		}
		
		$image = $module->getModuleObject ($page->getPK (), $this->getArg ('cms_image_id'));
		
		if (!($image instanceof \Sonic\Model\CMS\Page\Image) || !$image->getPK ())
		{
			return $this->Error ('Unable to find image');
		}
		
		return $image;
		
	}
	
	
}