{extends 'admin/cms/addedit.tpl'}

{block 'content'}
<div class="content">
	
	<h3>Page - Add New</h3>

	<form id="admin_cms_page" action="" method="post">
	<input type="hidden" id="form_action" name="form_action" value="add" />
		
	{include file="admin/cms/form.tpl" nocache}

	<p class="submit">
		<input type="submit" id="btn_save" name="page_add" value="Add Page" />
	</p>

	</form>

</div>
	
<div id="dialog-confirm" title="Are you sure?">
	<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
	<span class="msg">Are you sure you wish to remove this module?</span>
</div>
{/block}