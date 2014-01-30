<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:01:05
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/users/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110193798652ea22e16fd0b9-36940502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae1a6908f68c79a7e2a824332e4e56394d7f731f' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/users/edit.tpl',
      1 => 1389716594,
      2 => 'file',
    ),
    '67495e25f892d4de77e600eb097618f373fcb01d' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/page.tpl',
      1 => 1390316735,
      2 => 'file',
    ),
    '30b8a846e9bed2f1218f96554a9358f421a20840' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/users/form.tpl',
      1 => 1384343749,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110193798652ea22e16fd0b9-36940502',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea22e1863f49_75435652',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea22e1863f49_75435652')) {function content_52ea22e1863f49_75435652($_smarty_tpl) {?><?php if (!is_callable('smarty_function_messages')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.messages.php';
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
	

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/admin/ajax.js"></script>
    <script type="text/javascript" src="/js/admin/message.js"></script>
	<script type="text/javascript" src="/js/admin/hovertip.js"></script>
	

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
	
	<h3>User - Edit</h3>

	<form id="admin_users" action="?id=<?php echo $_smarty_tpl->tpl_vars['newuser']->value->getPK();?>
" method="post">
		
	<?php /*  Call merged included template "admin/users/form.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("admin/users/form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('action'=>"edit"), 0, '110193798652ea22e16fd0b9-36940502');
content_52ea22e17e1941_98626115($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "admin/users/form.tpl" */?>

	<h3>Save Settings</h3>

	<p>
		<input type="submit" id="btn_edit" name="edit_user" value="Save" class="submit" />
	</p>

	</form>

</div>

        </div>

    </div>

	<div id="footer"></div>

</div>
		
</body>
</html><?php }} ?>
<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:01:05
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/users/form.tpl" */ ?>
<?php if ($_valid && !is_callable('content_52ea22e17e1941_98626115')) {function content_52ea22e17e1941_98626115($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_array')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/modifier.array.php';
if (!is_callable('smarty_function_html_radios')) include '/var/www/andy/GitHub/smarty/plugins/function.html_radios.php';
?><h3>User Details</h3>

<p>
	<label for="user_first_name">First name</label>
	<input type="input" id="user_first_name" name="user_first_name" value="<?php echo $_smarty_tpl->tpl_vars['newuser']->value->first_name;?>
" />
</p>

<p>
	<label for="user_last_name">Last name</label>
	<input type="input" id="user_last_name" name="user_last_name" value="<?php echo $_smarty_tpl->tpl_vars['newuser']->value->last_name;?>
" />
</p>

<p>
	<label for="user_email">Email address</label>
	<input type="input" id="user_email" name="user_email" value="<?php echo $_smarty_tpl->tpl_vars['newuser']->value->email;?>
" />
</p>

<p>
	<label for="user_admin">Super Admin</label>
	<div class="radioset">
	<?php echo smarty_function_html_radios(array('name'=>"user_admin",'id'=>"user_admin",'values'=>smarty_modifier_array("1,0"),'output'=>smarty_modifier_array("Yes,No"),'selected'=>$_smarty_tpl->tpl_vars['newuser']->value->admin),$_smarty_tpl);?>

	</div><br clear=all">
</p>

<p>
	<label for="user_active">Login Active</label>
	<div class="radioset">
	<?php echo smarty_function_html_radios(array('name'=>"user_active",'id'=>"user_active",'values'=>smarty_modifier_array("1,0"),'output'=>smarty_modifier_array("Yes,No"),'selected'=>$_smarty_tpl->tpl_vars['newuser']->value->active),$_smarty_tpl);?>

	</div><br clear=all">
</p>

<?php if ($_smarty_tpl->tpl_vars['action']->value=='edit') {?>
<h3>Change Password</h3>

<p>
	<label for="user_password">New password</label>
	<input type="password" id="user_password" name="user_password" />
</p>

<p>
	<label for="user_password_confirm">Confirm new password</label>
	<input type="password" id="user_password_confirm" name="user_password_confirm" />
</p>
<?php }?>
<br clear=all"><?php }} ?>
