
/**
 * CMS_Modules
 * Controls loading, unloading and modifying of page modules when editing a
 * page in the CMS system
 */

var CMS_Modules = function ()
{

	return {

		apiURL		: '/admin/api/cms/',
		pageID		: false,
		Modules		: {},

		/**
		 * CMS_Modules.Init
		 * Setup modules click events and show any currently loaded modules
		 */
		
		Init : function ()
		{

			// Add modules

			$.each (CMS_Modules.Modules, function (index, id)
			{
				CMS_Modules.initModule (CMS_Modules.Modules[index]);
			});

			// Click event to hide and show the individual module settings

			$('#cms_module_settings').on ('click', '.banner-head', function () {
				if ($(this).hasClass ('expand')) {
					$(this).removeClass ('expand').addClass ('expanded');
					$(this).next ().slideUp ('fast');
				} else {
					$(this).removeClass ('expanded').addClass ('expand');
					$(this).next ().slideDown ('fast');
				}
			});

		},

		initModule : function (obj)
		{

			if (obj.enabled)
			{

				$('<div>').addClass ('enabled').text (obj.name).button ({
					icons: {
						primary: 'ui-icon-check'
					}
				}).click (function () {
					CMS_Modules.removeModule (obj, $(this));
				}).appendTo ("#cms_modules .cms_module[module='" + obj.id + "']");

				CMS_Modules.loadTemplate (obj);

			}
			else
			{

				$('<div>').addClass ('disabled').text (obj.name).button ({
					icons: {
						primary: 'ui-icon-circle-plus'
					}
				}).click (function () {
					CMS_Modules.addModule(obj, $(this));
				}).appendTo ("#cms_modules .cms_module[module='" + obj.id + "']");

			}

		},

		setPageID : function (id)
		{
			this.pageID = id;
		},

		setModule : function (id, obj)
		{

			if (!obj.enabled)
			{
				obj.enabled	= false;
			}

			this.Modules[id] = obj;

		},

		addModule : function (obj, el)
		{

			if (obj.enabled === false)
			{
				
				CMS_Modules.loadTemplate (obj);
				CMS_Modules.enableModule (obj.id);
				
				$('html, body').animate({
					scrollTop: $('#module' + obj.id).offset().top
				}, 1000);
				
				el.addClass ('enabled')
				.removeClass ('disabled')	
				.button ('option', 'icons', {primary:'ui-icon-check'})
				.unbind ('click')
				.click (function () {
					CMS_Modules.removeModule (obj, $(this));
				});

			} else {
				Message.showHoverTip(el, 'That module has already been enabled.');
			}

		},

		loadTemplate : function (obj)
		{
			
			var module = $('<div id="module' + obj.id +'" module="' + obj.id + '" module_name="' + obj.name + '">');
			module.appendTo ('#cms_module_settings');
			
			if (obj.api)
			{
				adminPost (CMS_Modules.apiURL + obj.api + '/load', {
						page_id:	CMS_Modules.pageID,
						module_id:	obj.id
					}, function (json) {
						
						if (json.template)
						{
							module.html (json.template);
							$('#module' + obj.id + ' > .banner-head').addClass ('expand').attr ('title', 'Show/Hide');
							$('#module' + obj.id).slideDown ('fast');
						}
						
					}
				);
			}
			
			// Else no api
			
			else
			{
				module.append ('<input type="hidden" name="cms_module[' + obj.id + ']" value="true">');		
			}

		},

		removeModule : function (obj, el)
		{

			$('#dialog-confirm').dialog ({
				resizable:	false,
				modal:		true,
				buttons:	{
					'Remove Module': function () {

						CMS_Modules.closeModule (obj);
						CMS_Modules.disableModule (obj.id);
						
						el.removeClass ('enabled')
						.addClass ('disabled')
						.button ('option', 'icons', {primary:'ui-icon-circle-plus'})
						.unbind ('click')
						.click (function () {
							CMS_Modules.addModule (obj, $(this));
						});

						$(this).dialog ('close');

					},
					Cancel: function(){
						$(this).dialog ('close');
					}
				}
			});

		},

		closeModule : function(obj)
		{
			$("#cms_module_settings [module='" + obj.id + "']").slideUp ('fast', function () {
				$(this).remove();
			})
		},

		enableModule : function (id)
		{
			this.Modules[id].enabled = true;
		},

		disableModule : function (id)
		{
			this.Modules[id].enabled = false;
		}

	}

}();

$(function () {
	CMS_Modules.Init ();
});