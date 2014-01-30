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
 * @property string $name
 * @property string $file
 */

// Define namespace

namespace Sonic\Model\CMS;

// Start Template Class

class Template extends \Sonic\Model
{
	
	
	/**
	 * Database table
	 * @var string
	 */	
	
	public static $dbTable	= 'cms_template';
	
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
			'max'		=> self::SMALLINT_MAX_UNSIGNED,
			'default'	=> 0
		),
		'name'			=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 255,
			'default'	=> ''
		),
		'file'			=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 255,
			'default'	=> ''
		)
	);
	
	
}

// End Template Class
