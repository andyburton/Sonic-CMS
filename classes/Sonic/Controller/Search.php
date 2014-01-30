<?php

// Define namespace

namespace Sonic\Controller;

// Start Search Class

class Search extends \Sonic\Controller
{
	
	/**
	 * All actions
	 */
	
	public function captureall () 
	{
		
		// Sort out search params
		
		$url	= new \Sonic\Resource\Controller\URL\REST;
		$url->Process ();
		
		$start	= 0;
		$count	= 10;
		
		if ($this->getArg ('start') !== FALSE)
		{
			$start = (int)$this->getArg ('start');
			
			if ($start < 0)
			{
				$start = 0;
			}
		}
		
		if ($this->getArg ('count') !== FALSE)
		{
			$count = (int)$this->getArg ('count');
			
			if ($count < 1)
			{
				$count = 1;
			}
			else if ($count > 25)
			{
				$count = 25;
			}
		}
		
		// If no action check for URL vars
		
		if ((!$url->action || $url->action == 'index') && $this->getURLArg ('search_query'))
		{
			$url->action	= $this->getURLArg ('search_query');
		}
		
		// Assign page details
		
		$page	= new \Sonic\Model\CMS\Page;
		$page->set ('redirect',		'search/' . $url->action);
		$page->set ('name_menu',	'Search - ' . $url->action);
		
		$this->view->assignByRef ('page',		$page);
		$this->view->assign ('search_query',	$url->action);
		$this->view->assign ('search_start',	$start);
		$this->view->assign ('search_count',	$count);
		
		if (strlen ($url->action) < 3)
		{
			new \Sonic\Message ('error', 'Your search query must be at least 3 characters!');
			return;
		}
		
		$result_count	= \Sonic\Model\CMS\Search::_countPages ($url->action);
		$this->view->assign ('result_count',	$result_count);
		
		$page->set ('title',	$result_count . ' Search Result' . ($result_count != 1? 's' : ''));
		
		$pages			= ceil ($result_count / $count);
		$pageNum		= floor ($start / $count) +1;
		
		$this->view->assign ('result_pages',	$pages);
		$this->view->assign ('result_page',		$pageNum);
		
		// If no results dont bother searching
		
		if (!$result_count)
		{
			new \Sonic\Message ('error', 'Unfortunatley we couldn\'t find any results matching your query');
			return;
		}
		
		// Else we have results
		
		else
		{
			
			$results	= \Sonic\Model\CMS\Search::_getPages ($url->action, $start, $count);
			
			// If just 1 result forward to that page
			
			if ($result_count == 1)
			{
				$result	= $results[0];
				new \Sonic\Resource\Redirect ($result->getPage ()->generateURL ());
			}
			else
			{
				$this->view->assign ('results',	\Sonic\Model\CMS\Search::_getPages ($url->action, $start, $count));
			}
			
		}
		
	}
	
}