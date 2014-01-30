<h3>User Details</h3>

<p>
	<label for="user_first_name">First name</label>
	<input type="input" id="user_first_name" name="user_first_name" value="{$newuser->first_name}" />
</p>

<p>
	<label for="user_last_name">Last name</label>
	<input type="input" id="user_last_name" name="user_last_name" value="{$newuser->last_name}" />
</p>

<p>
	<label for="user_email">Email address</label>
	<input type="input" id="user_email" name="user_email" value="{$newuser->email}" />
</p>

<p>
	<label for="user_admin">Super Admin</label>
	<div class="radioset">
	{html_radios name="user_admin" id="user_admin" values="1,0"|array output="Yes,No"|array selected=$newuser->admin}
	</div><br clear=all">
</p>

<p>
	<label for="user_active">Login Active</label>
	<div class="radioset">
	{html_radios name="user_active" id="user_active" values="1,0"|array output="Yes,No"|array selected=$newuser->active}
	</div><br clear=all">
</p>

{if $action == 'edit'}
<h3>Change Password</h3>

<p>
	<label for="user_password">New password</label>
	<input type="password" id="user_password" name="user_password" />
</p>

<p>
	<label for="user_password_confirm">Confirm new password</label>
	<input type="password" id="user_password_confirm" name="user_password_confirm" />
</p>
{/if}
<br clear=all">