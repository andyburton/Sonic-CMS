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
 * @property string $class
 * @property string $api
 */

// Define namespace

namespace Sonic\Model\CMS;

// Start Module Class

class Module extends \Sonic\Model
{
	
	
	/**
	 * Database table
	 * @var string
	 */	
	
	public static $dbTable	= 'cms_module';
	
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
		'class'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 255,
			'default'	=> NULL,
			'null'		=> TRUE
		),
		'api'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 255,
			'default'	=> NULL,
			'null'		=> TRUE
		)
	);
	
	
	/**
	 * Load a module class object if one exists
	 * @return object|boolean
	 */

	public function loadObject ()
	{

		// If there is no module or the module class doesn't exist
		
		if (!$this->get ('class') || 
			!\Sonic\Sonic::_classExists ('Sonic\\CMS\\Module\\' . $this->get ('class')))
		{
			return FALSE;
		}

		// Return the object

		$class	= '\\Sonic\\CMS\\Module\\' . $this->get ('class');
		return new $class;

	}


	/**
	 * Return a module object
	 * @param mixed $moduleID Module ID or Name
	 * @return object|boolean
	 */

	public static function _loadObject ($moduleID)
	{

		// If the module ID is not numeric get the module object from its name

		if (!is_numeric ($moduleID))
		{
			$module	= static::_Read (array (
				'where'	=> array (
					array ('name', $moduleID)
				)
			));
		}
		
		// Else load from the ID

		else
		{
			$module	= static::_Read ($moduleID);
		}

		// Check there is a module object

		if (!$module)
		{
			return FALSE;
		}

		// Return module object

		$obj	= $module->loadObject ();
		
		if (!($obj instanceof \Sonic\CMS\Module))
		{
			return FALSE;
		}
		
		$obj->module_id	= $module->getPK ();
		
		return $obj;

	}
	
	
	/**
	 * Return module ID from its name
	 * @param string $id Name
	 * @return integer
	 */
	
	public static function _IDFromName ($name)
	{
		return self::_getValue (array (
			'select'	=> self::$pk,
			'where'		=> array (
				array ('name', $name)
			)
		));
	}
	
	
	/**
	 * Check if a module ID or name exists
	 * @param string|integer $id Module ID or name
	 * @return boolean
	 */
	
	public static function _checkExists ($id)
	{
		$params['where'][]	= is_numeric ($id)? array (self::$pk, (int)$id) : array ('name', $id);
		return self::_exists ($params);
	}
	
	
}

// End Module Class
