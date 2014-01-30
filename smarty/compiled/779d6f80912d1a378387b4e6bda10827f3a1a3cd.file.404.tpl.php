<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 10:38:15
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/error/404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:161884908252ea238c6b6cf3-41432801%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '779d6f80912d1a378387b4e6bda10827f3a1a3cd' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/error/404.tpl',
      1 => 1389284530,
      2 => 'file',
    ),
    '153238847728f70ad3a95a44aec4027476255083' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/cms/homepage.tpl',
      1 => 1391076225,
      2 => 'file',
    ),
    '27e32801ff51b66e9a22a473f33e00d1640ed680' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/cms/page.tpl',
      1 => 1391078301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161884908252ea238c6b6cf3-41432801',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea238c88d3b7_14971689',
  'variables' => 
  array (
    'page' => 0,
    'search_query' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea238c88d3b7_14971689')) {function content_52ea238c88d3b7_14971689($_smarty_tpl) {?><?php if (!is_callable('smarty_function_menu')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.menu.php';
if (!is_callable('smarty_function_tree_path')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.tree_path.php';
if (!is_callable('smarty_function_messages')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.messages.php';
?><!DOCTYPE HTML>
<html lang="en">
<head>

	<title><?php echo $_smarty_tpl->tpl_vars['page']->value->get('title');?>
</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['page']->value->get('description');?>
" />
	<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['page']->value->get('keywords');?>
" />

	<link rel="stylesheet" href="/css/style.css" type="text/css" media="all" />
	

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/search.js"></script>
	

</head>
<body>
	
<div id="wrapper">
	
	<div id="header_container">
		<div class="content">
			
			<ul id="top_menu">
				<?php echo smarty_function_menu(array('type'=>'top','order'=>'name'),$_smarty_tpl);?>

			</ul>
			
			<form class="search_form">
				<input type="search" name="search_query" placeholder="Search website..." value="<?php echo $_smarty_tpl->tpl_vars['search_query']->value;?>
">
			</form>
				
		</div>	
	</div>
			
	<div id="path">
		<div class="content">
			You are here <?php echo smarty_function_tree_path(array('lowercase'=>true),$_smarty_tpl);?>

		</div>
	</div>

	<div id="content_container">
		<div class="content">
			
			<?php echo smarty_function_messages(array('url'=>true),$_smarty_tpl);?>

			
			<div class="content_wrapper">
				<div class="content_left">
				
					<h2><?php echo $_smarty_tpl->tpl_vars['page']->value->get('title');?>
</h2>
					<?php echo $_smarty_tpl->tpl_vars['page']->value->getContent();?>

				
				</div>

				<div id="side_menu">
					<h3>Children</h3>
					<ul>
						<?php echo smarty_function_menu(array('type'=>'sub','order'=>'name'),$_smarty_tpl);?>

					</ul>
				</div>
			</div>
				
		</div>
	</div>
	
	<div id="footer_container">
		<div class="content">
			Sonic-CMS from https://github.com/andyburton/Sonic-CMS
		</div>
	</div>

</div>


</body>
</html><?php }} ?>
