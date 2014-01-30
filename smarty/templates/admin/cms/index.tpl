{extends 'admin/page.tpl'}

{block 'css'}
<link rel="stylesheet" type="text/css" href="/css/admin/cms.css">
{/block}

{block 'js'}
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/admin/list.js"></script>
<script type="text/javascript">
$(function (){
	
	AdminList.init ('cms', 'CMS Page', {
		recursive:		false, 
		addchild:		true, 
		root_addchild:	true
	});
		
	$('#refresh_search').click (function () {
		$.getJSON ('/admin/api/cms/reindex_search', function (json) {
			if (json.success)
			{
				Message.addMessage (json.pages_indexed + ' Pages Re-indexed');
			}
			else
			{
				Message.addError (json.error_description);
			}
		});
		return false;
	});
	
	$('#cancel_search').click (function () {
		AdminList.clear ();
		AdminList.loadIndex ($('#' + AdminList.module), false, {});
		$('#cms_search_query').val ('')
		return false;
	});
	
	var parent_cache = {};
	
	$('#cms_search_query').autocomplete ({
		minLength: 3,
		source: function (request, response) {

			var term = request.term;
			if (term in parent_cache) {
				response (parent_cache[term]);
				return;
			}
			
			$.getJSON ("/admin/api/cms/search", request, function (data, status, xhr) {
				if (data.success && data.results)
				{
					parent_cache[term] = data.results;
					response (data.results);
				}
			});
		},
		select: function (event, ui) {
			$('#cms_search_query').val (ui.item.value);
			$('#cms_search').submit ();
		}
	});
	
	$('#cms_search').submit (function () {
		AdminList.clear ();
		AdminList.loadIndex ($('#' + AdminList.module), false, {
			search: $('#cms_search_query').val ()
		});
		AdminList.loadParams	= {};
		return false;
	});
	
});
</script>
{/block}

{block 'content'}
<div class="content">

	<h3>Website Pages</h3>
	
	<p><a href="/admin/cms/add" class="add">Add new page</a></p>
	<p><a href="/admin/cms/reindex_search" class="db_refresh" id="refresh_search">Reindex search</a></p>
	<p><a href="#" class="delete" id="cancel_search">Cancel search</a></p>
	
	<form action="#" id="cms_search">
		<input type="text" id="cms_search_query" name="search" value="" class="wide" />
		<input type="submit" id="cms_search_submit" name="cms_search_submit" value="Search" class="submit" />
	</form>
	
	<ul id="cms" class="admin_list"></ul>
	
</div>
{/block}