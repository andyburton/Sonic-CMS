<?php

/**
 * @author			Andy Burton
 * @email			andy@andyburton.co.uk
 * @link			http://www.andyburton.co.uk
 * @copyright 		Andy Burton
 * @datecreated		25/09/2013
 */

/**
 * Class Properties:
 * @property integer $id
 * @property integer $page_id
 * @property integer $template_id
 * @property integer $order_id
 * @property string $redirect
 * @property string $external_url
 * @property enum $homepage
 * @property string $name
 * @property string $name_menu
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property enum $state_menu
 * @property enum $state_active
 * @property integer $date_updated
 * @property integer $date_created
 */

// Define namespace

namespace Sonic\Model\CMS;

// Start Page Class

class Page extends \Sonic\Model
{
	
	
	/**
	 * Database table
	 * @var string
	 */	
	
	public static $dbTable	= 'cms_page';
	
	/**
	 * Class attributes
	 * @var array
	 */	
	
	protected static $attributes = array (
		'id'			=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_INT,
			'charset'	=> 'int_unsigned',
			'min'		=> 1,
			'max'		=> self::MEDIUMINT_MAX_UNSIGNED,
			'default'	=> 0
		),
		'page_id'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_INT,
			'charset'	=> 'int_unsigned',
			'min'		=> self::MEDIUMINT_MIN_UNSIGNED,
			'max'		=> self::MEDIUMINT_MAX_UNSIGNED,
			'default'	=> NULL,
			'null'		=> TRUE,
			'relation'	=> 'Sonic\Model\CMS\Page'
		),
		'template_id'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_INT,
			'charset'	=> 'int_unsigned',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> self::SMALLINT_MAX_UNSIGNED,
			'default'	=> 1,
			'relation'	=> 'Sonic\Model\CMS\Template'
		),
		'order_id'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_INT,
			'charset'	=> 'int_unsigned',
			'min'		=> self::MEDIUMINT_MIN_UNSIGNED,
			'max'		=> self::MEDIUMINT_MAX_UNSIGNED,
			'default'	=> 0
		),
		'redirect'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 255,
			'default'	=> NULL,
			'null'		=> TRUE
		),
		'external_url'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 1000,
			'default'	=> NULL,
			'null'		=> TRUE
		),
		'homepage'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_ENUM,
			'values'	=> array ('0','1'),
			'default'	=> '0'
		),
		'name'			=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> 1,
			'max'		=> 255,
			'default'	=> ''
		),
		'name_menu'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> 1,
			'max'		=> 255,
			'default'	=> NULL,
			'null'		=> TRUE
		),
		'title'			=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 255,
			'default'	=> NULL,
			'null'		=> TRUE
		),
		'keywords'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> self::SMALLINT_MAX_UNSIGNED,
			'default'	=> NULL,
			'null'		=> TRUE
		),
		'description'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> self::SMALLINT_MAX_UNSIGNED,
			'default'	=> NULL,
			'null'		=> TRUE
		),
		'state_menu'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_ENUM,
			'values'	=> array ('0','1'),
			'default'	=> '1'
		),
		'state_active'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_ENUM,
			'values'	=> array ('0','1'),
			'default'	=> '1'
		),
		'date_updated'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_DATETIME,
			'charset'	=> 'datetime',
			'min'		=> 0,
			'max'		=> 19,
			'default'	=> 'CURRENT_UTC_DATE',
			'deupdate'	=> TRUE
		),
		'date_created'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_DATETIME,
			'charset'	=> 'datetime',
			'min'		=> 0,
			'max'		=> 19,
			'default'	=> 'CURRENT_UTC_DATE',
			'creation'	=> TRUE
		)
	);
	
	
	/**
	 * Return the CMS page object for a URL redirect
	 * @param string $url URL requested
	 * @return \Sonic\Module\CMS\Page
	 */
	
	public static function _getRedirect ($url)
	{
		return static::_Read (array (
			'where'	=> array (
				array ('redirect', $url)
			)
		));
	}
	
	
	/**
	 * Return the CMS homepage page object
	 * @return \Sonic\Module\CMS\Page
	 */
	
	public static function _getHomepage ()
	{
		return self::_Read (array (
			'where'	=> array (
				array ('homepage', 1)
			),
			'limit'	=> 1
		));
	}
	
	
	/**
	 * Return page childdren
	 * @param integer $id Page ID
	 * @param boolean $objects Set objects
	 * @param boolean $recursive Get children recursively
	 * @param boolean $active Only return active children
	 * @return array
	 */

	public static function _getSubPages ($id, $objects = FALSE, $recursive = FALSE, $active = TRUE)
	{

		// If the page ID is null

		if (is_null ($id))
		{
			$page	= new static;
			$page->resetPK (NULL);
		}

		// Else there is a page load it

		else
		{
			
			$page	= static::_Read ($id);

			// If there is no page return blank array

			if (!$page)
			{
				return array ();
			}

		}

		// Set sub page array

		$children	= array ();

		// Get sub page objects

		$childObjs	= $page->getSubPages (FALSE, $active);

		// For each child

		foreach ($childObjs as $obj)
		{

			// Add child to child array

			$children[]	= $objects? $obj : $obj->get ('id');

			// Recursive

			if ($recursive)
			{

				$childChildren	= self::_getSubPages ($obj->get ('id'), $objects, $recursive, $active);

				// If the child has any children

				if ($childChildren)
				{

					// Add to children array

					$children	= array_merge ($children, $childChildren);

				}

			}

		}

		// Return sub pages

		return $children;

	}
	
	
	/**
	 * Create the object
	 * @param array $exclude Attributes not to set
	 * @param \PDO $db Database connection to use, default to master resource
	 * @return boolen
	 */

	public function Create ($exclude = array (), &$db = FALSE)
	{

		// If the parent page isn't null check it exists

		if (!$this->page_id)
		{
			$this->set ('page_id', NULL);
		}
		
		if (!is_null ($this->page_id) && !self::_Exists ($this->page_id))
		{
			new \Sonic\Message ('error', 'Parent page does not exist!');
			return FALSE;
		}

		// If there is no order ID set the next one

		if (!$this->order_id)
		{
			$this->set ('order_id', $this->getNextOrderID ());
		}

		// Call parent method

		$return	= parent::Create ($exclude, $db);
		
		// If the object was not created

		if (!$return)
		{
			return FALSE;
		}

		// If set as homepage make sure its the only one

		if ($this->homepage)
		{
			$this->resetHomepage ();
		}

		// Reindex pages

		$this->reindex ();

		// Return TRUE

		return TRUE;

	}


	/**
	 * Update the object
	 * @param array $exclude Attributes not to set
	 * @param \PDO $db Database connection to use, default to master resource
	 * @return boolean
	 */

	public function Update ($exclude = array (), &$db = FALSE)
	{
		
		// If the parent page isn't null check it exists
		
		if (!$this->page_id)
		{
			$this->set ('page_id', NULL);
		}
		
		if (!is_null ($this->page_id) && !self::_Exists ($this->page_id))
		{
			new \Sonic\Message ('error', 'Parent page does not exist!');
			return FALSE;
		}
		
		// If the parent page is the same as the current page

		if ($this->page_id == $this->id)
		{
			new \Sonic\Message ('error', 'A pages parent cannot be itself!');
			return FALSE;
		}

		// Read child page IDs

		$children	= self::_getSubPages ($this->getPK (), FALSE, TRUE);

		// If the parent ID is in the child array

		if (in_array ($this->page_id, $children))
		{
			new \Sonic\Message ('error', 'A pages parent cannot be one of its children!');
			return FALSE;
		}

		// Call parent method

		$return	= parent::Update ($exclude, $db);
		
		// If the object was not updated

		if (!$return)
		{
			return FALSE;
		}

		// If set as homepage make sure its the only one

		if ($this->homepage)
		{
			$this->resetHomepage ();
		}
		
		// Reindex pages

		$this->reindex ();

		// Return TRUE

		return TRUE;

	}
	
	
	/**
	 * Update a page parent ID and order ID
	 * @param integer $pageID Page ID
	 * @param integer $parentID Parent Page ID
	 * @param integer $orderID Order ID
	 * @return boolean
	 */

	public static function _updateParentAndOrder ($pageID, $parentID, $orderID)
	{
	
		// Get db
		
		$db	=& self::_getDb ();
		
		// Prepare update query

		$query	= $db->prepare ('
			UPDATE ' . static::$dbTable . '
			SET page_id = :parent_id,
			order_id = :order_id
			WHERE id = :page_id
		');

		// Set parent page ID to null if it is 0

		$parentID	= ($parentID == 0)? NULL : (int)$parentID;

		// Bind params

		$query->bindValue (':page_id',		(int)$pageID);
		$query->bindValue (':parent_id',	$parentID);
		$query->bindValue (':order_id',		(int)$orderID);

		// Execute

		try
		{
			$query->execute ();
			return TRUE;
		}

		// Catch PDOException

		catch (\PDOException $e)
		{
			new \Sonic\Message ('error', $e->getMessage ());
			return FALSE;
		}

	}
	
	
	/**
	 * Delete a page
	 * @param array|integer $params Primary key value or parameter array
	 * @param \PDO $db Database connection to use, default to master resource
	 * @return boolean
	 */
	
	public static function _delete ($params = FALSE, &$db = FALSE)
	{
		
		// Create object
		
		$obj	= static::_read ($params);
		
		// Delete
		
		return $obj->delete ();
		
	}
	
	
	/**
	 * Delete the object
	 * @param array|integer $params Primary key value or parameter array
	 * @param \PDO $db Database connection to use, default to master resource
	 * @param boolean $first First time called, used to process transactions
	 * @return boolan
	 */

	public function Delete ($params = FALSE, &$db = FALSE, $first = TRUE)
	{

		// If first time called begin transaction

		if ($first)
		{
			$this->db->beginTransaction ();
		}

		// Remove search
		
		if (!Search::_deletePage ($this->getPK ()))
		{
			
			// Roll back

			if ($first)
			{
				$this->db->rollBack ();
			}

			// Return FALSE

			return FALSE;

		}

		// Get sub pages

		$children	= $this->getSubPages (FALSE, FALSE);

		// Delete each child

		foreach ($children as $obj)
		{

			if (!$obj->Delete (FALSE, FALSE, FALSE))
			{

				if ($first)
				{
					$this->db->rollBack ();
				}

				return FALSE;

			}

		}

		// Remove page modules

		if (!$this->removeModule ())
		{

			if ($first)
			{
				$this->db->rollBack ();
			}

			return FALSE;

		}

		// Call parent method to delete page

		if (!parent::Delete ($params, $db))
		{
			
			if ($first)
			{
				$this->db->rollBack ();
			}

			return FALSE;

		}

		// Commit

		if ($first)
		{
			$this->db->commit ();
		}

		// Return TRUE

		return TRUE;

	}
	
	
	/**
	 * Generate page URL
	 * @param boolean $host Generate URL with host 
	 * @return string
	 */

	public function generateURL ($host = FALSE)
	{

		// Set URL variable

		$url	= $host? URL_ROOT : '/';

		// Set URL to redirect

		if ($this->get ('redirect'))
		{
			
			// Strip first / on redirect
			
			if (strpos ($this->get ('redirect'), '/') === 0)
			{
				$this->set ('redirect', substr ($this->get ('redirect'), 1));
			}
			
			// Encode URL
			
			$url	.= urlencode ($this->get ('redirect'));
			$url	= str_replace ('%2F', '/', $url);
			
		}

		// Set to external URL

		else if ($this->get ('external_url'))
		{
			$url	= $this->get ('external_url');
		}

		// Else if the page is not the homepage
		// Use URL variables

		else if (!$this->get ('homepage'))
		{

			if ($host)
			{
				$url	= URL_ROOT . '?pid=' . $this->get ('id');
			}
			else
			{

				$url	= '/?pid=' . $this->get ('id');

			}

		}

		// Return URL

		return $url;

	}
	
	
	/**
	 * Generate top menu for the page
	 * @param array $select Which menu items to keep and/or remove
	 *   Set 'valid' and 'invalid' array items with CMS module names
	 * @param boolean $menuOrder Order of menu items
	 * @return string
	 */

	public function generateTopMenu ($select = array (), $menuOrder = FALSE)
	{
		return self::_generateMenu (NULL, $this->getPK (), FALSE, FALSE, $select, $menuOrder);
	}


	/**
	 * Generate sub menu for the page
	 * @param array $select Which menu items to keep and/or remove
	 *   Set 'valid' and 'invalid' array items with CMS module names
	 * @param boolean $menuOrder Order of menu items
	 * @return string
	 */

	public function generateSubMenu ($select = array (), $menuOrder = FALSE)
	{
		return self::_generateMenu ($this->getPK (), $this->getPK (), FALSE, FALSE, $select, $menuOrder);
	}


	/**
	 * Generate parent menu for the page
	 * @param array $select Which menu items to keep and/or remove
	 *   Set 'valid' and 'invalid' array items with CMS module names
	 * @param boolean $menuOrder Order of menu items
	 * @return string
	 */

	public function generateParentMenu ($select = array (), $menuOrder = FALSE)
	{
		return self::_generateMenu ($this->page_id, $this->getPK(), FALSE, FALSE, $select, $menuOrder);
	}


	/**
	 * Generate a page menu, listing all sub-pages
	 * @param integer $page Page object or ID (root is NULL)
	 * @param array|integer $parents Selected page parents or selected page ID
	 * @param boolean $recursive Generate sub page menu
	 * @param boolean $sub Generate selected page sub menu
	 * @param array $select Which menu items to keep and/or remove
	 *   Set 'valid' and 'invalid' array items with CMS module names
	 * @param boolean $menuOrder Order of menu items
	 * @return string
	 */

	public static function _generateMenu ($page, $parents = 0, $recursive = FALSE, $sub = TRUE, $select = array (), $menuOrder = FALSE)
	{
		
		// If the page is not a page object
		// Create page object and set ID
		
		if (!($page instanceof self))
		{
			$pageID	= $page;
			$page	= new static;
			$page->resetPK ($pageID);
		}

		// Get selected page parents
		
		if (!is_array ($parents))
		{
			
			$originalParent	= $parents;
			$parents		= self::_getParentPages ($originalParent);
			
			if (!in_array ($originalParent, $parents))
			{
				$parents[]	= $originalParent;
			}
			
		}
		
		// Get sub pages

		$subpages	= $page->getSubPages ($menuOrder);

		// Generate menu
		
		$menu	= NULL;
		
		foreach ($subpages as $child)
		{

			// If page menu state is active

			if ($child->get ('state_menu'))
			{

				// If there are selected module statuses

				if ($select)
				{

					// If there are valid module statuses

					if (isset ($select['valid']))
					{

						// For each module

						foreach ($select['valid'] as $module)
						{

							// If the page does not have the module enabled

							if (!$child->hasModule ($module))
							{

								// Next item

								continue 2;
								
							}

						}

					}

					// If there are invalid module statuses

					if (isset ($select['invalid']))
					{

						// For each module

						foreach ($select['invalid'] as $module)
						{

							// If the page has the module enabled

							if ($child->hasModule ($module))
							{

								// Next item

								continue 2;

							}

						}

					}

				}

				// Set selected status

				$selected	= ($selectedID == $child->getPK () || in_array ($child->getPK (), $parents));

				// Add to menu

				$menu	.= '<li' . ($selected? ' class="selected"' : NULL) . '><a href="' . $child->generateURL () . '">' . $child->get ('name_menu') . '</a>';

				// If recursive

				if ($recursive || ($sub && $selected))
				{

					// Generate child menus

					$menu	.= self::_generateMenu ($child, $parents, $recursive, $sub, $select, $menuOrder);

				}

				// Finish child

				$menu	.= '</li>';

			}

		}
		
		// Return menu

		return $menu;

	}
	
	
	/**
	 * Return page content
	 * @param boolean $combine Combine content and return a string
	 *   instead of returning CMS\Page\Content objects.
	 *   Default to TRUE
	 * @return array|boolean
	 */

	public function getContent ($combine = TRUE)
	{

		// Get page content
		
		$content	= $this->getChildren ('Sonic\Model\CMS\Page\Content');
		
		// If we're combining results

		if ($combine)
		{

			// Set return

			$return	= NULL;

			// Append content

			foreach ($content as $obj)
			{
				$return	.= $obj->get ('content');
			}

			return $return;

		}

		// Else just return object array

		else
		{
			
			// If no content add a blank object
			
			if (!count ($content))
			{
				$obj	= new Page\Content;
				$obj->set ('page_id',	$this->getPK ());
				$content[]	= $obj;
			}
			
			return $content;
			
		}

	}
	
	
	/**
	 * Return pages for select options
	 * @param integer $parentID Parent ID
	 * @param boolean $recursive Get children children
	 * @param string $pre Prepend String 
	 * @return array
	 */
	
	public static function _selectOptions ($parentID = NULL, $recursive = TRUE, $pre = NULL)
	{
		
		// Set options variable
		
		$options	= array ();
		
		// Get children
		
		$children	= self::_getSubPages ($parentID, TRUE, FALSE, FALSE);
		
		// Foreach child
		
		foreach ($children as $page)
		{
			
			// Add to options
			
			$options[$page->get ('id')]	= $pre . ' ' . $page->get ('name');
			
			// If recursive
			
			if ($recursive)
			{
				
				// Generate child options
				
				$options	+= self::_selectOptions ($page->get ('id'), TRUE, $pre . '>');
				
			}
			
		}
		
		// Return options
		
		return $options;
		
	}
	
	
	/**
	 * Return array of page children objects
	 * @param string $order Order By
	 * @param boolean $active Page children must be active
	 * @return array
	 */

	public function getSubPages ($order = FALSE, $active = TRUE)
	{

		// Set parameters
		
		$params	= array ();

		if (is_null ($this->getPK ()))
		{
			$params['where'][]	= array ('page_id', 'NULL', 'IS');
		}
		else
		{
			$params['where'][]	= array ('page_id', $this->getPK ());
		}

		if ($active)
		{
			$params['where'][]	= array ('state_active', '1');
		}

		$params['orderby']	= $order? $order : 'order_id ASC';
		$params['orderby']	.= ', name_menu ASC';

		// Return objects

		return static::_getObjects ($params);

	}
	
	
	/*
	 * Count the number of sub pages
	 * @param array $params Query where parameters
	 * @return integer
	 */
	
	public function countSubPages ($params = array ())
	{
		return self::_countSubPages ($this->getPK (), $params);
	}
	
	
	/**
	 * Count the number of sub pages for a page
	 * @param integer id Page ID
	 * @param array $params Query parameters
	 * @return integer
	 */

	public static function _countSubPages ($id, $params = array ())
	{
		return self::_Count (array_merge_recursive (
			array (
				'where'	=> array (
						array ('page_id', $id)
					)
			), $params
		));
	}
	
	
	/**
	 * Return array of all the pages parents
	 * @param boolean $objects Whether to return page objects or IDs
	 * @return array
	 */
	
	public function getParentPages ($objects = FALSE)
	{
		return self::_getParentPages ($this, $objects);
	}
	
	
	/**
	 * Return page parents
	 * @param integer|Page $page Page ID or object
	 * @param boolean $objects Return objects
	 * @return array
	 */

	public static function _getParentPages ($page, $objects = FALSE)
	{

		// If there is no page

		if (!$page)
		{
			return array ();
		}

		// If the page is not a page object
		
		if (!($page instanceof self))
		{
			
			// Read the page

			$page	= static::_Read ($page);

			if (!$page)
			{
				return array ();
			}
			
		}
			
		// Get page parent

		$parent	= $page->getParent ();

		// If there is no parent

		if (!$parent || is_null ($parent->getPK ()))
		{
			return array ();
		}

		// Add parent to parent array

		$parents		= $objects? array ($parent) : array ($parent->get ('id'));

		// Call recursively

		$parentParents	= self::_getParentPages ($parent, $objects);

		// If the parent has any parents add them to the parents array

		if ($parentParents)
		{
			$parents	= array_merge ($parents, $parentParents);
		}

		// Return parents

		return $parents;

	}
	
	
	/**
	 * Return page parent
	 * @return object|boolean
	 */

	public function getParent ()
	{

		if (!$this->page_id)
		{
			$page	= new static;
			$page->resetPK (NULL);
			return $page;
		}

		return static::_Read ($this->get ('page_id'));

	}
	
	
	/**
	 * Return the next order ID
	 * @return integer
	 */

	public function getNextOrderID ()
	{

		// Set params

		$params	= array (
			'select'	=> 'order_id',
			'where'		=> array (
				array ('page_id', $this->page_id)
			),
			'orderby'	=> 'order_id DESC'
		);

		// Get order ID

		$orderID	= $this->getValue ($params);
		
		// Return next ID

		return (int)$orderID + 1;

	}
	
	
	/**
	 * Return page module objects
	 * @param integer $moduleID Module ID
	 * @return array
	 */

	public function getModules ($moduleID = FALSE)
	{
		
		$params	= array ();
		
		if ($moduleID !== FALSE)
		{
			$params['where'][]	= array ('module_id', $moduleID);
		}

		return $this->getChildren ('Sonic\Model\CMS\Page\Module', FALSE, FALSE, FALSE, $params);

	}

	
	/**
	 * Return page module object
	 * @param integer $moduleID Module ID
	 * @return object|boolean
	 */

	public function getModule ($moduleID)
	{
		return Page\Module::_Read (array (
			'where'	=> array (
				array ('page_id',	$this->id),
				array ('module_id',	$moduleID)
			)
		));
	}
	
	
	/**
	 * Return the module object for a CMS module 
	 * @param integer|string $moduleID Module ID or name
	 * @param boolean $check Whether to check the page has the module, default true
	 * @return \Sonic\CMS\Module|boolean
	 */

	public function getModuleObject ($moduleID, $check = TRUE)
	{

		// Check the page has the module
		
		if ($check && !$this->hasModule ($moduleID))
		{
			return FALSE;
		}
		
		// Load module object
		
		$module	= Module::_loadObject ($moduleID);
		
		// If the module isnt valid

		if (!($module instanceof \Sonic\CMS\Module))
		{
			return FALSE;
		}
		
		// Return module
		
		return $module;

	}
	
	
	/**
	 * Return pages with the specified module
	 * @param integer $moduleID Module ID
	 * @param integer $parentID Parent Page ID, Optional
	 * @param array $params Additional params for query
	 * @return \Sonic\Resource\Model\Collection
	 */
	
	public static function _getWithModule ($moduleID, $parentID = FALSE, $params = array ())
	{
		
		// If the module ID is not numeric
		// Get ID from name

		if (!is_numeric ($moduleID))
		{
			$moduleID	= Module::_IDFromName ($moduleID);
		}
		
		if (!is_array ($params))
		{
			$params	= array ();
		}
		
		if (!isset ($params['orderby']))
		{
			$params['orderby']	= 'page.order_id ASC';
		}
		
		$params	= array_merge_recursive (array (
			'select'	=> 'page.*',
			'from'		=> static::$dbTable . ' as page, ' . Page\Module::$dbTable . ' as module',
			'where'		=> array (
				'module.page_id = page.id',
				array ('module.module_id', $moduleID)
			)
		), $params);
		
		if ($parentID !== FALSE)
		{
			$params['where'][]	= array ('page.page_id', $parentID);
		}
		
		return static::_getObjects ($params);
		
	}


	/**
	 * Checks to see if a page has a module
	 * @param mixed $moduleID Module ID or Name
	 * @return boolean
	 */

	public function hasModule ($moduleID)
	{
		return self::_hasModule ($this->id, $moduleID);
	}


	/**
	 * Checks to see if a page has a module
	 * @param integer $pageID Page ID
	 * @param integer $moduleID Module ID or Name
	 * @return boolean
	 */

	public static function _hasModule ($pageID, $moduleID)
	{
		
		// If the module ID is not numeric
		// Get ID from name

		if (!is_numeric ($moduleID))
		{
			$moduleID	= Module::_IDFromName ($moduleID);
		}
		
		// Set params
		
		return Page\Module::_exists (array (
			'where'	=> array (
				array ('page_id',	$pageID),
				array ('module_id',	$moduleID)
			)
		));

	}


	/**
	 * Add or edit a module for the page
	 * @param integer $moduleID Module ID
	 * @param array $data Module data
	 * @return boolean
	 */

	public function addModule ($moduleID, $data = array ())
	{
		
		// If the module ID is not numeric
		// Get ID from name

		if (!is_numeric ($moduleID))
		{
			$moduleID	= Module::_IDFromName ($moduleID);
		}
		
		// If the page doesnt already have the module

		if (!$this->hasModule ($moduleID))
		{
			
			// Create page module object

			$pageModule	= new Page\Module;

			// Set details

			$pageModule->set ('page_id',	$this->id);
			$pageModule->set ('module_id',	$moduleID);

			// Create

			if (!$pageModule->Create ())
			{
				return FALSE;
			}
			
			// Load module object
			
			$module	= Module::_loadObject ($moduleID);
			
			if (!$module)
			{
				return TRUE;
			}
			
			// Edit module
			
			if (!($return = $module->Add ($this, $data)))
			{
				return FALSE;
			}
			
		}
		
		// Update module data
		
		else
		{
			
			// Load module object
			
			$module	= Module::_loadObject ($moduleID);
			
			if (!$module)
			{
				return TRUE;
			}
			
			// Edit module
			
			if (!($return = $module->Edit ($this, $data)))
			{
				return FALSE;
			}
			
		}

		// Return

		return $return;

	}

	
	/**
	 * Load a page module object
	 * @param integer|string $moduleID Module ID or name
	 * @return object|boolean
	 */

	public function loadModule ($moduleID)
	{
		
		// If the module isnt valid

		if (!($module = $this->getModuleObject ($moduleID)))
		{
			return FALSE;
		}
		
		// Load the module

		return $module->getModuleObject ($this->getPK ());

	}
	
	
	/**
	 * Load a page module objects
	 * @param integer|string $moduleID Module ID or name
	 * @return object|boolean
	 */

	public function loadModuleObjects ($moduleID)
	{
		
		// If the module isnt valid

		if (!($module = $this->getModuleObject ($moduleID)))
		{
			return FALSE;
		}
		
		// Load the module objects

		return $module->getModuleObjects ($this->getPK ());

	}


	/**
	 * Remove a module from a page
	 * @param integer $moduleID Module ID
	 * @return boolean
	 */

	public function removeModule ($moduleID = FALSE)
	{

		// Get page module objects

		$modules	= $this->getModules ($moduleID);

		// If there are no modules

		if (!$modules)
		{
			return TRUE;
		}

		// Foreach module

		foreach ($modules as $pageModule)
		{

			// Begin Transaction

			$this->db->beginTransaction ();

			// Delete page module

			if (!$pageModule->Delete ())
			{
				$this->db->rollBack ();
				return FALSE;
			}

			// Load module object

			$module	= Module::_loadObject ($moduleID);

			// If there is a module object

			if ($module instanceof \Sonic\CMS\Module)
			{

				// Remove the module, running any module-specific clean up

				if (!$module->Remove ($this->getPK ()))
				{
					$this->db->rollBack ();
					return FALSE;
				}

			}

			// Commit

			$this->db->commit ();

		}

		// Return TRUE

		return TRUE;

	}
	
	
	/**
	 * Make sure no other page is a homepage
	 * @return boolean
	 */

	public function resetHomepage ()
	{

		// Prepare query

		$query	= $this->db->prepare ("
			UPDATE " . static::$dbTable . "
			SET homepage = '0'
			WHERE id <> :id
		");

		// Assign variables

		$query->bindValue (':id', $this->id);

		// Try and execute

		try
		{
			$query->execute ();
			return TRUE;
		}

		// Catch PDOException

		catch (\PDOException $e)
		{
			new \Sonic\Message ('error', $e->getMessage ());
			return FALSE;
		}

	}
	

	/**
	 * Reindex the page order ids
	 * @return void
	 */

	public function reindex ()
	{

		// Set parameters

		if (is_null ($this->page_id))
		{
			$params['where'][]	= array ('page_id',	'NULL',	'IS');
		}
		else
		{
			$params['where'][]	= array ('page_id',	$this->page_id);
		}

		$params['orderby'] = 'order_id ASC, date_updated DESC';

		// Get sibling pages

		$pages	= static::_getObjects ($params);
		
		// Only continue if there are pages

		if (!$pages)
		{
			return;
		}

		// Prepare update query

		$query	= $this->db->prepare ('
			UPDATE ' . static::$dbTable . '
			SET order_id = :order_id
			WHERE ' . static::$pk . ' = :page_id
		');

		// Reindex each page

		foreach ($pages as $key => $page)
		{

			// Bind params

			$query->bindValue (':order_id',	$key + 1);
			$query->bindValue (':page_id',	$page->getPK ());

			// Execute query

			try
			{
				$query->execute ();
			}

			// Catch PDOException

			catch (PDOException $e)
			{
				new \Sonic\Message ('error', $e->getMessage ());
			}

		}

	}
	
	
	/**
	 * Return the last modified date of the page for sitemap
	 * @return date
	 */
	
	public function lastMod ()
	{
		return substr ($this->get ('date_updated'), 0, 10);
	}
	
	
	/**
	 * Get pages matching a search for admin parent pages
	 * @param string $search Search query
	 * @param integer $start Starting number for pagination, default 0
	 * @param integer $count Number of results, default 10
	 * @return array
	 */

	public static function _searchParents ($search, $start = 0, $count = 10)
	{
		$pages	= static::_getObjects (array (
			'where'		=> array (
				array ('name', "%$search%", 'LIKE'),
			),
			'orderby'	=> 'name ASC',
			'limit'		=> array ($start, $count)
		));
		
		$parentCache	= array ();
		$results		= array ();
		
		foreach ($pages as $page)
		{
			
			if (!isset ($parentCache[$page->page_id]))
			{
				$parentCache[$page->page_id] = $page->getParent ()->name;
			}
			
			$results[]	= array (
				'id'		=> $page->getPK (),
				'value'		=> $page->name,
				'parent'	=> $parentCache[$page->page_id]
			);
		}
		
		return $results;
		
	}
	
	
}

// End Page Class
