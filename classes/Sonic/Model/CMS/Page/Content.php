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
 * @property string $content
 * @property integer $date_updated
 * @property integer $date_created
 */

// Define namespace

namespace Sonic\Model\CMS\Page;

// Start Content Class

class Content extends \Sonic\Model
{
	
	
	/**
	 * Database table
	 * @var string
	 */	
	
	public static $dbTable	= 'cms_page_content';
	
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
	
	
}

// End Content Class
