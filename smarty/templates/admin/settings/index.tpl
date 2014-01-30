{extends 'admin/page.tpl'}

{block 'content'}
<div class="content">

	<h3>User Settings</h3>
	
	<form id="admin_settings" action="/admin/settings/update" method="post">
		
		<h3>User Details</h3>
		
		<p>
			<label for="user_first_name">First name</label>
			<input type="input" id="user_first_name" name="user_first_name" value="{$user->first_name}" />
		</p>
		
		<p>
			<label for="user_last_name">Last name</label>
			<input type="input" id="user_last_name" name="user_last_name" value="{$user->last_name}" />
		</p>
		
		<p>
			<label for="user_email">Email address</label>
			<input type="input" id="user_email" name="user_email" value="{$user->email}" />
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
{/block}