<ul class="menu">
	<li><a href="/admin">Admin Home</a></li>
	{if $user && $user->loggedIn()}
	<li><a href="/admin/cms">CMS</a></li>
	{if $user->admin}<li><a href="/admin/users">Users</a></li>{/if}
	<li><a href="/admin/settings">Settings</a></li>
    <li><a href="/admin/auth/logout">Logout</a></li>
	{/if}
</ul>