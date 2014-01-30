<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 11:04:58
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/cms/page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77292536552ea2ba6c4ada3-21572833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '27e32801ff51b66e9a22a473f33e00d1640ed680' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/cms/page.tpl',
      1 => 1391079904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77292536552ea2ba6c4ada3-21572833',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea2ba6da7808_28171100',
  'variables' => 
  array (
    'page' => 0,
    'search_query' => 0,
    'images' => 0,
    'image' => 0,
    'listing' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea2ba6da7808_28171100')) {function content_52ea2ba6da7808_28171100($_smarty_tpl) {?><?php if (!is_callable('smarty_function_menu')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.menu.php';
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
	<link rel="stylesheet" href="/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="/js/search.js"></script>
	
	
</head>
<body>
	
<div id="wrapper">
	
	<div id="header_container">
		<div class="content">
			
			<h1>
				Sonic-CMS from<br>
				<a href="https://github.com/andyburton/Sonic-CMS">https://github.com/andyburton/Sonic-CMS</a>
			</h1>
			
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
				
				<?php $_smarty_tpl->tpl_vars["images"] = new Smarty_variable($_smarty_tpl->tpl_vars['page']->value->loadModuleObjects('Images'), null, 0);?>
				<?php if ($_smarty_tpl->tpl_vars['images']->value) {?>
				<h2>Pictures</h2>
				<div class="images">
					<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value) {
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
						<a href="<?php echo $_smarty_tpl->tpl_vars['image']->value->getURL('original');?>
" class="fancybox" rel="group">
							<img src="<?php echo $_smarty_tpl->tpl_vars['image']->value->getURL('admin');?>
" title="<?php echo $_smarty_tpl->tpl_vars['listing']->value->name;?>
" />
						</a>
					<?php } ?>
				</div>
				<?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['page']->value->countSubPages()) {?>
				<div id="side_menu">
					<h3>Children</h3>
					<ul>
						<?php echo smarty_function_menu(array('type'=>'sub','order'=>'name'),$_smarty_tpl);?>

					</ul>
				</div>
				<?php }?>
			</div>
				
		</div>
	</div>
	
	<div id="footer_container">
		<div class="content">
			Sonic-CMS from <a href="https://github.com/andyburton/Sonic-CMS">https://github.com/andyburton/Sonic-CMS</a>
		</div>
	</div>

</div>


<script type="text/javascript" src="/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
</body>
</html><?php }} ?>
