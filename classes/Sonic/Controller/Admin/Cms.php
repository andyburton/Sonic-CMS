<?php

// Define namespace

namespace Sonic\Controller\Admin;

// Start CMS Class

class CMS extends \Sonic\Controller\Session
{
	
	
	/**
	 * Display index page
	 */
	
	public function index ()
	{
	}
	
	
	/**
	 * Add cms page
	 * @param string $page_add (Optional) Whether to add a page
	 */
	
	public function add ()
	{
		
		$page			= new \Sonic\Model\CMS\Page;
		$parent			= FALSE;
		$page_content	= array ();
		$page_modules	= array ();
		
		$this->view->assign ('modules',				$this->getModules ());
		$this->view->assign ('templates',			$this->getTemplates (FALSE));
		
		$this->view->assignByRef ('page',			$page);
		$this->view->assignByRef ('page_parent',	$parent);
		$this->view->assignByRef ('page_modules',	$page_modules);
		$this->view->assignByRef ('page_content',	$page_content);
		
		if ($this->getURLArg ('parent_id'))
		{
			$page->set ('page_id', $this->getURLArg ('parent_id'));
		}
		
		$parent	= $page->getParent ();
		
		if ($this->getArg ('page_add'))
		{
			
			// Page data
			
			$page->fromPost ();
			
			$parent	= $page->getParent ();
			
			if (\Sonic\Message::count ('error'))
			{
				return FALSE;
			}
			
			// Create
			
			$page->db->beginTransaction ();
			
			if (!$page->create ())
			{
				new \Sonic\Message ('error', 'Unable to add page');
				$page->db->rollBack ();
				return;
			}
			
			// Page content
			
			if ($this->getArg ('cms_page_content'))
			{
				foreach ($this->getArg ('cms_page_content') as $content_id => $content_data)
				{
					
					$obj = new \Sonic\Model\CMS\Page\Content;
					
					try
					{
						$obj->set ('page_id',	$page->getPK ());
						$obj->set ('content',	$content_data);
					}
					catch (\Sonic\Resource\Parser\Exception $e)
					{
						echo $e->getMessage () . ' on line ' . $e->getLine ();
						\Sonic\Model::pre (debug_backtrace (FALSE));
						exit;
					}
					
					$page_content[]	= $obj;
					
				}
			}
			
			// Page modules
			
			$module_data		= array ();
			
			if ($this->getArg ('cms_module'))
			{
				foreach ($this->getArg ('cms_module') as $module_id => $data)
				{
					
					$obj = new \Sonic\Model\CMS\Page\Module;
					
					$obj->set ('module_id',	$module_id);
					$obj->set ('page_id',	$page->getPK ());
					
					$page_modules[$module_id]	= $obj;
					$module_data[$module_id]	= $data;
				}
			}
			
			// Check for errors
			
			if (\Sonic\Message::count ('error'))
			{
				return;
			}
			
			// Content
			
			foreach ($page_content as $key => $obj)
			{
				if (!$obj->create ())
				{
					new \Sonic\Message ('error', 'Unable to add content');
					$page->db->rollBack ();
					return;
				}
			}
			
			// Modules
			
			foreach ($page_modules as $obj)
			{
				if (!$page->addModule ($obj->get ('module_id'), $module_data[$obj->get ('module_id')]))
				{
					new \Sonic\Message ('error', 'Unable to add page module');
					$page->db->rollBack ();
					return;
				}
			}
			
			// Search
			
			if (!\Sonic\Model\CMS\Search::_setPageData ($page))
			{
				new \Sonic\Message ('error', 'Unable to add search data');
				$page->db->rollBack ();
				return;
			}
			
			// Commit
			
			$page->db->commit ();
			new \Sonic\Resource\Redirect ('/admin/cms', array ('message' => 'Page Added!'));

		}
		
	}
	
	
	/**
	 * Edit cms page
	 * @param integer $id Page ID
	 * @param string $page_edit (Optional) Whether to edit a page
	 */
	
	public function edit ()
	{
		
		$id	= $this->getArg ('id');
		
		if (!\Sonic\Model\CMS\Page::_IDexists ($id))
		{
			new \Sonic\Resource\Redirect ('index', array (
				'error'	=> 'Invalid Page'
			));
		}
		
		$page	= \Sonic\Model\CMS\Page::_read ($id);
		
		$parent	= $page->getParent ();
		$page_content	= $page->getContent (FALSE);
		$page_modules	= $page->getModules ();
		
		$this->view->assign ('modules',				$this->getModules ());
		$this->view->assign ('templates',			$this->getTemplates (FALSE));
		
		$this->view->assignByRef ('page',			$page);
		$this->view->assignByRef ('page_parent',	$parent);
		$this->view->assignByRef ('page_modules',	$page_modules);
		$this->view->assignByRef ('page_content',	$page_content);
		
		if ($this->getArg ('page_edit'))
		{
			
			// Page data
			
			$page->fromPost ();
			$parent	= $page->getParent ();
			
			if (\Sonic\Message::count ('error'))
			{
				return FALSE;
			}
			
			// Page content
			
			$new_page_content	= array ();
			
			if ($this->getArg ('cms_page_content'))
			{
				foreach ($this->getArg ('cms_page_content') as $content_id => $content_data)
				{
					
					$obj = new \Sonic\Model\CMS\Page\Content;
					
					if ($content_id)
					{
						$obj->set ('id',	$content_id);
					}
					
					$obj->set ('page_id',	$page->getPK ());
					$obj->set ('content',	$content_data);
					
					$new_page_content[$content_id]	= $obj;
					
				}
			}
			
			$page_content	= $page_content->getArrayCopy ();
			
			foreach ($page_content as $key => $content)
			{
				
				if (!$content->getPK () || 
					isset ($new_page_content[$content->getPK ()]))
				{
					unset ($page_content[$key]);
				}
				
			}
			
			$delete_content	= $page_content;
			$page_content	= $new_page_content;
			unset ($new_page_content);
			
			// Page modules
			
			$new_page_modules	= array ();
			$module_data		= array ();
			
			if ($this->getArg ('cms_module'))
			{
				foreach ($this->getArg ('cms_module') as $module_id => $data)
				{
					
					$obj = new \Sonic\Model\CMS\Page\Module;
					
					$obj->set ('module_id',	$module_id);
					$obj->set ('page_id',	$page->getPK ());
					
					$new_page_modules[$module_id]	= $obj;
					$module_data[$module_id]		= $data;
				}
			}
			
			$page_modules	= $page_modules->getArrayCopy ();
			
			foreach ($page_modules as $key => $module)
			{
				if (isset ($new_page_modules[$module->get ('module_id')]))
				{
					unset ($page_modules[$key]);
				}
			}
			
			$delete_modules	= $page_modules;
			$page_modules	= $new_page_modules;
			unset ($new_page_modules);
			
			// Check for errors
			
			if (\Sonic\Message::count ('error'))
			{
				return;
			}
			
			// Update
			
			$page->db->beginTransaction ();
			
			if (!$page->update ())
			{
				new \Sonic\Message ('error', 'Unable to update page');
				$page->db->rollBack ();
				return;
			}
			
			// Content
			
			foreach ($page_content as $key => $obj)
			{
				
				if (!$key)
				{
					if (!$obj->create ())
					{
						new \Sonic\Message ('error', 'Unable to create content');
						$page->db->rollBack ();
						return;
					}
				}
				else
				{
					if (!$obj->update ())
					{
						new \Sonic\Message ('error', 'Unable to update content');
						$page->db->rollBack ();
						return;
					}
				}
				
			}
			
			foreach ($delete_content as $key => $obj)
			{
				if (!$obj->delete ())
				{
					new \Sonic\Message ('error', 'Unable to delete content');
					$page->db->rollBack ();
					return;
				}
			}
			
			// Modules
			
			foreach ($page_modules as $obj)
			{
				if (!$page->addModule ($obj->get ('module_id'), $module_data[$obj->get ('module_id')]))
				{
					new \Sonic\Message ('error', 'Unable to update page module');
					$page->db->rollBack ();
					return;
				}
			}
			
			foreach ($delete_modules as $obj)
			{
				if (!$page->removeModule ($obj->get ('module_id')))
				{
					new \Sonic\Message ('error', 'Unable to delete page module');
					$page->db->rollBack ();
					return;
				}
			}
			
			// Search
			
			if (!\Sonic\Model\CMS\Search::_setPageData ($page))
			{
				new \Sonic\Message ('error', 'Unable to update search data');
				$page->db->rollBack ();
				return;
			}
			
			// Commit
			
			$page->db->commit ();
			new \Sonic\Message ('success', 'Page Updated');

		}
		
	}
	
	
	/**
	 * Return array of CMS templates
	 * @param boolean $blnObjs Whether to return objects or array
	 * @return array
	 */
	
	private function getTemplates ($blnObjs = TRUE)
	{
		
		$objs	= \Sonic\Model\CMS\Template::_getObjects (array ('orderby' => 'id ASC'));
		
		if ($blnObjs)
		{
			return $objs;
		}
		
		$arr	= array ();
		
		foreach ($objs as $obj)
		{
			$arr[$obj->id] = $obj->name;
		}
		
		return $arr;
		
	}
	
	
	/**
	 * Return array of CMS modules
	 * @param boolean $blnObjs Whether to return objects or array
	 * @return array
	 */
	
	private function getModules ($blnObjs = TRUE)
	{
		
		$objs	= \Sonic\Model\CMS\Module::_getObjects (array ('orderby' => 'name'));
		
		if ($blnObjs)
		{
			return $objs;
		}
		
		$arr	= array ();
		
		foreach ($objs as $obj)
		{
			$arr[$obj->id] = $obj->name;
		}
		
		return $arr;
		
	}
	
	
}