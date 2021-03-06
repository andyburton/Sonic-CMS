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
 * @property integer $module_id
 */

// Define namespace

namespace Sonic\Model\CMS\Page;

// Start Module Class

class Module extends \Sonic\Model
{
	
	
	/**
	 * Database table
	 * @var string
	 */	
	
	public static $dbTable	= 'cms_page_module';
	
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
			'default'	=> 0,
			'relation'	=> 'Sonic\Model\CMS\Page'
		),
		'module_id'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_INT,
			'charset'	=> 'int_unsigned',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> self::SMALLINT_MAX_UNSIGNED,
			'default'	=> 0,
			'relation'	=> 'Sonic\Model\CMS\Module'
		)
	);
	
	
}

// End Module Class
