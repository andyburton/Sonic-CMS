<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:53:44
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/cms/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74413175852ea2baee0b074-57625838%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4b4d61e9cab07c89f554feadb0d8128fbfd1bc0' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/cms/edit.tpl',
      1 => 1389279735,
      2 => 'file',
    ),
    '03aafecb6b06ac276e0cf169706877cac7952b6b' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/cms/addedit.tpl',
      1 => 1389809055,
      2 => 'file',
    ),
    '67495e25f892d4de77e600eb097618f373fcb01d' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/page.tpl',
      1 => 1390316735,
      2 => 'file',
    ),
    '46781450d06040bdbf73d2e17a944bb892707743' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/cms/form.tpl',
      1 => 1391079230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74413175852ea2baee0b074-57625838',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea2baf0c2fc7_15708885',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea2baf0c2fc7_15708885')) {function content_52ea2baf0c2fc7_15708885($_smarty_tpl) {?><?php if (!is_callable('smarty_function_messages')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.messages.php';
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
<link rel="stylesheet" type="text/css" href="/redactor/redactor.css">


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/admin/ajax.js"></script>
    <script type="text/javascript" src="/js/admin/message.js"></script>
	<script type="text/javascript" src="/js/admin/hovertip.js"></script>
	
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="/redactor/redactor.min.js"></script>
<script type="text/javascript" src="/redactor/plugins/fontsize/fontsize.js"></script>
<script type="text/javascript" src="/redactor/plugins/fullscreen/fullscreen.js"></script>
<script type="text/javascript" src="/js/admin/cms/modules.js"></script>
<script>

CMS_Modules.setPageID(<?php echo $_smarty_tpl->tpl_vars['page']->value->getPK();?>
);
<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
	CMS_Modules.setModule ("<?php echo $_smarty_tpl->tpl_vars['module']->value->getPK();?>
",<?php echo $_smarty_tpl->tpl_vars['module']->value->toJSON();?>
);
<?php } ?>
<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page_modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
	CMS_Modules.enableModule ("<?php echo $_smarty_tpl->tpl_vars['module']->value->get('module_id');?>
");
<?php } ?>

$(function(){

	var parent_cache = {};
	
	$('#parent_page').autocomplete ({
		minLength: 3,
		source: function (request, response) {

			var term = request.term;
			if (term in parent_cache) {
				response (parent_cache[term]);
				return;
			}
			
			$.getJSON ("/admin/api/cms/search_parent", request, function (data, status, xhr) {
				if (data.success && data.results)
				{
					parent_cache[term] = data.results;
					response (data.results);
				}
			});

		},
		select: function (event, ui) {
			$('#page_page_id').val (ui.item.id);
		}
	}).data ('ui-autocomplete')._renderItem = function (ul, item) {
		return $('<li>')
			.append ('<a>' + item.parent + ' > ' + item.value + '</a>')
			.appendTo (ul);
    };

	$('.page_content').redactor({
		minHeight	: 200,
		plugins		: ['fontsize','fullscreen'],
		imageUpload	: '/admin/api/cms/redactor/upload_image',
		imageGetJson: '/cms/gfx/images.json',
		imageUploadErrorCallback : function (json) {
			Message.addError (json.error);
			$('html, body').animate ({
				scrollTop: 0
			}, 500);
		},
		fileUpload	: '/admin/api/cms/redactor/upload_file',
		fileUploadErrorCallback : function (json) {
			Message.addError (json.error);
			$('html, body').animate ({
				scrollTop: 0
			}, 500);
		}
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
	
	<h3>Page - Edit</h3>

	<form id="admin_cms_page" action="?id=<?php echo $_smarty_tpl->tpl_vars['page']->value->getPK();?>
" method="post">
	<input type="hidden" id="form_action" name="form_action" value="edit" />
	
	<?php /*  Call merged included template "admin/cms/form.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("admin/cms/form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('action'=>"edit"), 0, '74413175852ea2baee0b074-57625838');
content_52ea2f38e03408_89370820($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "admin/cms/form.tpl" */?>

	<p class="submit">
		<input type="submit" id="btn_edit" name="page_edit" value="Update Page" />
	</p>

	</form>

</div>
	
<div id="dialog-confirm" title="Are you sure?">
	<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
	<span class="msg">Are you sure you wish to remove this module?</span>
</div>

        </div>

    </div>

	<div id="footer"></div>

</div>
		
</body>
</html><?php }} ?>
<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:53:44
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/cms/form.tpl" */ ?>
<?php if ($_valid && !is_callable('content_52ea2f38e03408_89370820')) {function content_52ea2f38e03408_89370820($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/var/www/andy/GitHub/smarty/plugins/function.html_options.php';
if (!is_callable('smarty_modifier_array')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/modifier.array.php';
if (!is_callable('smarty_function_html_radios')) include '/var/www/andy/GitHub/smarty/plugins/function.html_radios.php';
?><div class="left column">

	<h3>Page Details</h3>
	
	<input type="hidden" name="page_id" id="page_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value->getPK();?>
" />
	
	<p>
		<label for="page_name">Name <span class="req">*</span></label>
		<input type="text" name="page_name" id="page_name" value="<?php echo $_smarty_tpl->tpl_vars['page']->value->name;?>
" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The name that will be displayed in the admin to distinguish the page.</span>
	</p>

	<p>
		<label for="page_title">Title</label>
		<input type="text" name="page_title" id="page_title" value="<?php echo $_smarty_tpl->tpl_vars['page']->value->title;?>
" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The page browser title.<br />
		This is important for search engine optimisation and can be seen at the top of the browser window and in the task bar.</span>
	</p>
	
	<p>
		<label for="page_name_menu">Link Text <span class="req">*</span></label>
		<input type="text" name="page_name_menu" id="page_name_menu" value="<?php echo $_smarty_tpl->tpl_vars['page']->value->name_menu;?>
" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The text that will be displayed for the page in the menu.</span>
	</p>
	
	<p>
		<label for="page_redirect">Path</label>
		<input type="text" name="page_redirect" id="page_redirect" value="<?php echo $_smarty_tpl->tpl_vars['page']->value->redirect;?>
" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">A custom URL path to the page.<br />
		E.g. entering "contact" would set http://www.yourdomain.com/contact to load the page. This is very useful for search engine optimisation.</span>
	</p>

	<p>
		<label for="page_description">Description</label>
		<textarea name="page_description" id="page_description" rows="3" class="normal"><?php echo $_smarty_tpl->tpl_vars['page']->value->description;?>
</textarea>
		<span class="infoHover"></span>
		<span class="infoHover_txt">A short page description.<br />
		This is used for the META description tag.</span>
	</p>

	<p>
		<label for="page_keywords">Keywords</label>
		<textarea name="page_keywords" id="page_keywords" rows="2" class="normal"><?php echo $_smarty_tpl->tpl_vars['page']->value->keywords;?>
</textarea>
		<span class="infoHover"></span>
		<span class="infoHover_txt">A list of keywords.<br />
		This is used for the META keywords tag and should be entered in a comma delimited format e.g. keyword A, keyword B, keyword C.</span>
	</p>
	
</div>

<div class="right column">

	<h3>Page Settings</h3>

	<p>
		<label for="page_page_id">Parent Page</label>
		<input type="hidden" name="page_page_id" id="page_page_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value->page_id;?>
" />
		<input type="text" name="parent_page" id="parent_page" value="<?php echo $_smarty_tpl->tpl_vars['page_parent']->value->name;?>
" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The parent page that the current page belongs under.</span>
	</p>

	<p>
		<label for="page_order_id">Order ID</label>
		<input type="text" name="page_order_id" id="page_order_id" value="<?php echo $_smarty_tpl->tpl_vars['page']->value->order_id;?>
" maxlength="8" class="xxsmall" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The order of the page in relation to other pages with the same parent.</span>
	</p>
	

	<p>
		<label for="page_template_id">Template</label>
		<select name="page_template_id" id="page_template_id">
		<?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['templates']->value,'selected'=>$_smarty_tpl->tpl_vars['page']->value->template_id),$_smarty_tpl);?>

		</select>
		<span class="infoHover"></span>
		<span class="infoHover_txt">The template for the page layout.</span>
	</p>
	
	<p>
		<label for="page_external_url">External URL</label>
		<input type="text" name="page_external_url" id="page_external_url" value="<?php echo $_smarty_tpl->tpl_vars['page']->value->external_url;?>
" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">An external web address that this page redirects to.</span>
	</p>
	
	<p>
		<label for="page_homepage">Homepage</label>
		<div class="radioset">
		<?php echo smarty_function_html_radios(array('name'=>"page_homepage",'id'=>"page_homepage",'values'=>smarty_modifier_array("1,0"),'output'=>smarty_modifier_array("Yes,No"),'selected'=>$_smarty_tpl->tpl_vars['page']->value->homepage),$_smarty_tpl);?>

		</div>
		<span class="infoHover"></span>
		<span class="infoHover_txt">Whether the current page is the website homepage or not.<br>
		There can only be 1 homepage for the website. If this is set to yes any other homepage will be set to no.</span>
		<br clear="all" />
	</p>

	<p>
		<label for="page_state_menu">Menu</label>
		<div class="radioset">
		<?php echo smarty_function_html_radios(array('name'=>"page_state_menu",'id'=>"page_state_menu",'values'=>smarty_modifier_array("1,0"),'output'=>smarty_modifier_array("Yes,No"),'selected'=>$_smarty_tpl->tpl_vars['page']->value->state_menu),$_smarty_tpl);?>

		</div>
		<span class="infoHover"></span>
		<span class="infoHover_txt">Whether the page should appear in the website menu or not.</span>
	</p>
	
	<p>
		<label for="page_state_active">Page Status</label>
		<div class="radioset">
		<?php echo smarty_function_html_radios(array('name'=>"page_state_active",'id'=>"page_state_active",'values'=>smarty_modifier_array("1,0"),'output'=>smarty_modifier_array("Active,Inactive"),'selected'=>$_smarty_tpl->tpl_vars['page']->value->state_active),$_smarty_tpl);?>

		</div>
		<span class="infoHover"></span>
		<span class="infoHover_txt">If the page is active it can be accessed by anybody.<br>
		If the page is set to inactive it cannot be viewed or linked to publically, as if the page did not exist.</span>
	</p>
	
</div>
<br clear="both" />
		
<?php if ($_smarty_tpl->tpl_vars['modules']->value) {?>
	<h3>Page Modules</h3>
	<div id="cms_modules">
	<?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
		<div class="cms_module" module="<?php echo $_smarty_tpl->tpl_vars['module']->value->getPK();?>
"></div>
	<?php } ?>
	</div>
	<br clear="both" />
	<div id="cms_module_settings"></div>
<?php }?>

<?php  $_smarty_tpl->tpl_vars['content'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['content']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page_content']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['content']->key => $_smarty_tpl->tpl_vars['content']->value) {
$_smarty_tpl->tpl_vars['content']->_loop = true;
?>
	<h3><?php echo (($tmp = @$_smarty_tpl->tpl_vars['content']->value->name)===null||$tmp==='' ? 'Page Content' : $tmp);?>
</h3>
	<textarea name="cms_page_content[<?php echo $_smarty_tpl->tpl_vars['content']->value->getPK();?>
]" class="xxwide page_content"><?php echo $_smarty_tpl->tpl_vars['content']->value->content;?>
</textarea>
<?php } ?>

<?php if (!$_smarty_tpl->tpl_vars['page_content']->value) {?>
	<h3>Page Content</h3>
	<textarea name="cms_page_content[0]" class="xxwide page_content"></textarea>
<?php }?><?php }} ?>
