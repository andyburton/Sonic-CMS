{extends 'cms/page.tpl'}

{block 'content'}
<div id="cms_search_results" class="search_results">

<form action="/search/" class="search_form">
	Searching for: 
	<input type="text" name="search_query" class="search_query" value="{$search_query}" placeholder="search query" />
	<input type="submit" class="submit" value="SEARCH" />
	<span class="page_num">Page {$result_page} of {$result_pages}</span>
</form>

{foreach $results as $result}
{assign "resultpage" $result->getPage()}
<div class="search_result">
	<div class="name">
		<a href="{$resultpage->generateURL()}" title="{$resultpage->title}">{$resultpage->name_menu}</a>
	</div>
	<div class="description">
		<p>{$result->content|truncate:515} <a href="{$resultpage->generateURL()}" class="more">read more</a></p>
	</div>
</div>
{/foreach}

<div class="pagination">
	<span class="count">Page {$result_page} of {$result_pages}</span>
	<ul>
	{if $search_start-$search_count < 0}<li><span>&laquo;</span></li>{else}
	<li><a href="?start={$search_start-$search_count}" title="Previous page">&laquo;</a></li>{/if}
	{if $result_pages > 6}
		{if $result_page <= 3}
			{for $num=1 to 3}
				{if $num==$result_page}<li><span class="current">{$num}</span></li>{else}
				<li><a href="?start={($num*$search_count)-$search_count}" title="Page {$num}">{$num}</a></li>{/if}
			{/for}
			{if $result_page == 3}
				<li><a href="?start={(4*$search_count)-$search_count}" title="Page 4">4</a></li>
			{/if}
			<li><span>..</span></li>
			<li><a href="?start={($result_pages*$search_count)-$search_count}" title="Page {$result_pages}">{$result_pages}</a></li>
		{elseif $result_page >= ($result_pages -2)}
			<li><a href="?start={(1*$search_count)-$search_count}" title="Page 1">1</a></li>
			<li><span>..</span></li>
			{if $result_page == $result_pages-2}
				<li><a href="?start={(($result_pages-3)*$search_count)-$search_count}" title="Page {$result_pages-3}">{$result_pages-3}</a></li>
			{/if}
			{for $num=$result_pages-2 to $result_pages}
				{if $num==$result_page}<li><span class="current">{$num}</span></li>{else}
				<li><a href="?start={($num*$search_count)-$search_count}" title="Page {$num}">{$num}</a></li>{/if}
			{/for}
		{else}
			<li><a href="?start={(1*$search_count)-$search_count}" title="Page 1">1</a></li>
			<li><span>..</span></li>
			{for $num=$result_page-1 to $result_page+1}
				{if $num==$result_page}<li><span class="current">{$num}</span></li>{else}
				<li><a href="?start={($num*$search_count)-$search_count}" title="Page {$num}">{$num}</a></li>{/if}
			{/for}
			<li><span>..</span></li>
			<li><a href="?start={($result_pages*$search_count)-$search_count}" title="Page {$result_pages}">{$result_pages}</a></li>
		{/if}
	{else}
		{for $num=1 to $result_pages}
			{if $num==$result_page}<li><span class="current">{$num}</span></li>{else}
			<li><a href="?start={($num*$search_count)-$search_count}" title="Page {$num}">{$num}</a></li>{/if}
		{/for}
	{/if}
	{if $search_start+$search_count > $result_count}<li><span>&raquo;</span></li>{else}
	<li><a href="?start={$search_start+$search_count}" title="Next page">&raquo;</a></li>{/if}
	</ul>
</div>

</div>
{/block}