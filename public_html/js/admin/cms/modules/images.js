var CMSImages = function()
{

	return {

		apiURL		: '/admin/api/cms/image/',
		apiMethod	: 'POST',
		pageID		: false,
		Images		: {},

		Init : function()
		{

			CMSImages.pageID = $("#page_id").val();

			$("p.cmsimage-image").next().hide();

			$("a.edit-cmsimage").on ("click", function()
			{
				CMSImages.showEdit($(this));
				return false;
			});

			$("a.delete-cmsimage").on ("click", function()
			{
				CMSImages.removeImage($(this));
				return false;
			});

			$("img.cmsimage-close").on ("click", function()
			{
				CMSImages.hideEdit($(this));
			});

			$(".cmsimage-edit").on ("submit", function()
			{
				CMSImages.saveImage($(this));
				return false;
			});

			$("#cms_images").sortable();
//			$("#cms_images").disableSelection();

			$("#cms_images").on ("sortupdate", function(event, ui) {
				CMSImages.updateImagePosition();
			});

		},

		addImage : function (id, obj)
		{

			this.Images[id] = obj;

			$('<li cms_image_id="' + id + '" class="images-draggable ui-state-default"></li>').html (
				'<p class="cmsimage-image">\
					<strong>Image ' + obj.order_id + '</strong>\
					<img src="' + obj.icon + '" />\
					<a href="" title="Edit Image Details" class="edit-cmsimage">\
						<img src="/gfx/admin/edit.png" alt="Edit Image" />\
					</a>\
					<a href="" title="Delete Image" class="delete-cmsimage">\
						<img src="/gfx/admin/delete.png" alt="Delete Image" />\
					</a>\
				</p>\
				<form id="cmsimage' + id + '" class="cmsimage-edit" method="post" action="">\
					<p>\
						<label>Order ID:</label>\
						<input type="text" name="order_id" value="' + obj.order_id + '" maxlength="5" />\
					</p>\
					<p>\
						<label>Title:</label>\
						<input type="text" name="image_title" value="' + obj.title + '" maxlength="255" />\
					</p>\
					<p>\
						<label>Description:</label>\
						<textarea name="image_description" rows="3" cols="50">' + obj.description + '</textarea>\
					</p>\
					<img src="/gfx/admin/close_w.gif" alt="Close" class="cmsimage-close" />\
					<p>\
						<input type="submit" name="save-module" value="Save Settings" class="submit" />\
					</p>\
				</form>'
			).hide().appendTo ("#cms_images").fadeIn();

			$('.cms_image_details input,.cms_image_details textarea').change (function ()
			{
				CMSImages.newUpdate ();
			});

			$("p.cmsimage-image").next().hide();

			$(".cmsimage-edit").unbind("submit").bind("submit", function()
			{
				CMSImages.saveImage($(this));
				return false;
			});

		},

		newUpdate : function ()
		{
			$("#cms_image_update_btn").button ("option", "icons", {primary:'ui-icon-alert'});
		},

		showEdit : function (el)
		{

			$(".cmsimage-edit").hide();

			var editEl = el.parent().next();
			editEl.css("position","absolute").show().position({
				of: editEl.parent(),
				my: "left top",
				at: "right top",
				offset: "10 0"
			});

		},

		hideEdit : function (el)
		{
			el.parent().hide();
		},

		saveImage : function (formEl)
		{
			
			var imageId = formEl.parent().attr("cms_image_id");

			$.ajax({
				type:	CMSImages.apiMethod,
				url:	CMSImages.apiURL + 'update',
				data:	formEl.serialize()+"&cms_image_id="+imageId+"&page_id="+CMSImages.pageID,
				success: function(data)
				{
					if (data.success)
					{
						Message.showHoverTip(formEl.prev(), "The image details have been updated successfully.", "success", "left");
						Message.highlightElement(formEl, "success");
					} else {
						Message.showHoverTip(formEl.prev(), "The image details could not be updated: "+data.error_description, "error", "left");
						Message.highlightElement(formEl);
					}
				}
			});

		},

		removeImage : function(el)
		{

			var imageId = el.parent().parent().attr("cms_image_id");

			$("#dialog-confirm").find("span.msg").eq(0).html("Are you sure you wish to remove this image?");
			$("#dialog-confirm").dialog({
				resizable: false,
				modal: true,
				buttons: {
					"Remove Image": function()
					{

						$.ajax({
							type:		CMSImages.apiMethod,
							url:		CMSImages.apiURL + 'remove',
							data:		{
								page_id:	CMSImages.pageID,
								cms_image_id:	imageId
							},
							dataType:	"json",
							cache:		false,
							success: function(data)
							{
								
								if (data.success)
								{
									el.parent().parent().fadeOut (function (){
										$(this).remove();
									});
								} else {
									Message.showHoverTip(el.parent(),"The image could not be removed at this time.");
								}

							}
						});
						// Call ajax and then close the dialog
						$(this).dialog("close");

					},
					Cancel: function()
					{

						// Close the dialog
						$(this).dialog("close");

					}
				}
			});

		},

		updateImagePosition : function()
		{
			
			var imageOrder = [];

			$("#cms_images li.images-draggable").each(function(index,el)
			{
				imageOrder.push({"image_id":$(this).attr("cms_image_id"),"order_id":(index + 1)});
			});

			$.ajax({
				type:		CMSImages.apiMethod,
				url:		CMSImages.apiURL + 'update_order',
				data:		{
					page_id:	CMSImages.pageID,
					images: 	imageOrder
				},
				success:	function(data)
				{

					if(data.success)
					{

						$("#cms_images li.images-draggable").each(function(index,el)
						{
							$(this).find("strong").text("Image "+(index + 1));
							$(this).find("input[name=order_id]").val(index + 1);
						});

						Message.showHoverTip($("#cms_images").prev(),"The image order has been updated successfully.", "success");
						Message.highlightElement($("#cms_images").parent(), "success");

					} else {

						Message.showHoverTip($("#cms_images").prev(),"The image order could not be updated at this time.");
						Message.highlightElement($("#cms_images").parent());

					}

				}
			});

		}

	}

}();

$(function()
{
	CMSImages.Init();
});