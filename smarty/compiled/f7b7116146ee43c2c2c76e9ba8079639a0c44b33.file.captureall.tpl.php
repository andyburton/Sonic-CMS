<?php /* Smarty version Smarty-3.1-DEV, created on 2014-01-30 11:08:58
         compiled from "/var/www/andy/GitHub/Sonic-CMS/smarty/templates/search/captureall.tpl" */ ?>
<?php /*%%SmartyHeaderCode:84257032752ea31de63c4b8-13022423%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7b7116146ee43c2c2c76e9ba8079639a0c44b33' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/search/captureall.tpl',
      1 => 1391080134,
      2 => 'file',
    ),
    '27e32801ff51b66e9a22a473f33e00d1640ed680' => 
    array (
      0 => '/var/www/andy/GitHub/Sonic-CMS/smarty/templates/cms/page.tpl',
      1 => 1391079904,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84257032752ea31de63c4b8-13022423',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_52ea31de82e5f8_49102523',
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
<?php if ($_valid && !is_callable('content_52ea31de82e5f8_49102523')) {function content_52ea31de82e5f8_49102523($_smarty_tpl) {?><?php if (!is_callable('smarty_function_menu')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.menu.php';
if (!is_callable('smarty_function_tree_path')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.tree_path.php';
if (!is_callable('smarty_function_messages')) include '/var/www/andy/GitHub/Sonic-CMS/smarty/plugins/function.messages.php';
if (!is_callable('smarty_modifier_truncate')) include '/var/www/andy/GitHub/smarty/plugins/modifier.truncate.php';
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
				
<div id="cms_search_results" class="search_results">

<form action="/search/" class="search_form">
	Searching for: 
	<input type="text" name="search_query" class="search_query" value="<?php echo $_smarty_tpl->tpl_vars['search_query']->value;?>
" placeholder="search query" />
	<input type="submit" class="submit" value="SEARCH" />
	<span class="page_num">Page <?php echo $_smarty_tpl->tpl_vars['result_page']->value;?>
 of <?php echo $_smarty_tpl->tpl_vars['result_pages']->value;?>
</span>
</form>

<?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['results']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value) {
$_smarty_tpl->tpl_vars['result']->_loop = true;
?>
<?php $_smarty_tpl->tpl_vars["resultpage"] = new Smarty_variable($_smarty_tpl->tpl_vars['result']->value->getPage(), null, 0);?>
<div class="search_result">
	<div class="name">
		<a href="<?php echo $_smarty_tpl->tpl_vars['resultpage']->value->generateURL();?>
" title="<?php echo $_smarty_tpl->tpl_vars['resultpage']->value->title;?>
"><?php echo $_smarty_tpl->tpl_vars['resultpage']->value->name_menu;?>
</a>
	</div>
	<div class="description">
		<p><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['result']->value->content,515);?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['resultpage']->value->generateURL();?>
" class="more">read more</a></p>
	</div>
</div>
<?php } ?>

<div class="pagination">
	<span class="count">Page <?php echo $_smarty_tpl->tpl_vars['result_page']->value;?>
 of <?php echo $_smarty_tpl->tpl_vars['result_pages']->value;?>
</span>
	<ul>
	<?php if ($_smarty_tpl->tpl_vars['search_start']->value-$_smarty_tpl->tpl_vars['search_count']->value<0) {?><li><span>&laquo;</span></li><?php } else { ?>
	<li><a href="?start=<?php echo $_smarty_tpl->tpl_vars['search_start']->value-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Previous page">&laquo;</a></li><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['result_pages']->value>6) {?>
		<?php if ($_smarty_tpl->tpl_vars['result_page']->value<=3) {?>
			<?php $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['num']->step = 1;$_smarty_tpl->tpl_vars['num']->total = (int) ceil(($_smarty_tpl->tpl_vars['num']->step > 0 ? 3+1 - (1) : 1-(3)+1)/abs($_smarty_tpl->tpl_vars['num']->step));
if ($_smarty_tpl->tpl_vars['num']->total > 0) {
for ($_smarty_tpl->tpl_vars['num']->value = 1, $_smarty_tpl->tpl_vars['num']->iteration = 1;$_smarty_tpl->tpl_vars['num']->iteration <= $_smarty_tpl->tpl_vars['num']->total;$_smarty_tpl->tpl_vars['num']->value += $_smarty_tpl->tpl_vars['num']->step, $_smarty_tpl->tpl_vars['num']->iteration++) {
$_smarty_tpl->tpl_vars['num']->first = $_smarty_tpl->tpl_vars['num']->iteration == 1;$_smarty_tpl->tpl_vars['num']->last = $_smarty_tpl->tpl_vars['num']->iteration == $_smarty_tpl->tpl_vars['num']->total;?>
				<?php if ($_smarty_tpl->tpl_vars['num']->value==$_smarty_tpl->tpl_vars['result_page']->value) {?><li><span class="current"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</span></li><?php } else { ?>
				<li><a href="?start=<?php echo ($_smarty_tpl->tpl_vars['num']->value*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page <?php echo $_smarty_tpl->tpl_vars['num']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</a></li><?php }?>
			<?php }} ?>
			<?php if ($_smarty_tpl->tpl_vars['result_page']->value==3) {?>
				<li><a href="?start=<?php echo (4*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page 4">4</a></li>
			<?php }?>
			<li><span>..</span></li>
			<li><a href="?start=<?php echo ($_smarty_tpl->tpl_vars['result_pages']->value*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page <?php echo $_smarty_tpl->tpl_vars['result_pages']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['result_pages']->value;?>
</a></li>
		<?php } elseif ($_smarty_tpl->tpl_vars['result_page']->value>=($_smarty_tpl->tpl_vars['result_pages']->value-2)) {?>
			<li><a href="?start=<?php echo (1*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page 1">1</a></li>
			<li><span>..</span></li>
			<?php if ($_smarty_tpl->tpl_vars['result_page']->value==$_smarty_tpl->tpl_vars['result_pages']->value-2) {?>
				<li><a href="?start=<?php echo (($_smarty_tpl->tpl_vars['result_pages']->value-3)*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page <?php echo $_smarty_tpl->tpl_vars['result_pages']->value-3;?>
"><?php echo $_smarty_tpl->tpl_vars['result_pages']->value-3;?>
</a></li>
			<?php }?>
			<?php $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['num']->step = 1;$_smarty_tpl->tpl_vars['num']->total = (int) ceil(($_smarty_tpl->tpl_vars['num']->step > 0 ? $_smarty_tpl->tpl_vars['result_pages']->value+1 - ($_smarty_tpl->tpl_vars['result_pages']->value-2) : $_smarty_tpl->tpl_vars['result_pages']->value-2-($_smarty_tpl->tpl_vars['result_pages']->value)+1)/abs($_smarty_tpl->tpl_vars['num']->step));
if ($_smarty_tpl->tpl_vars['num']->total > 0) {
for ($_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['result_pages']->value-2, $_smarty_tpl->tpl_vars['num']->iteration = 1;$_smarty_tpl->tpl_vars['num']->iteration <= $_smarty_tpl->tpl_vars['num']->total;$_smarty_tpl->tpl_vars['num']->value += $_smarty_tpl->tpl_vars['num']->step, $_smarty_tpl->tpl_vars['num']->iteration++) {
$_smarty_tpl->tpl_vars['num']->first = $_smarty_tpl->tpl_vars['num']->iteration == 1;$_smarty_tpl->tpl_vars['num']->last = $_smarty_tpl->tpl_vars['num']->iteration == $_smarty_tpl->tpl_vars['num']->total;?>
				<?php if ($_smarty_tpl->tpl_vars['num']->value==$_smarty_tpl->tpl_vars['result_page']->value) {?><li><span class="current"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</span></li><?php } else { ?>
				<li><a href="?start=<?php echo ($_smarty_tpl->tpl_vars['num']->value*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page <?php echo $_smarty_tpl->tpl_vars['num']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</a></li><?php }?>
			<?php }} ?>
		<?php } else { ?>
			<li><a href="?start=<?php echo (1*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page 1">1</a></li>
			<li><span>..</span></li>
			<?php $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['num']->step = 1;$_smarty_tpl->tpl_vars['num']->total = (int) ceil(($_smarty_tpl->tpl_vars['num']->step > 0 ? $_smarty_tpl->tpl_vars['result_page']->value+1+1 - ($_smarty_tpl->tpl_vars['result_page']->value-1) : $_smarty_tpl->tpl_vars['result_page']->value-1-($_smarty_tpl->tpl_vars['result_page']->value+1)+1)/abs($_smarty_tpl->tpl_vars['num']->step));
if ($_smarty_tpl->tpl_vars['num']->total > 0) {
for ($_smarty_tpl->tpl_vars['num']->value = $_smarty_tpl->tpl_vars['result_page']->value-1, $_smarty_tpl->tpl_vars['num']->iteration = 1;$_smarty_tpl->tpl_vars['num']->iteration <= $_smarty_tpl->tpl_vars['num']->total;$_smarty_tpl->tpl_vars['num']->value += $_smarty_tpl->tpl_vars['num']->step, $_smarty_tpl->tpl_vars['num']->iteration++) {
$_smarty_tpl->tpl_vars['num']->first = $_smarty_tpl->tpl_vars['num']->iteration == 1;$_smarty_tpl->tpl_vars['num']->last = $_smarty_tpl->tpl_vars['num']->iteration == $_smarty_tpl->tpl_vars['num']->total;?>
				<?php if ($_smarty_tpl->tpl_vars['num']->value==$_smarty_tpl->tpl_vars['result_page']->value) {?><li><span class="current"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</span></li><?php } else { ?>
				<li><a href="?start=<?php echo ($_smarty_tpl->tpl_vars['num']->value*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page <?php echo $_smarty_tpl->tpl_vars['num']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</a></li><?php }?>
			<?php }} ?>
			<li><span>..</span></li>
			<li><a href="?start=<?php echo ($_smarty_tpl->tpl_vars['result_pages']->value*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page <?php echo $_smarty_tpl->tpl_vars['result_pages']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['result_pages']->value;?>
</a></li>
		<?php }?>
	<?php } else { ?>
		<?php $_smarty_tpl->tpl_vars['num'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['num']->step = 1;$_smarty_tpl->tpl_vars['num']->total = (int) ceil(($_smarty_tpl->tpl_vars['num']->step > 0 ? $_smarty_tpl->tpl_vars['result_pages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['result_pages']->value)+1)/abs($_smarty_tpl->tpl_vars['num']->step));
if ($_smarty_tpl->tpl_vars['num']->total > 0) {
for ($_smarty_tpl->tpl_vars['num']->value = 1, $_smarty_tpl->tpl_vars['num']->iteration = 1;$_smarty_tpl->tpl_vars['num']->iteration <= $_smarty_tpl->tpl_vars['num']->total;$_smarty_tpl->tpl_vars['num']->value += $_smarty_tpl->tpl_vars['num']->step, $_smarty_tpl->tpl_vars['num']->iteration++) {
$_smarty_tpl->tpl_vars['num']->first = $_smarty_tpl->tpl_vars['num']->iteration == 1;$_smarty_tpl->tpl_vars['num']->last = $_smarty_tpl->tpl_vars['num']->iteration == $_smarty_tpl->tpl_vars['num']->total;?>
			<?php if ($_smarty_tpl->tpl_vars['num']->value==$_smarty_tpl->tpl_vars['result_page']->value) {?><li><span class="current"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</span></li><?php } else { ?>
			<li><a href="?start=<?php echo ($_smarty_tpl->tpl_vars['num']->value*$_smarty_tpl->tpl_vars['search_count']->value)-$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Page <?php echo $_smarty_tpl->tpl_vars['num']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['num']->value;?>
</a></li><?php }?>
		<?php }} ?>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['search_start']->value+$_smarty_tpl->tpl_vars['search_count']->value>$_smarty_tpl->tpl_vars['result_count']->value) {?><li><span>&raquo;</span></li><?php } else { ?>
	<li><a href="?start=<?php echo $_smarty_tpl->tpl_vars['search_start']->value+$_smarty_tpl->tpl_vars['search_count']->value;?>
" title="Next page">&raquo;</a></li><?php }?>
	</ul>
</div>

</div>

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
