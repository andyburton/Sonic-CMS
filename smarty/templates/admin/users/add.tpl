{extends 'admin/page.tpl'}

{block 'content'}
<div class="content">
	
	<h3>User - Add New</h3>

	<form id="admin_users" action="" method="post">
		
	{include file="admin/users/form.tpl" action="add" nocache}

	<h3>Save Settings</h3>

	<p>
		<input type="submit" id="btn_save" name="add_user" value="Save" class="submit" />
	</p>

	</form>

</div>
{/block}