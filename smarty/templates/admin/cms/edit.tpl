{extends 'admin/cms/addedit.tpl'}

{block 'content'}
<div class="content">
	
	<h3>Page - Edit</h3>

	<form id="admin_cms_page" action="?id={$page->getPK()}" method="post">
	<input type="hidden" id="form_action" name="form_action" value="edit" />
	
	{include file="admin/cms/form.tpl" action="edit" nocache}

	<p class="submit">
		<input type="submit" id="btn_edit" name="page_edit" value="Update Page" />
	</p>

	</form>

</div>
	
<div id="dialog-confirm" title="Are you sure?">
	<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
	<span class="msg">Are you sure you wish to remove this module?</span>
</div>
{/block}