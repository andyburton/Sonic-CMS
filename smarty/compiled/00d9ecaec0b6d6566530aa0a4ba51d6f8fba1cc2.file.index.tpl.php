<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:00:51
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/cms/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103191008152ea22d394cae2-54563353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00d9ecaec0b6d6566530aa0a4ba51d6f8fba1cc2' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/cms/index.tpl',
      1 => 1390216058,
      2 => 'file',
    ),
    '67495e25f892d4de77e600eb097618f373fcb01d' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/page.tpl',
      1 => 1390316735,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103191008152ea22d394cae2-54563353',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea22d3a296d5_36831912',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea22d3a296d5_36831912')) {function content_52ea22d3a296d5_36831912($_smarty_tpl) {?><?php if (!is_callable('smarty_function_messages')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.messages.php';
?><!DOCTYPE html>
<html>
<head>
	
	<title>Website Admin</title>
	<meta name="author" content="Burton Web Services - http://www.burtonws.co.uk" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" media="all">
		@import url("/css/admin/admin.css");
		@import url("/css/overcast/jquery-ui-1.10.3.custom.min.css");
    </style>
	
<link rel="stylesheet" type="text/css" href="/css/admin/cms.css">


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/admin/ajax.js"></script>
    <script type="text/javascript" src="/js/admin/message.js"></script>
	<script type="text/javascript" src="/js/admin/hovertip.js"></script>
	
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


</head>

<body>

<div id="wrapper">

	<div id="header"></div>

	<?php echo smarty_function_messages(array('url'=>true),$_smarty_tpl);?>


    <div id="content">

		<div id="left_container">
			<?php echo $_smarty_tpl->getSubTemplate ('admin/menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		</div>

        <div id="right_container">
			
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

        </div>

    </div>

	<div id="footer"></div>

</div>
		
</body>
</html><?php }} ?>
