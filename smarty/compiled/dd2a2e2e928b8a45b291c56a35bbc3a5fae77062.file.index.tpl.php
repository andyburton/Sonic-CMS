<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:00:58
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/settings/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121539360852ea22da90de69-54268839%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd2a2e2e928b8a45b291c56a35bbc3a5fae77062' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/settings/index.tpl',
      1 => 1369393723,
      2 => 'file',
    ),
    '67495e25f892d4de77e600eb097618f373fcb01d' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/page.tpl',
      1 => 1390316735,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121539360852ea22da90de69-54268839',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea22da9f6470_55222630',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea22da9f6470_55222630')) {function content_52ea22da9f6470_55222630($_smarty_tpl) {?><?php if (!is_callable('smarty_function_messages')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.messages.php';
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

	<h3>User Settings</h3>
	
	<form id="admin_settings" action="/admin/settings/update" method="post">
		
		<h3>User Details</h3>
		
		<p>
			<label for="user_first_name">First name</label>
			<input type="input" id="user_first_name" name="user_first_name" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->first_name;?>
" />
		</p>
		
		<p>
			<label for="user_last_name">Last name</label>
			<input type="input" id="user_last_name" name="user_last_name" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->last_name;?>
" />
		</p>
		
		<p>
			<label for="user_email">Email address</label>
			<input type="input" id="user_email" name="user_email" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->email;?>
" />
		</p>

		<h3>Change Password</h3>
		
		<p>
			<label for="user_password_current">Current password</label>
			<input type="password" id="user_password_current" name="user_password_current" />
		</p>
		
		<p>
			<label for="user_password">New password</label>
			<input type="password" id="user_password" name="user_password" />
		</p>
		
		<p>
			<label for="user_password_confirm">Confirm new password</label>
			<input type="password" id="user_password_confirm" name="user_password_confirm" />
		</p>
		
		<h3>Save Settings</h3>
		
		<p>
			<input type="submit" id="btn_save" value="Save" class="submit" />
		</p>

	</form>
	
</div>

        </div>

    </div>

	<div id="footer"></div>

</div>
		
</body>
</html><?php }} ?>
