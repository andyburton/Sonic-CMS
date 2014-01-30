<!DOCTYPE HTML>
<html lang="en">
<head>

	<title>{block 'title'}{$page->get('title')}{/block}</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="{block 'meta_description'}{$page->get('description')}{/block}" />
	<meta name="keywords" content="{block 'meta_keywords'}{$page->get('keywords')}{/block}" />

	<link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	{block 'css'}{/block}

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/search.js"></script>
	{block 'js'}{/block}
	
</head>
<body>
	
<div id="wrapper">
	
	<div id="header_container">
		<div class="content">
			
			<h1>
				Sonic-CMS from<br>
				<a href="https://github.com/andyburton/Sonic-CMS">https://github.com/andyburton/Sonic-CMS</a>
			</h1>
			
			<ul id="top_menu">
				{menu type='top' order='name'}
			</ul>
			
			<form class="search_form">
				<input type="search" name="search_query" placeholder="Search website..." value="{$search_query}">
			</form>
				
		</div>	
	</div>
			
	<div id="path">
		<div class="content">
			You are here {tree_path lowercase=true}
		</div>
	</div>

	<div id="content_container">
		<div class="content">
			
			{messages url=true}
			
			<div class="content_wrapper">
				<div class="content_left">
				{block 'content'}
					<h2>{$page->get('title')}</h2>
					{$page->getContent()}
				{/block}
				</div>
				
				{assign "images" $page->loadModuleObjects('Images')}
				{if $images}
				<h2>Pictures</h2>
				<div class="images">
					{foreach $images as $image}
						<a href="{$image->getURL('original')}" class="fancybox" rel="group">
							<img src="{$image->getURL('admin')}" title="{$listing->name}" />
						</a>
					{/foreach}
				</div>
				{/if}
				
				{if $page->countSubPages()}
				<div id="side_menu">
					<h3>Children</h3>
					<ul>
						{menu type='sub' order='name'}
					</ul>
				</div>
				{/if}
			</div>
				
		</div>
	</div>
	
	<div id="footer_container">
		<div class="content">
			Sonic-CMS from <a href="https://github.com/andyburton/Sonic-CMS">https://github.com/andyburton/Sonic-CMS</a>
		</div>
	</div>

</div>

{block 'js_end'}{/block}
<script type="text/javascript" src="/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
</body>
</html>