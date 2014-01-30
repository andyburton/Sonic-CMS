{extends 'admin/page.tpl'}

{block 'content'}
<div class="content">

	<h3>Admin Login</h3>

	<form id="admin_login" action="/admin/auth/login" method="post">
		
		<p>
			<label for="username">Email address</label>
			<input type="input" id="username" name="username" />
		</p>

		<p>
			<label for="password">Password</label>
			<input type="password" id="password" name="password" />
		</p>

		<p>
			<input type="submit" id="btn_login" value="Login" class="submit" />
		</p>

	</form>
	
</div>
{/block}