<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:43:22
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/cms/modules/image/load.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17535835052ea2ccadfd710-88179779%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a7e4554454759495fc8725164052997d153c99c' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/cms/modules/image/load.tpl',
      1 => 1389279735,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17535835052ea2ccadfd710-88179779',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_id' => 0,
    'images' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea2ccae84417_33403827',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea2ccae84417_33403827')) {function content_52ea2ccae84417_33403827($_smarty_tpl) {?><h3 class="banner-head">Page Images</h3>
<input type="hidden" name="cms_module[<?php echo $_smarty_tpl->tpl_vars['module_id']->value;?>
]" value="true" />
<div>
	<p>Images will be updated immediatley when you add, edit or remove them. You will still need to save the page if you remove the module.</p>
	<ul id="cms_images"></ul>
	<div id="swfupload-control" class="uploader" style="display: none">
		<p>Upload upto 10 image files (jpg, png, gif), each having a maximum size of 10MB</p>
		<input type="button" id="button" />
		<p id="queuestatus"></p>
		<p id="errors"></p>
		<div id="output">
			<table id="queue" cellpadding="0" cellspacing="0">
				<tr>
					<th>#</th>
					<th>Filename</th>
					<th id="progress">Progress</th>
					<th>Filesize</th>
					<th>Progress</th>
					<th>Status</th>
					<th class="cancel">&nbsp;</th>
				</tr>
			</table>
		</div>
		<input type="hidden" id="phpsesh" name="phpsesh" value="<?php echo session_id();?>
" />
	</div>
</div>
<script type="text/javascript" src="/js/admin/cms/swfupload.main.js"></script>
<script type="text/javascript" src="/js/admin/cms/cmsupload.js"></script>
<script type="text/javascript" src="/js/admin/cms/modules/images.js"></script>
<script type="text/javascript">
if ($('#form_action').val() == 'edit')
{
	<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value) {
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
	CMSImages.addImage ("<?php echo $_smarty_tpl->tpl_vars['image']->value->getPK();?>
",<?php echo $_smarty_tpl->tpl_vars['image']->value->exportJSON();?>
);
	<?php } ?>
	CMSImages.Init();
}
else
{
	var parentEl	= $('#cms_images').parent();
	parentEl.children().remove();
	parentEl.append ('<p>You can add images after you have added the page.</p>');
}
</script><?php }} ?>
