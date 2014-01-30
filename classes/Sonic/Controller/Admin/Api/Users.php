<?php

// Define namespace

namespace Sonic\Controller\Admin\Api;

// Start Users Class

class Users extends \Sonic\Controller\JSON\Session
{
	
	
	/**
	 * Check the user is authenticated
	 * @return boolean
	 */
	
	protected function checkAuthenticated ($session_id = FALSE)
	{
		
		if (!parent::checkAuthenticated ($session_id = FALSE))
		{
			return FALSE;
		}
		
		// Make sure the user is a superadmin
		
		return $this->user->admin? TRUE : FALSE;
		
	}
	
	
	/**
	 * Return users
	 * @param integer $id (Optional) User ID
	 */
	
	public function index ()
	{
		
		$id			= $this->getArg ('id');
		
		if (!ctype_digit ($id))
		{
			$id	= NULL;
		}
		elseif (!\Sonic\Model\User::_IDexists ($id))
		{
			return $this->error ('Invalid User');
		}
		
		$this->success (array (
			'list' => \Sonic\Model\User::_getObjects (array (
				'orderby'	=> 'first_name ASC, last_name ASC'
			))->toArray (array ('id', 'email', 'first_name', 'last_name'))
		));
		
	}
	
	
	/**
	 * Delete user
	 * @return integer $id User ID
	 */
	
	public function delete ()
	{
		
		$id	= $this->getArg ('id');
		
		if (!ctype_digit ($id) || !\Sonic\Model\User::_IDexists ($id))
		{
			return $this->error ('Invalid User');
		}
		
		if (!\Sonic\Model\User::_delete ($id))
		{
			return $this->error ('Unable to delete user');
		}
		else
		{
			return $this->success ();
		}
		
	}
	
	
}