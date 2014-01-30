<?php

// Define namespace

namespace Sonic\Controller\Admin\Api\CMS;

// Start Redirect Class

class Redirect extends \Sonic\Controller\JSON\Session
{
	
	/**
	 * Load module
	 * @return boolean
	 */
	
	public function load ()
	{
		
		$module	= \Sonic\Model\CMS\Module::_loadObject ($this->getArg ('module_id'));
		
		if (!($module instanceof \Sonic\CMS\Module))
		{
			return $this->Error ('Invalid module');
		}
		
		return $this->Success (array (
			'template'	=> $module->Load ($this->getArg ('page_id'))
		));
		
	}
	
	
}