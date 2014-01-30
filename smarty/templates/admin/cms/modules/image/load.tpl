<h3 class="banner-head">Page Images</h3>
<input type="hidden" name="cms_module[{$module_id}]" value="true" />
<div>
	<p>Images will be updated immediatley when you add, edit or remove them. You will still need to save the page if you remove the module.</p>
	<ul id="cms_images"></ul>
	<div id="swfupload-control" class="uploader" style="display: none">
		<p>Upload upto 10 image files (jpg, png, gif), each having a maximum size of 10MB</p>
		<input type="button" id="button" />
		<p id="queuestatus"></p>
		<p id="errors"></p>
		<div id="output">
			<table id="queue" cellpadding="0" cellspacing="0">
				<tr>
					<th>#</th>
					<th>Filename</th>
					<th id="progress">Progress</th>
					<th>Filesize</th>
					<th>Progress</th>
					<th>Status</th>
					<th class="cancel">&nbsp;</th>
				</tr>
			</table>
		</div>
		<input type="hidden" id="phpsesh" name="phpsesh" value="{session_id()}" />
	</div>
</div>
<script type="text/javascript" src="/js/admin/cms/swfupload.main.js"></script>
<script type="text/javascript" src="/js/admin/cms/cmsupload.js"></script>
<script type="text/javascript" src="/js/admin/cms/modules/images.js"></script>
<script type="text/javascript">
if ($('#form_action').val() == 'edit')
{
	{foreach $images as $image}
	CMSImages.addImage ("{$image->getPK()}",{$image->exportJSON()});
	{/foreach}
	CMSImages.Init();
}
else
{
	var parentEl	= $('#cms_images').parent();
	parentEl.children().remove();
	parentEl.append ('<p>You can add images after you have added the page.</p>');
}
</script>