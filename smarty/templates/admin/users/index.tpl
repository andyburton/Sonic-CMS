{extends 'admin/page.tpl'}

{block 'js'}
{literal}
<script type="text/javascript" src="/js/admin/list.js"></script>
<script type="text/javascript">
$(function (){
	AdminList.init ('users', 'Users', {name: "this.first_name + ' ' + this.last_name + ' (' + this.email + ')'"});
});
</script>
{/literal}
{/block}

{block 'content'}
<div class="content">
	<h3>Admin Users</h3>
	<p><a href="/admin/users/add" class="add">Add new user</a></p>
	<ul id="users" class="admin_list"></ul>
</div>
{/block}