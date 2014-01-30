<div class="left column">

	<h3>Page Details</h3>
	
	<input type="hidden" name="page_id" id="page_id" value="{$page->getPK()}" />
	
	<p>
		<label for="page_name">Name <span class="req">*</span></label>
		<input type="text" name="page_name" id="page_name" value="{$page->name}" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The name that will be displayed in the admin to distinguish the page.</span>
	</p>

	<p>
		<label for="page_title">Title</label>
		<input type="text" name="page_title" id="page_title" value="{$page->title}" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The page browser title.<br />
		This is important for search engine optimisation and can be seen at the top of the browser window and in the task bar.</span>
	</p>
	
	<p>
		<label for="page_name_menu">Link Text <span class="req">*</span></label>
		<input type="text" name="page_name_menu" id="page_name_menu" value="{$page->name_menu}" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The text that will be displayed for the page in the menu.</span>
	</p>
	
	<p>
		<label for="page_redirect">Path</label>
		<input type="text" name="page_redirect" id="page_redirect" value="{$page->redirect}" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">A custom URL path to the page.<br />
		E.g. entering "contact" would set http://www.yourdomain.com/contact to load the page. This is very useful for search engine optimisation.</span>
	</p>

	<p>
		<label for="page_description">Description</label>
		<textarea name="page_description" id="page_description" rows="3" class="normal">{$page->description}</textarea>
		<span class="infoHover"></span>
		<span class="infoHover_txt">A short page description.<br />
		This is used for the META description tag.</span>
	</p>

	<p>
		<label for="page_keywords">Keywords</label>
		<textarea name="page_keywords" id="page_keywords" rows="2" class="normal">{$page->keywords}</textarea>
		<span class="infoHover"></span>
		<span class="infoHover_txt">A list of keywords.<br />
		This is used for the META keywords tag and should be entered in a comma delimited format e.g. keyword A, keyword B, keyword C.</span>
	</p>
	
</div>

<div class="right column">

	<h3>Page Settings</h3>

	<p>
		<label for="page_page_id">Parent Page</label>
		<input type="hidden" name="page_page_id" id="page_page_id" value="{$page->page_id}" />
		<input type="text" name="parent_page" id="parent_page" value="{$page_parent->name}" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The parent page that the current page belongs under.</span>
	</p>

	<p>
		<label for="page_order_id">Order ID</label>
		<input type="text" name="page_order_id" id="page_order_id" value="{$page->order_id}" maxlength="8" class="xxsmall" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">The order of the page in relation to other pages with the same parent.</span>
	</p>
	

	<p>
		<label for="page_template_id">Template</label>
		<select name="page_template_id" id="page_template_id">
		{html_options options=$templates selected=$page->template_id}
		</select>
		<span class="infoHover"></span>
		<span class="infoHover_txt">The template for the page layout.</span>
	</p>
	
	<p>
		<label for="page_external_url">External URL</label>
		<input type="text" name="page_external_url" id="page_external_url" value="{$page->external_url}" maxlength="255" class="normal" />
		<span class="infoHover"></span>
		<span class="infoHover_txt">An external web address that this page redirects to.</span>
	</p>
	
	<p>
		<label for="page_homepage">Homepage</label>
		<div class="radioset">
		{html_radios name="page_homepage" id="page_homepage" values="1,0"|array output="Yes,No"|array selected=$page->homepage}
		</div>
		<span class="infoHover"></span>
		<span class="infoHover_txt">Whether the current page is the website homepage or not.<br>
		There can only be 1 homepage for the website. If this is set to yes any other homepage will be set to no.</span>
		<br clear="all" />
	</p>

	<p>
		<label for="page_state_menu">Menu</label>
		<div class="radioset">
		{html_radios name="page_state_menu" id="page_state_menu" values="1,0"|array output="Yes,No"|array selected=$page->state_menu}
		</div>
		<span class="infoHover"></span>
		<span class="infoHover_txt">Whether the page should appear in the website menu or not.</span>
	</p>
	
	<p>
		<label for="page_state_active">Page Status</label>
		<div class="radioset">
		{html_radios name="page_state_active" id="page_state_active" values="1,0"|array output="Active,Inactive"|array selected=$page->state_active}
		</div>
		<span class="infoHover"></span>
		<span class="infoHover_txt">If the page is active it can be accessed by anybody.<br>
		If the page is set to inactive it cannot be viewed or linked to publically, as if the page did not exist.</span>
	</p>
	
</div>
<br clear="both" />
		
{if $modules}
	<h3>Page Modules</h3>
	<div id="cms_modules">
	{foreach $modules as $module}
		<div class="cms_module" module="{$module->getPK()}"></div>
	{/foreach}
	</div>
	<br clear="both" />
	<div id="cms_module_settings"></div>
{/if}

{foreach $page_content as $content}
	<h3>{$content->name|default:'Page Content'}</h3>
	<textarea name="cms_page_content[{$content->getPK()}]" class="xxwide page_content">{$content->content}</textarea>
{/foreach}

{if !$page_content}
	<h3>Page Content</h3>
	<textarea name="cms_page_content[0]" class="xxwide page_content"></textarea>
{/if}