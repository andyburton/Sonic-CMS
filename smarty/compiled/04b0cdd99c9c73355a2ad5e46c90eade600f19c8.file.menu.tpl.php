<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:00:44
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:180553984252ea22ccb4ae79-33581592%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04b0cdd99c9c73355a2ad5e46c90eade600f19c8' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/menu.tpl',
      1 => 1384337049,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180553984252ea22ccb4ae79-33581592',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea22ccb79c22_01645168',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea22ccb79c22_01645168')) {function content_52ea22ccb79c22_01645168($_smarty_tpl) {?><ul class="menu">
	<li><a href="/admin">Admin Home</a></li>
	<?php if ($_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['user']->value->loggedIn()) {?>
	<li><a href="/admin/cms">CMS</a></li>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->admin) {?><li><a href="/admin/users">Users</a></li><?php }?>
	<li><a href="/admin/settings">Settings</a></li>
    <li><a href="/admin/auth/logout">Logout</a></li>
	<?php }?>
</ul><?php }} ?>
