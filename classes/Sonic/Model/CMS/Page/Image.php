<?php

/**
 * @author			Andy Burton
 * @email			andy@andyburton.co.uk
 * @link			http://www.andyburton.co.uk
 * @copyright 		Andy Burton
 * @datecreated		31/12/2013
 */

/**
 * Class Properties:
 * @property integer $id
 * @property integer $page_id
 * @property integer $order_Id
 * @property string $title
 * @property string $description
 * @property string $filename
 * @property datetime $date_created
 * @property datetime $date_updated
 */

// Define namespace

namespace Sonic\Model\CMS\Page;

// Start Image Class

class Image extends \Sonic\Model
{
	
	
	/**
	 * Database table
	 * @var string
	 */	
	
	public static $dbTable	= 'cms_page_image';
	
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
		'order_id'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_INT,
			'charset'	=> 'int_unsigned',
			'min'		=> self::INT_MIN_UNSIGNED,
			'max'		=> self::INT_MAX_UNSIGNED,
			'default'	=> 0
		),
		'title'			=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 1000,
			'default'	=> ''
		),
		'description'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 1000,
			'default'	=> ''
		),
		'filename'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 200,
			'default'	=> ''
		),
		'date_created'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_DATETIME,
			'charset'	=> 'datetime',
			'min'		=> 0,
			'max'		=> 19,
			'default'	=> 'CURRENT_UTC_DATE',
			'deupdate'	=> TRUE
		),
		'date_updated'	=> array (
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
	 * Images to manage for this object
	 * This is used to create/resize variations of the uploaded image
	 * and remove all copies when the object is removed.
	 * @var array 
	 */
	
	protected static $images = array (
		'original'	=> array (
			'path'		=> CMS_IMAGE_PATH_ABS,
			'url'		=> CMS_IMAGE_PATH_URL,
		),
		'admin'		=> array (
			'path'		=> CMS_IMAGE_PATH_ABS_ADMIN,
			'url'		=> CMS_IMAGE_PATH_URL_ADMIN,
			'width'		=> 86,
			'height'	=> 65,
			'resize'	=> \Sonic\Resource\Image::RESIZE_CROP,
			'prop'		=> TRUE
		)
	);
	
	
	/**
	 * Create the object
	 * @param array $exclude Attributes not to set
	 * @param \PDO $db Database connection to use, default to master resource
	 * @return boolen
	 */

	public function Create ($exclude = array (), &$db = FALSE)
	{

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

		// Call parent method

		$return	= parent::Update ($exclude, $db);
		
		// If the object was not updated

		if (!$return)
		{
			return FALSE;
		}
		
		// Reindex pages

		$this->reindex ();

		// Return TRUE

		return TRUE;

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

		// If there is no file path read the object

		if (!$this->filename)
		{
			$this->Read ();
		}

		// Remove file

		if (!$this->RemoveFile ())
		{
			return FALSE;
		}

		// Call parent

		return parent::Delete ();

	}


	/**
	 * Remove file
	 * @return boolean
	 */

	public function RemoveFile ()
	{
		
		// If no file return TRUE anyway to delete the database entry
		
		if (!$this->filename)
		{
			return TRUE;
		}
		
		foreach (self::$images as $image)
		{
			if (file_exists ($image['path'] . $this->filename) && 
				!unlink ($image['path'] . $this->filename))
			{
				return FALSE;
			}	
		}
		
		// All removed that exist
		
		return TRUE;

	}


	/**
	 * Return the URL for a file type
	 * @return string
	 */

	public function getURL ($type)
	{
		
		if (!isset (self::$images[$type]) || !isset (self::$images[$type]['url']))
		{
			return FALSE;
		}
		
		return self::$images[$type]['url'] . $this->filename;
		
	}
	
	
	/**
	 * Return the admin icon URL
	 * @return string
	 */
	
	public function getAdminIconURL ()
	{
		return $this->getURL ('admin');
	}


	/**
	 * Upload file
	 * @param array $image File Upload
	 * return boolean
	 */

	public function Upload ($image)
	{

		// Set filename

		$this->filename	= $this->page_id . '_' . $image['name'];

		// Create image object

		$objImage	= new \Sonic\Resource\Image;

		// Set upload

		if (!$objImage->Upload ($image))
		{
			return FALSE;
		}
		
		// Create uploads
		
		foreach (self::$images as $image)
		{
			
			if (!$objImage->setPath ($image['path']))
			{
				$this->RemoveFile ();
				return FALSE;
			}
			
			$width	= isset ($image['width'])? $image['width'] : FALSE;
			$height	= isset ($image['height'])? $image['height'] : FALSE;
			$resize	= isset ($image['resize'])? $image['resize'] : FALSE;
			$prop	= isset ($image['prop'])? $image['prop'] : FALSE;
			
			if (!$objImage->createFromUpload ($this->filename, $width, $height, $resize, $prop))
			{
				$this->RemoveFile ();
				return FALSE;
			}	
			
		}

		// Return TRUE

		return TRUE;

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
	 * Reindex a page image order ids
	 * @return void
	 */

	public function reindex ()
	{

		// Set parameters

		$params['where'][]	= array ('page_id',	$this->page_id);
		$params['orderby'] = 'order_id ASC, date_updated DESC';

		// Get images

		$images	= static::_getObjects ($params);
		
		// Only continue if there are images

		if (!$images)
		{
			return;
		}

		// Prepare update query

		$query	= $this->db->prepare ('
			UPDATE ' . static::$dbTable . '
			SET order_id = :order_id
			WHERE ' . static::$pk . ' = :image_id
		');

		// Reindex each page

		foreach ($images as $key => $image)
		{

			// Bind params

			$query->bindValue (':order_id',	$key + 1);
			$query->bindValue (':image_id',	$image->getPK ());

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
	 * Export JSON string of object properties and admin icon URL
	 * @return string
	 */
	
	public function exportJSON ()
	{
		return json_encode ($this->toArray (array ('id', 'page_id', 'order_id', 'title', 'description', 'filename'),
			array (
				'icon' => array ('$this', 'getAdminIconURL')
			)
		));
	}
	
	
}

// End Image Class
