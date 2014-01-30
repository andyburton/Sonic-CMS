{extends 'admin/page.tpl'}

{block 'css'}
<link rel="stylesheet" type="text/css" href="/css/admin/cms.css">
<link rel="stylesheet" type="text/css" href="/redactor/redactor.css">
{/block}

{block 'js'}
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="/redactor/redactor.min.js"></script>
<script type="text/javascript" src="/redactor/plugins/fontsize/fontsize.js"></script>
<script type="text/javascript" src="/redactor/plugins/fullscreen/fullscreen.js"></script>
<script type="text/javascript" src="/js/admin/cms/modules.js"></script>
<script>

CMS_Modules.setPageID({$page->getPK()});
{foreach $modules as $module}
	CMS_Modules.setModule ("{$module->getPK()}",{$module->toJSON()});
{/foreach}
{foreach $page_modules as $module}
	CMS_Modules.enableModule ("{$module->get('module_id')}");
{/foreach}

$(function(){

	var parent_cache = {};
	
	$('#parent_page').autocomplete ({
		minLength: 3,
		source: function (request, response) {

			var term = request.term;
			if (term in parent_cache) {
				response (parent_cache[term]);
				return;
			}
			
			$.getJSON ("/admin/api/cms/search_parent", request, function (data, status, xhr) {
				if (data.success && data.results)
				{
					parent_cache[term] = data.results;
					response (data.results);
				}
			});

		},
		select: function (event, ui) {
			$('#page_page_id').val (ui.item.id);
		}
	}).data ('ui-autocomplete')._renderItem = function (ul, item) {
		return $('<li>')
			.append ('<a>' + item.parent + ' > ' + item.value + '</a>')
			.appendTo (ul);
    };

	$('.page_content').redactor({
		minHeight	: 200,
		plugins		: ['fontsize','fullscreen'],
		imageUpload	: '/admin/api/cms/redactor/upload_image',
		imageGetJson: '/cms/gfx/images.json',
		imageUploadErrorCallback : function (json) {
			Message.addError (json.error);
			$('html, body').animate ({
				scrollTop: 0
			}, 500);
		},
		fileUpload	: '/admin/api/cms/redactor/upload_file',
		fileUploadErrorCallback : function (json) {
			Message.addError (json.error);
			$('html, body').animate ({
				scrollTop: 0
			}, 500);
		}
	});
	
});

</script>
{/block}