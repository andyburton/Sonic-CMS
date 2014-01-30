<?php

// Smarty messages function

function smarty_function_messages ($params, &$tpl)
{
	
	// Set valid message types
	
	$validTypes	= array ('success', 'error');
	
	// Set messages
	
	$messages	= '<div class="message_container">';
	
	// If the URL flag is true
	
	if (isset ($params['url']) && $params['url'])
	{
		
		// Set messages
		
		if (isset ($_GET['message']))
		{
			new \Sonic\Message ('success', $_GET['message']);
		}
		
		if (isset ($_GET['error']))
		{
			new \Sonic\Message ('error', $_GET['error']);
		}
		
	}

	// If there is a type
	
	if (isset ($params['type']) && in_array ($params['type'], $validTypes))
	{
		
		// If there are any messages
		
		if (\Sonic\Message::count ($params['type']) > 0)
		{
			
			// Generate messages

			$message	= \Sonic\Message::getString ($params['type'], '<p>', '</p>');
			$tpl->assign ('message', $message);
			$messages	.= $tpl->fetch ('message/' . $params['type'] . '.tpl', 'message|' . $params['type'] . '|' . md5 ($message));
			
			// Reset messages
			
			\Sonic\Message::reset ($params['type']);
			
		}
		
	}
	
	// Else there is no type
	
	else
	{
		
		// If there are any messages
		
		if (\Sonic\Message::count ())
		{
			
			// Generate messages
			
			$messageTypes	= array_keys (\Sonic\Message::get ());
			
			foreach ($messageTypes as $type)
			{
				
				if (!in_array ($type, $validTypes))
				{
					continue;
				}
				
				$message	= \Sonic\Message::getString ($type, '<p>', '</p>');
				$tpl->assign ('message', $message);
				$messages	.= $tpl->fetch ('message/' . $type . '.tpl', 'message|' . $type . '|' . md5 ($message));
				
			}
			
			// Reset messages
			
			\Sonic\Message::reset ();
			
		}
		
	}
	
	// Close messages
	
	$messages	.= '</div>';
	
	// Return messages
	
	return $messages;
	
}