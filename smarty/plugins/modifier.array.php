<?php

/**
 * Smarty array modifier plugin
 *
 * Type:     modifier
 * Name:     array
 * Purpose:  Convert a comma delimited string into a php array
 * @author   Andy Burton <andy@andyburton.co.uk>
 * @param string
 * @param boolean
 * @return array
 */

function smarty_modifier_array ($str, $blnLabels = FALSE)
{
	
	$arr	= explode (',', $str);
	
	if ($blnLabels)
	{
		
		$arrTmp	= array ();
		
		foreach ($arr as $strVal)
		{
			
			$arrTmp[$strVal]	= $strVal;
			
		}
		
		$arr	= $arrTmp;
		
	}
	
	return $arr;
	
}