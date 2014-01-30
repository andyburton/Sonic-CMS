<?php

/**
 * @author			Andy Burton
 * @email			andy@andyburton.co.uk
 * @link			http://www.andyburton.co.uk
 * @copyright 		Andy Burton
 * @datecreated		21/01/2014
 */

/**
 * Class Properties:
 * @property integer $id
 * @property integer $page_id
 * @property string $redirect
 */

// Define namespace

namespace Sonic\Model\Cms\Page;

// Start Redirect Class

class Redirect extends \Sonic\Model
{
	
	
	/**
	 * Database table
	 * @var string
	 */	
	
	public static $dbTable	= 'cms_page_redirect';
	
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
			'max'		=> self::INT_MAX_UNSIGNED,
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
		'redirect'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 500,
			'default'	=> ''
		)
	);
	
	
}

// End Redirect Class
