/**
 * CMSUpload
 * jQuery orientated upload script (customised by Alex Hall) that allows
 * asynchronous uploads of multiple files simply and easily
 **/
var CMSUpload = function()
{

	var uploadIndex = 1,		// Sequence of images (for table)
	bytesTotal		= 0,		// Total number of bytes loaded
	bytesSoFar		= 0,		// Bytes uploaded so far
	initialise		= true,		// Used to reset anything after completion
	showImage		= false;	// Show the image in the status column on complete?

	return {

		/**
		 * CMSUpload.Init
		 * Initialise the uploader with various options and set up event
		 * listeners for uploader events
		 **/
		Init : function()
		{

			$("#output").hide();

			$('#swfupload-control')
			.swfupload({
				// Server settings
				upload_url: "/admin/api/cms/image/add",
				// File upload settings
				file_post_name: 'imagefile',
				file_size_limit : "10240",
				file_types : "*.jpg;*.png;*.gif",
				file_types_description : "Image files",
				file_upload_limit : 10,
				// Flash settings
				flash_url : "/js/admin/cms/swfupload.swf",
				// Button settings
				button_image_url : '/gfx/admin/wdp_buttons_upload_114x29.png',
				button_width : 114,
				button_height : 29,
//				button_text : '<span class="button">Select Images <span class="buttonSmall">(2 MB Max)</span></span>',
//				button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
				button_placeholder : $('#button')[0],
				button_cursor: SWFUpload.CURSOR.HAND,
				// Debug mode
				debug: false
			})
			.unbind(
				'fileQueued fileQueueError fileDialogComplete uploadStart uploadProgress uploadSuccess uploadComplete uploadError'
			)
			.bind({
				'fileQueued':			CMSUpload.fileQueued,
				'fileQueueError':		CMSUpload.fileQueueError,
				'fileDialogComplete':	CMSUpload.fileDialogComplete,
				'uploadStart':			CMSUpload.uploadStart,
				'uploadProgress':		CMSUpload.uploadProgress,
				'uploadSuccess':		CMSUpload.uploadSuccess,
				'uploadComplete':		CMSUpload.uploadComplete,
				'uploadError':			CMSUpload.uploadError
			}).show ();

		},

		/**
		 * CMSUpload.fileQueued
		 * File added to the queue. Add the HTML to the log table to show
		 * upload with various details
		 * @param event - ??
		 * @param file - details about the file that is to be uploaded
		 **/
		fileQueued : function(event, file)
		{

			if(initialise === true)
			{

				initialise = false;

				// Show the output container
				$("#output").slideDown("fast");

			}

			// No previous uploads, check this isn't a second round!
			if($("#overall").length > 0)
			{

				$("#overall").remove();

			}

			// Set up a list item (table row) for this upload
			var listitem = '<tr id="'+file.id+'">'+
				'<td>'+uploadIndex+'</td>'+
				'<td>'+file.name+'</td>'+
				'<td><div class="progressbar"><div class="progress"></div></div></td>'+
				'<td>'+CMSUpload.readablizeBytes(file.size)+'</td>'+
				'<td><span class="progressvalue">0%</span></td>'+
				'<td class="status">Pending</status>'+
				'<td class="cancel"><img src="/gfx/admin/cancel.png" alt="Cancel" class="close" /></td>'+
				'</tr>';

			// Append it to our queue table
			$('#queue').append(listitem);

			$('tr#'+file.id+' .cancel .close').bind('click', function()
			{

				var swfu = $.swfupload.getInstance('#swfupload-control');
				swfu.cancelUpload(file.id);
				$('tr#'+file.id).slideUp('fast');

				bytesTotal-= file.size;

			});

			bytesTotal+= file.size;

			var params = {
				"page_id" : $("#page_id").val(),
				"session_id" : $("#phpsesh").val()
			};
			
			$(this).swfupload('setPostParams', params);

			// start the upload since it's queued
			$(this).swfupload('startUpload');

			uploadIndex++;

		},

		/**
		 * CMSUpload.fileQueueError
		 * File could not be added to the queue for some reason
		 **/
		fileQueueError : function(event, file, message, errorCode)
		{

//			console.log("File: "+event.toSource()+" | File error: "+message+" | Code: "+errorCode);
			if(errorCode === '5')
			{

				$('#errors').text('Please select 5 or less files for upload');

			} else {

				$('#errors').text(errorCode);

			}

		},

		fileDialogComplete : function(event, numFilesSelected, numFilesQueued)
		{

			$('#queuestatus').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);

			var listitem = '<tr id="overall">'+
				'<td></td>'+
				'<td>Overall</td>'+
				'<td><div class="progressbar overall"><div class="progress"></div></div></td>'+
				'<td class="filesize">'+CMSUpload.readablizeBytes(bytesTotal)+'</td>'+
				'<td><span class="progressvalue">0%</span></td>'+
				'<td class="status"> </status>'+
				'<td class="cancel"> </td>'+
				'</tr>';

			$('#queue').append(listitem);

		},

		uploadStart : function(event, file)
		{

			var listEl = $('#queue tr#'+file.id);
			listEl.find('td.status').text('Uploading...');
			listEl.find('span.progressvalue').text('0%');
			listEl.find('td.cancel').html('<img src="/gfx/admin/loading.gif" alt="Uploading" />');

		},

		uploadProgress : function(event, file, bytesLoaded)
		{

			var listEl = $("#queue tr#"+file.id);
			//Show Progress
			var percentage = Math.round((bytesLoaded/file.size)*100);
			listEl.find('div.progress').css('width', percentage+'%');
			listEl.find('span.progressvalue').text(percentage+'%');

			if(percentage === 100)
			{
				listEl.find('td.status').html("Cropping...");
			}

			var overallEl = $("#queue tr#overall");
			// Update the overall percentage row
			var overallPercentage = Math.round(100*((bytesLoaded+bytesSoFar)/bytesTotal));
			overallEl.find('div.progress').css('width', overallPercentage+'%');
			overallEl.find('span.progressvalue').text(overallPercentage+'%');
			overallEl.find('td.filesize').text(CMSUpload.readablizeBytes(bytesTotal));

		},

		uploadSuccess : function(event, file, serverData)
		{
			
			
			var serverResponse = $.parseJSON(serverData);

//			console.log("Server response: "+serverResponse.toSource());

			// Add the bytes from the file to the bytes used so far
			bytesSoFar+= Math.round(file.size);

			// Check to see if the upload was a success
			if (serverResponse.success)
			{

				// Update the progress bar to a completed status
				var item = $('#queue tr#'+file.id);
				item.find('div.progress').addClass("success");
				item.find('span.progressvalue').text('100%');

//				var pathtofile = '<a href="uploads/'+file.name+'" target="_blank">view &raquo;</a>';
//				item.addClass('success').find('td.status').html('Done!!! | '+pathtofile);

				// Change the icon and text/image for the completed upload
				var rowHtml = showImage === true ? '<img src="uploads/'+file.name+'" alt="" style="height:80px;width:80px;" />' : "Complete";
				item.addClass('success').find('td.status').html(rowHtml);
				item.find('td.cancel').html('<img src="/gfx/admin/tick.png" alt="Uploaded" />');

				// Return the image object with the success response
				
				var obj	= $.parseJSON(serverResponse.obj);
				CMSImages.addImage (obj.id,obj);


			} else {

				// Update the progress bar to a completed status
				var item = $('#queue tr#'+file.id);
				item.find('div.progress').addClass("error");
				item.find('span.progressvalue').text('100%');

				item.addClass('error').find('td.status').html('Error...<span title="'+serverResponse.error_description+'">?</span>');
				item.find('td.cancel').html('<img src="/gfx/admin/cancel.png" alt="Uploaded" />');
				Message.showHoverTip(item,serverResponse.error_description);

			}

			var stats = $.swfupload.getInstance(this).getStats();
			if(stats.files_queued === 0)
			{

				// Completed!
				$("#queue tr#overall").find("span.progressvalue").text("100%");
				$("#queue tr#overall").find("div.progressbar").addClass("complete");
				initialise = true;

				setTimeout(function()
				{

					$("#output").slideUp("fast", function()
					{

						$("#queue").find("tr:gt(0)").remove();
						uploadIndex = 1;
						bytesTotal = 0;
						bytesSoFar = 0;

					});

				}, 3000);

			}

		},

		uploadComplete : function(event, file)
		{
			// upload has completed, try the next one in the queue
			$(this).swfupload('startUpload');
		},

		uploadError : function(event, file, errorCode, message)
		{
			$('#errors').text('Upload error - '+message);
		},

		readablizeBytes : function (bytes)
		{

			var s = ['bytes', 'kb', 'MB', 'GB', 'TB', 'PB'];
			var e = Math.floor(Math.log(bytes)/Math.log(1024));
			return (bytes/Math.pow(1024, Math.floor(e))).toFixed(2)+" "+s[e];

		},

		setupDragDrop : function()
		{

	        function isValidDrag(e){
	            var dt = e.dataTransfer,
	                // do not check dt.types.contains in webkit, because it crashes safari 4
	                isWebkit = navigator.userAgent.indexOf("AppleWebKit") > -1;

	            // dt.effectAllowed is none in Safari 5
	            // dt.types.contains check is for firefox
	            return dt && dt.effectAllowed != 'none' &&
	                (dt.files || (!isWebkit && dt.types.contains && dt.types.contains('Files')));
	        }

	        var self = this,
	            dropArea = this._getElement('drop');

	        dropArea.style.display = 'none';

	        var hideTimeout;
	        qq.attach(document, 'dragenter', function(e){
	            e.preventDefault();
	        });

	        qq.attach(document, 'dragover', function(e){
	            if (isValidDrag(e)){

	                if (hideTimeout){
	                    clearTimeout(hideTimeout);
	                }

	                if (dropArea == e.target || qq.contains(dropArea,e.target)){
	                    var effect = e.dataTransfer.effectAllowed;
	                    if (effect == 'move' || effect == 'linkMove'){
	                        e.dataTransfer.dropEffect = 'move'; // for FF (only move allowed)
	                    } else {
	                        e.dataTransfer.dropEffect = 'copy'; // for Chrome
	                    }
	                    qq.addClass(dropArea, self._classes.dropActive);
	                    e.stopPropagation();
	                } else {
	                    dropArea.style.display = 'block';
	                    e.dataTransfer.dropEffect = 'none';
	                }

	                e.preventDefault();
	            }
	        });

	        qq.attach(document, 'dragleave', function(e){
	            if (isValidDrag(e)){

	                if (dropArea == e.target || qq.contains(dropArea,e.target)){
	                    qq.removeClass(dropArea, self._classes.dropActive);
	                    e.stopPropagation();
	                } else {

	                    if (hideTimeout){
	                        clearTimeout(hideTimeout);
	                    }

	                    hideTimeout = setTimeout(function(){
	                        dropArea.style.display = 'none';
	                    }, 77);
	                }
	            }
	        });

	        qq.attach(dropArea, 'drop', function(e){
	            dropArea.style.display = 'none';
	            self._uploadFileList(e.dataTransfer.files);
	            e.preventDefault();
	        });
	    }

	}

}();

$(function(){
	if($("#swfupload-control").length === 1){
		CMSUpload.Init();
	}
});