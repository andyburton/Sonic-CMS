<?php

// Define namespace

namespace Sonic\Controller\Admin\Api\CMS;

// Start Redactor Class

class Redactor extends \Sonic\Controller\JSON\Session
{
	
	
	/**
	 * Absolute path to image upload directory
	 * @var string 
	 */
	
	private $gfx_upload_path;
	
	/**
	 * URL to image upload directory
	 * @var string
	 */
	
	private $gfx_upload_url;
	
	/**
	 * Absolute path to file upload directory
	 * @var string 
	 */
	
	private $file_upload_path;
	
	/**
	 * URL to file upload directory
	 * @var string
	 */
	
	private $file_upload_url;
	
	
	/**
	 * Class constructor
	 */
	
	public function __construct ()
	{
		
		parent::__construct ();
		
		$this->gfx_upload_path	= ABS_WWW . 'cms' . DS . 'gfx' . DS;
		$this->gfx_upload_url	= '/cms/gfx/';
		
		$this->file_upload_path	= ABS_WWW . 'cms' . DS . 'files' . DS;
		$this->file_upload_url	= '/cms/files/';
		
	}
	
	
	/**
	 * Set error response
	 * @param string $message Error message
	 * @return FALSE
	 */
	
	protected function error ($message = 'invalid request') 
	{
		
		$this->view->response	= array (
			'success'	=> 0,
			'error'		=> $message
		);
		
		return FALSE;
		
	}
	
	
	/**
	 * Upload image
	 * @return boolean
	 */
	
	public function upload_image ()
	{
		
		// Create file to work with
		
		if (!isset ($_FILES['file']))
		{
			return $this->error ('No file upload specified');
		}
		
		$image	= new \Sonic\Resource\File;
		
		if (!$image->Upload ($_FILES['file']))
		{
			return $this->error (\Sonic\Message::get ('error'));
		}
		
		// Check image type
		
		if (!in_array ($_FILES['file']['type'], array (
			'image/jpg', 'image/jpeg', 'image/pjpeg', 
			'image/gif', 'image/png',
		)))	{
			return $this->error ('Invalid image type, must be jpg, gif or png');
		}
		
		// Load and decode image index
		
		$indexPath	= $this->gfx_upload_path . 'images.json';
		$images		= array ();
		
		if (file_exists ($indexPath))
		{
		
			$imageIndex	= @file_get_contents ($indexPath);

			if ($imageIndex === FALSE)
			{
				return $this->error ('Unable to load image index');
			}

			$images	= json_decode ($imageIndex, TRUE);
			
			if (is_null ($images))
			{
				return $this->error ('Error decoding the image index');
			}
			
		}
		
		// Save image
		
		if (!$image->Save ($this->gfx_upload_path))
		{
			return $this->error (\Sonic\Message::get ('error'));
		}
		
		// Add new image to the index
		
		$images[]	= array (
			'thumb'	=> $this->gfx_upload_url . $image->getFilename (),
			'image'	=> $this->gfx_upload_url . $image->getFilename (),
		);
		
		$imageJSON	= json_encode ($images);
		
		if ($imageJSON === FALSE)
		{
			$image->Delete ();
			return $this->error ('Error adding the new image to the image index');
		}
		
		if (!@file_put_contents ($indexPath, $imageJSON))
		{
			$image->Delete ();
			return $this->error ('Error updating the image index');
		}
		
		// Return newly uploaded image
		
		$this->success (array (
			'filelink'	=> $this->gfx_upload_url . $image->getFilename ()
		));
		
	}
	
	
	/**
	 * Upload file
	 * @return boolean
	 */
	
	public function upload_file ()
	{

		// Create file to work with
		
		if (!isset ($_FILES['file']))
		{
			return $this->error ('No file upload specified');
		}
		
		$file	= new \Sonic\Resource\File;
		
		if (!$file->Upload ($_FILES['file']))
		{
			return $file->error (\Sonic\Message::get ('error'));
		}
		
		// Save file
		
		if (!$file->Save ($this->file_upload_path))
		{
			return $this->error (\Sonic\Message::get ('error'));
		}
		
		// Return newly uploaded file
		
		$this->success (array (
			'filelink'	=> $this->file_upload_url . $file->getFilename (),
			'filename'	=> $file->getFilename ()
		));
		
	}
	
	
}