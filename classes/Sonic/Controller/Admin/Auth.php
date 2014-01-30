<?php

/*
 * Provide admin authentication methods with page redirects
 */

// Define namespace

namespace Sonic\Controller\Admin;

// Start Auth Class

class Auth extends \Sonic\Controller
{
	
	/**
	 * Authenticate user
	 * @param string $username Username
	 * @param string $password Password
	 */
	
	public function login ()
	{
		
		$username	= $this->getArg ('username');
		$password	= $this->getArg ('password');
		
		$this->template	= 'admin/login.tpl';
		
		if (!$username)
		{
			new \Sonic\Message ('error', 'Invalid username');
			return;
		}
		
		if (!$password)
		{
			new \Sonic\Message ('error', 'Invalid password');
			return;
		}
		
		if (\Sonic\Model\User::_Login ($username, $password) instanceof \Sonic\Model\User)
		{
			new \Sonic\Resource\Redirect ('/admin/index');
			return;
		}
		else
		{
			new \Sonic\Message ('error', 'incorrect username and/or password');
			return;
		}
		
	}
	
	
	/**
	 * Logout a user and redirect back to the login page
	 */
	
	public function logout ()
	{
		
		$user	= new \Sonic\Model\User;
		
		if ($user->initSession () === TRUE)
		{
			$user->Logout ();
			new \Sonic\Message ('success', 'Logged out');
		}
		
		$this->template	= 'admin/login.tpl';
	}
	
	
}