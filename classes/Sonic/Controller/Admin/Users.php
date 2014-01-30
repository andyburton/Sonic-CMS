<?php

/*
 * Provide user settings methods
 */

// Define namespace

namespace Sonic\Controller\Admin;

// Start Users Class

class Users extends \Sonic\Controller\Session
{
		
	
	/**
	 * Check the user is authenticated
	 * @return boolean
	 */
	
	protected function checkAuthenticated ()
	{
		
		if (!parent::checkAuthenticated ())
		{
			return FALSE;
		}
		
		// Make sure the user is a superadmin
		
		if (!$this->user->admin)
		{
			new \Sonic\Resource\Redirect ('/admin', array ('error' => 'You are not authorised to view this area!'));
			return FALSE;
		}
		
		return TRUE;
		
	}
	
	
	/**
	 * Display index page
	 */
	
	public function index ()
	{
	}
	
	
	/**
	 * Add user
	 * @param string $add_user (Optional) Whether to add a user
	 */
	
	public function add ()
	{
		
		$user	= new \Sonic\Model\User;
		$this->view->assignByRef ('newuser',	$user);
		
		if ($this->getArg ('add_user'))
		{
			
			// User data
			
			$user->fromPost (TRUE, array ('first_name', 'last_name', 'email', 'active', 'admin'));
			
			if (\Sonic\Message::count ('error'))
			{
				return FALSE;
			}
			
			// Create
			
			if (!$user->create ())
			{
				new \Sonic\Message ('error', 'Unable to add user');
				return;
			}
			
			// Commit
			
			new \Sonic\Resource\Redirect ('\admin\users', array ('message' => 'User Added!'));

		}
		
	}
	
	
	/**
	 * Edit user
	 * @param string $edit_user (Optional) Whether to edit a user
	 * @param string $user_id User ID
	 * @param string $user_first_name First name
	 * @param string $user_last_name Last name
	 * @param string $user_email Email address
	 * @param string $user_active Active status
	 * @param string $user_admin Admin status
	 * @param string $user_password (Optional) New password
	 * @param string $user_password_confirm (Optional) Password confirmation
	 */
	
	public function edit ()
	{
		
		$id	= $this->getArg ('id');
		
		if (!\Sonic\Model\User::_IDexists ($id))
		{
			new \Sonic\Resource\Redirect ('index', array (
				'error'	=> 'Invalid User'
			));
		}
		
		$user	= \Sonic\Model\User::_read ($id);
		$this->view->assignByRef ('newuser',	$user);
		
		if ($this->getArg ('edit_user'))
		{
			
			// User data
			
			$user->fromPost (TRUE, array ('first_name', 'last_name', 'email', 'active', 'admin'));
			
			if (\Sonic\Message::count ('error'))
			{
				return FALSE;
			}
			
			// New password
			
			$exclude	= array ();

			if ($user->get ('password'))
			{
				if ($user->get ('password') !== $this->getArg ('user_password_confirm'))
				{
					new \Sonic\Message ('error', 'The new passwords did not match, please try again');
					return;
				}
			}
			else
			{
				$exclude[]	= 'password';
			}
			
			// Update
			
			if (!$user->update ($exclude))
			{
				new \Sonic\Message ('error', 'User update failed, please try again');
				return;
			}
			
			// Success
			
			$user->read ();
			new \Sonic\Message ('success', 'User Updated');

		}
		
	}
	
	
}