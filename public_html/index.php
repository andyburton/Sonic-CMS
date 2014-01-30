<?php

// Namespace

namespace Sonic;

// Sonic Framework

require_once ('../includes/init.php');

// CMS controller

try
{
	$controller	= new Controller\CMS;
	$controller->findPage ();
	$controller->View ();
	exit;
}
catch (\Exception $e)
{
	
	// If an exception that isn't a 404
	
	if ($e->getCode () != 404)
	{
		echo 'Uncaught exception: `' . $e->getMessage () . '` in ' . $e->getFile () . ' on line ' . $e->getLine ();
	}
	
}

// Failover to default bootstrap if there is nothing in the CMS

$bootstrap			= new Bootstrap ();
$bootstrap->view	= new View\Smarty;

try
{
	$controller	= $bootstrap->Run ();
}
catch (\Exception $e)
{
	
	// 404 error if the controller or action doesnt exist
	
	if ($e->getCode () == 404)
	{
		header ($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
		header ('Status: 404 Not Found');
		new Message ('error', 'Error 404: The page you requested has not been found. Please try again.');
		
		$page	= new Model\CMS\Page;
		$page->set ('title',		'Error 404 - Page not found');
		$page->set ('name_menu',	'page not found');
		$page->set ('redirect',		$_SERVER['REQUEST_URI']);
		
		$bootstrap->view->assign ('page', $page);
		$bootstrap->view->display ('error/404.tpl');
	}
	else
	{
		echo 'Uncaught exception: `' . $e->getMessage () . '` in ' . $e->getFile () . ' on line ' . $e->getLine ();
	}
	
}