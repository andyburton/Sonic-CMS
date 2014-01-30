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
 * @property string $name
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property enum $state
 */

// Define namespace

namespace Sonic\Model\CMS;

// Start Search Class

class Search extends \Sonic\Model
{
	
	
	/**
	 * Database table
	 * @var string
	 */	
	
	public static $dbTable	= 'cms_search';
	
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
			'default'	=> 0
		),
		'name'			=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
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
		'content'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'none',
			'min'		=> self::MEDIUMINT_MIN_UNSIGNED,
			'max'		=> self::MEDIUMINT_MAX_UNSIGNED,
			'default'	=> NULL,
			'null'		=> TRUE
		),
		'state'			=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_ENUM,
			'values'	=> array ('0','1'),
			'default'	=> ''
		)
	);
	
	
	/**
	 * Set search data for a page
	 * @param \Sonic\Model\CMS\Page $page Page object
	 * @return object|boolean
	 */

	public static function _setPageData ($page)
	{
		
		// Check page object is valid
		
		if (!($page instanceof Page))
		{
			return FALSE;
		}
		
		// Read existing page search entry
		
		$search	= self::_getPageObject ($page->getPK ());

		// Create a new search entry if one isn't valid
		
		if (!($search instanceof static))
		{
			$search	= new static;
		}
		
		// Set search details
		
		$search->set ('name',			$page->get ('name_menu'));
		$search->set ('title',			$page->get ('title'));
		$search->set ('keywords',		$page->get ('keywords'));
		$search->set ('description',	$page->get ('description'));
		$search->set ('content',		strip_tags ($page->getContent ()));
		$search->set ('state',			$page->get ('state_active'));

		// Update or create page
		
		if ($search->getPK ())
		{
			return $search->Update ();
		}
		else
		{
			$search->set ('page_id', $page->getPK ());
			return $search->Create ();
		}

	}

	
	/**
	 * Return search object for a page
	 * @param integer $pageID Page ID
	 * @return \Sonic\Model\CMS\Search
	 */

	public static function _getPageObject ($pageID)
	{
		return static::_Read (array (
			'where'	=> array (
				array ('page_id', $pageID)
			)
		));
	}


	/**
	 * Delete search data for a page
	 * @param integer $page Page ID
	 * @param \PDO $db Database connection to use, default to master resource
	 * @return boolean
	 */

	public static function _deletePage ($pageID, &$db = FALSE)
	{
		return static::_Delete (array (
			'where'	=> array (
				array ('page_id', $pageID)
			)
		), $db);
	}


	/**
	 * Get pages matching a search
	 * @param string $search Search query
	 * @param integer $start Starting number for pagination, default 0
	 * @param integer $count Number of results, default 10
	 * @return \Sonic\Resource\Model\Collection|boolean
	 */

	public static function _getPages ($search, $start = 0, $count = 10)
	{
		
		// Get matching results

		try
		{
			return static::_getObjects (self::_genQueryParams ('query', $search, $start, $count));
		}
		
		// Catch PDOException

		catch (\PDOException $e)
		{
			new \Sonic\Message ('error', 'Unable to search for pages');
			return FALSE;
		}

	}



	/**
	 * Count pages matching a search
	 * @param string $strSearch Search query
	 * @return integer
	 */

	public static function _countPages ($search)
	{
		
		// Get matching results

		try
		{
			return static::_Count (self::_genQueryParams ('count', $search));
		}
		
		// Catch PDOException

		catch (\PDOException $e)
		{
			new \Sonic\Message ('error', 'Unable to count pages');
			return FALSE;
		}

	}


	/**
	 * Return page object for a search
	 * @return object|boolean
	 */

	public function getPage ()
	{
		return Page::_Read ($this->get ('page_id'));
	}
	
	
	/**
	 * Generate a search query parameter array
	 * @param string $type Query type, count or query
	 * @param string $search Search query
	 * @param integer $start Start position for limit
	 * @param integer $count Number of results
	 * @return array
	 */
	
	public static function _genQueryParams ($type, $search, $start = 0, $count = 10)
	{
		
		$params	= array (
			'select'	=> array (
				'*',
				'MATCH(name, title, keywords, description, content) AGAINST (:query1 IN BOOLEAN MODE) as score',
			),
			'where'		=> array (
				'MATCH(name, title, keywords, description, content) AGAINST (:query2 IN BOOLEAN MODE)',
				array ('state', '1')
			),
			'orderby'	=> 'score DESC, name ASC',
			'limit'		=> array ($start, $count),
			'bind'		=> array (
				':query1'	=> $search,
				':query2'	=> $search
			)
		);
		
		if ($type == 'count')
		{
			unset ($params['bind'][':query1']);
		}
		
		return $params;
		
	}
	
	
}

// End Search Class
