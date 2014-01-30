<h3 class="banner-head">301 Redirects</h3>
<div>
	<a href="#" id="redirect_add" class="add">Add new redirect</a>
	<div id="redirect_fields"></div>
</div>
<script type="text/javascript" src="/js/admin/cms/modules/redirect.js"></script>
<script type="text/javascript">
$(function(){
	Redirect.init ("#redirect_fields", "{$name}");
	{foreach $redirects as $redirect}
	Redirect.add ("{$redirect->redirect}",{$redirect->getPK()});
	{/foreach}
});
</script>