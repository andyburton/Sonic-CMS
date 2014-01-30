<?php

// Smarty menu function

function smarty_function_menu ($params, &$tpl)
{
	
	$page	= $tpl->getTemplateVars ('page');
	$type	= isset ($params['type'])? $params['type'] : FALSE;
	$order	= isset ($params['order'])? $params['order'] : FALSE;
	
	switch ($type)
	{
		
		case 'top':
			return $page->generateTopMenu (array (), $order);
			break;
		
		case 'parent':
			return $page->generateParentMenu (array (), $order);
			break;
		
		case 'sub':
		default:
			return $page->generateSubMenu (array (), $order);
			break;
		
	}
	
}