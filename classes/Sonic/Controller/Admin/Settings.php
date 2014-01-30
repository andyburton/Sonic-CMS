<?php

/*
 * Provide user settings methods
 */

// Define namespace

namespace Sonic\Controller\Admin;

// Start Settings Class

class Settings extends \Sonic\Controller\Session
{
	
	/**
	 * Display index page
	 */
	
	public function index ()
	{
	}
	
	
	/**
	 * Update user
	 * @param string $user_first_name First name
	 * @param string $user_last_name Last name
	 * @param string $user_email Email address
	 * @param string $user_password_current (Optional) Current password
	 * @param string $user_password (Optional) New password
	 * @param string $user_password_confirm (Optional) Password confirmation
	 */
	
	public function update ()
	{
		
		$this->template	= 'admin/settings/index.tpl';
		
		$user	= new \Sonic\Model\User;
		$user->fromPost (TRUE, array ('first_name', 'last_name', 'email'));
		$user->set ('id', $this->user->get ('id'));
		
		if (\Sonic\Message::count ('error'))
		{
			return;
		}
		
		$exclude	= array ();
		
		if ($user->get ('password'))
		{
			
			$this->user->readAttribute ('password');
			
			if (!$this->user->checkPassword ($this->getArg ('user_password_current')))
			{
				new \Sonic\Message ('error', 'Your current password is not valid, please try again');
				return;
			}
			else if ($user->get ('password') !== $this->getArg ('user_password_confirm'))
			{
				new \Sonic\Message ('error', 'Your new passwords did not match, please try again');
				return;
			}
			
		}
		else
		{
			$exclude[]	= 'password';
		}
		
		if (!$user->update ($exclude))
		{
			new \Sonic\Message ('error', 'Settings update failed, please try again');
			return;
		}
		
		$this->user->read ();
		
		new \Sonic\Message ('success', 'Settings updated');
		
	}
	
	
}