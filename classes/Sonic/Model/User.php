<?php

/**
 * @author			Andy Burton
 * @email			andy@andyburton.co.uk
 * @link			http://www.andyburton.co.uk
 * @copyright 		Andy Burton
 * @datecreated		22/05/2013
 */

/**
 * Class Properties:
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property enum $admin
 * @property enum $active
 * @property enum $removed
 */

// Define namespace

namespace Sonic\Model;

// Start User Class

class User extends \Sonic\Resource\User
{
	
	
	/**
	 * Database table
	 * @var string
	 */	
	
	public static $dbTable	= 'user';
	
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
		'email'			=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 255,
			'default'	=> ''
		),
		'password'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 60,
			'default'	=> ''
		),
		'first_name'	=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 100,
			'default'	=> ''
		),
		'last_name'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_STRING,
			'charset'	=> 'default',
			'min'		=> self::SMALLINT_MIN_UNSIGNED,
			'max'		=> 100,
			'default'	=> ''
		),
		'admin'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_ENUM,
			'values'	=> array ('0','1'),
			'default'	=> '0'
		),
		'active'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_ENUM,
			'values'	=> array ('0','1'),
			'default'	=> '1'
		),
		'removed'		=> array (
			'get'		=> TRUE,
			'set'		=> TRUE,
			'type'		=> self::TYPE_ENUM,
			'values'	=> array ('0','1'),
			'default'	=> '0'
		)
	);
	
	
	/**
	 * Create a new user
	 * @param array $exclude Attributes not to set
	 * @param \PDO $db Database connection to use, default to master resource
	 * @return boolean
	 */
	
	public function Create ($exclude = array (), &$db = FALSE)
	{
		
		// Set random password
		
		$this->iset ('password', \Sonic\Resource\Crypt::_randomPassword ());
		
		// Begin transaction
		
		$this->db->beginTransaction ();
		
		// Call parent method
		
		if (!parent::Create ($exclude, $db))
		{
			$this->db->rollBack ();
			return FALSE;
		}
		
		// Send email
		
		$email	= new \Sonic\Resource\Email;
		$email->setPHPMail ();
		
		$email->addHTML ("
			<p style='font-family:Arial;font-size:12px;'>Your admin login details for <a href=\"" . URL_ROOT . "admin\">" . URL_ROOT . "admin</a> are:<br />
			Username: " . $this->iget ('email') . "<br />
			Password: " . $this->iget ('password') . "</p>
		");
		
		$email->addRecipient ($this->iget ('email'), $this->iget ('first_name') . ' ' . $this->iget ('last_name'));
		
		if (!$email->Send (EMAIL_FROM, 'Admin Account Login'))
		{
			$this->db->rollBack ();
			new \Sonic\Message ('error', 'Unable to send registration email. The user was not created');
			return FALSE;
		}
		
		// Commit
		
		$this->db->commit ();
		
		// Return TRUE
		
		return TRUE;
		
	}
	
	
	/**
	 * Mark a user as removed
	 * @return boolean
	 */
	
	public function Remove ()
	{
		return $this->updateAttribute ('removed', '1');
	}
	
	
}

// End User Class
