<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:00:50
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:174116716052ea22d212f169-07923287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f320a3ae3aa8f201075e72f3da3d9a9fbc5cbfd' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/index.tpl',
      1 => 1369396461,
      2 => 'file',
    ),
    '67495e25f892d4de77e600eb097618f373fcb01d' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/admin/page.tpl',
      1 => 1390316735,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174116716052ea22d212f169-07923287',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea22d21ec056_27031405',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea22d21ec056_27031405')) {function content_52ea22d21ec056_27031405($_smarty_tpl) {?><?php if (!is_callable('smarty_function_messages')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.messages.php';
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

	<h3>Admin Panel</h3>
	
	<p>Please use the menu on the left to select which area you wish to make changes in.</p>
	
</div>

        </div>

    </div>

	<div id="footer"></div>

</div>
		
</body>
</html><?php }} ?>
