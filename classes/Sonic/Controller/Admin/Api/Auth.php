<?php

/*
 * Provide admin authentication API methods
 */

// Define namespace

namespace Sonic\Controller\Admin\Api;

// Start Auth Class

class Auth extends \Sonic\Controller\JSON
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
		
		if (!$username)
		{
			return $this->error ('invalid username');
		}
		
		if (!$password)
		{
			return $this->error ('invalid password');
		}
		
		if (\Sonic\Model\User::_Login ($username, $password) instanceof \Sonic\Model\User)
		{
			$this->success ();
		}
		else
		{
			return $this->error ('incorrect username and/or password');
		}
		
	}
	
	
	/**
	 * Logout user
	 */
	
	public function logout ()
	{
		
		$user	= new \Sonic\Model\User;
		
		if ($user->initSession () === TRUE)
		{
			$user->Logout ();
		}
		
		return $this->success ();
		
	}
	
	
	/**
	 * Check authentication status
	 * TRUE for authenticated, otherwise error string
	 */
	
	public function status ()
	{
		$user	= new \Sonic\Model\User;
		return $this->success (array ('status' => $user->initSession ()));
	}
	
	
}