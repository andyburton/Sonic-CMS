<?php

// Define namespace

namespace Sonic\Controller\Admin\Api;

// Start CMS Class

class CMS extends \Sonic\Controller\JSON\Session
{
	
	
	/**
	 * Return pages
	 * @param boolean $recursive (Options) Load pages recursively
	 * @param integer $id (Optional) Page ID
	 */
	
	public function index ()
	{
		
		$recursive	= $this->getArg ('recursive') == 'true';
		$id			= $this->getArg ('id');
		$search		= $this->getArg ('search');
		
		if (!ctype_digit ($id))
		{
			$id	= NULL;
		}
		elseif (!\Sonic\Model\CMS\Page::_IDexists ($id))
		{
			return $this->error ('Invalid Page');
		}
		
		if ($search)
		{
			$this->success (array (
				'list' => \Sonic\Model\CMS\Page::_getObjects (array (
					'where'		=> array (
						array ('name', "%$search%", 'LIKE')
					),
					'orderby'	=> 'name ASC'
				))->toArray (array ('id', 'page_id', 'name'), array (
					'child_count' => array ('$this', 'countSubPages')
				), $recursive)
			));
		}
		else
		{
			$this->success (array (
				'list' => \Sonic\Model\CMS\Page::_getChildren ('Sonic\\Model\\CMS\\Page', $id, $recursive, FALSE, array (
					'orderby'	=> 'name ASC'
				))->toArray (array ('id', 'page_id', 'name'), array (
					'child_count' => array ('$this', 'countSubPages')
				), $recursive)
			));
		}
		
	}
	
	
	/**
	 * Delete page
	 * @return integer $id Page ID
	 */
	
	public function delete ()
	{
		
		$id	= $this->getArg ('id');
		
		if (!ctype_digit ($id) || !\Sonic\Model\CMS\Page::_IDexists ($id))
		{
			return $this->error ('Invalid Page');
		}
		
		if (!\Sonic\Model\CMS\Page::_delete ($id))
		{
			return $this->error ('Unable to delete page');
		}
		else
		{
			return $this->success ();
		}
		
	}
	
	
	/**
	 * Regenerate the CMS search index
	 * @return boolean
	 */
	
	public function reindex_search ()
	{
		
		// Clear search index
		
		$db = \Sonic\Model\CMS\Search::_getDbMaster ();
		$db->beginTransaction ();
		
		try
		{
			$query	= $db->query ("TRUNCATE TABLE " . \Sonic\Model\CMS\Search::$dbTable);
		}
		catch (\PDOException $e)
		{
			$db->rollBack ();
			return $this->error ('Unable to clear the search index');
		}
		
		// Load pages
		
		$pages	= \Sonic\Model\CMS\Page::_getObjects ();
		$count	= 0;
		
		foreach ($pages as $page)
		{
			if (!\Sonic\Model\CMS\Search::_setPageData ($page))
			{
				$db->rollBack ();
				return $this->error ('Unable to add page ' . $page->name . ' to the index. Please try again.');
			}
			$count++;
		}
		
		$db->commit ();
		
		return $this->success (array (
			'pages_indexed' => $count
		));
		
	}
	
	
	/**
	 * Search for parent pages
	 * @return boolean
	 */
	
	public function search_parent ()
	{
		
		$search	= $this->getArg ('term');
		
		if (strlen ($search) <= 2)
		{
			return $this->error ('Search term must be more than 2 characters');
		}
		
		return $this->success (array (
			'results'	=> \Sonic\Model\CMS\Page::_searchParents ($search, 0, 20)
		));
		
	}
	
	
	/**
	 * Search for cms pages
	 * @return boolean
	 */
	
	public function search ()
	{
		
		$search	= $this->getArg ('term');
		
		if (strlen ($search) <= 2)
		{
			return $this->error ('Search term must be more than 2 characters');
		}
		
		$params	= array (
			'orderby'	=> 'name ASC',
			'limit'		=> array (0, 10)
		);
		
		if ($search)
		{
			$params['where'][]	= array ('name', "%$search%", 'LIKE');
		}
		
		$pages			= \Sonic\Model\CMS\Page::_getObjects ($params);
		$results		= array ();
		
		foreach ($pages as $page)
		{
			$results[]	= array (
				'id'		=> $page->getPK (),
				'value'		=> $page->name
			);
		}
		
		return $this->success (array (
			'results'	=> $results
		));
		
	}
	
	
}