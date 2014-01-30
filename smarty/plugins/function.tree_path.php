<?php

// Smarty tree_path function

function smarty_function_tree_path ($params, &$tpl)
{
	
	$path		= NULL;
	$page		= $tpl->getTemplateVars ('page');
	$delimiter	= ' ' . (isset ($params['delimiter'])? $params['delimiter'] : '>') . ' ';
	$lowercase	= isset ($params['lowercase'])? $params['lowercase'] : FALSE;
	
	$parents	= array_reverse ($page->getParentPages (TRUE));
	array_push ($parents, $page);
	
	foreach ($parents as $obj)
	{
		$path	.= $delimiter . '<a href="' . $obj->generateURL() . '" title="' . $obj->get ('title') . '">';
		$path	.= $lowercase? strtolower ($obj->get ('name_menu')) : $obj->get ('name_menu');
		$path	.= '</a>';
	}
	
	return $path;
	
}