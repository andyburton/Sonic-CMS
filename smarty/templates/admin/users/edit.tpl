{extends 'admin/page.tpl'}

{block 'content'}
<div class="content">
	
	<h3>User - Edit</h3>

	<form id="admin_users" action="?id={$newuser->getPK()}" method="post">
		
	{include file="admin/users/form.tpl" action="edit" nocache}

	<h3>Save Settings</h3>

	<p>
		<input type="submit" id="btn_edit" name="edit_user" value="Save" class="submit" />
	</p>

	</form>

</div>
{/block}