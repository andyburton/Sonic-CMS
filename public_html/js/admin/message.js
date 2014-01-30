
var Message = function ()
{

	return {
		
		Init : function ()
		{
			$('.message_container').click (function ()
			{
				Message.closeMessage ();
				return false;
			});
		},

		addMessage : function (msg)
		{
			$('.message_container').html ('<div class="message_success"><p>'+msg+'</p></div>').click (function ()
			{
				Message.closeMessage ();
				return false;
			});
		},

		addError : function (msg)
		{
			$('.message_container').html ('<div class="message_error"><p>'+msg+'</p></div>').click (function ()
			{
				Message.closeMessage ();
				return false;
			});
		},
		
		closeMessage : function ()
		{
			$('.message_container .message_success, .message_container .message_error').fadeOut ('fast', function ()
			{
				$(this).html ('').removeClass ('ui-widget');
			});
		},
		
		/**
		 * Message.setHoverTips
		 * Creates tooltips for elements with a specific class
		 */
		
		setHoverTips : function()
		{

			if($("#hoverTip").length === 0)
			{
				$("body").append('<div id="hoverTip">'+
					'<img src="/gfx/admin/hovertip.gif" alt="Tip Arrow" />'+
					'<div id="hoverTipInner">'+
					'</div></div>');
				$("#hoverTip").hide();
			}

			$(".infoHover").each(function(){
				$(this).next(".infoHover_txt").hide();
			}).mouseover(function(){
				var originalEl = $(this);
				$("#hoverTipInner").html("<p>"+$(this).next(".infoHover_txt").html()+"</p>");
				$("#hoverTip").stop(true, true).fadeIn();
			}).mousemove(function(e){
				$("#hoverTipInner").html("<p>"+$(this).next(".infoHover_txt").html()+"</p>");
				var halfHeight = (($("#hoverTip").height())/2) + 5; // Get the height, divide by 2 then add the padding
				$("#hoverTip").css({"top":(e.pageY-halfHeight)+"px","left":(e.pageX+15)+"px"})
			}).mouseout(function(){
				Message.hideHoverTip();
			});

		},

		showHoverTip : function(el,msg,type,pos)
		{

			if($("#hoverTip").length === 0)
			{
				$("body").append('<div id="hoverTip">'+
					'<img src="/gfx/admin/hovertip_r.gif" alt="Tip Arrow" />'+
					'<div id="hoverTipInner">'+
					'</div></div>');
				$("#hoverTip").hide();
			}

			switch(type)
			{
				case 'success':
					strClass = "successTip";
					break;

				default:
					strClass = "errorTip";
					break;
			}

			switch(pos)
			{

				case "left":
					var options = {
						of: $(el),
						my: "right top",
						at: "left top",
						offset: "-15 0"
					};
					$("#hoverTip").addClass("left").find("img").attr("src","/gfx/admin/hovertip_l.gif");
					break;

				case "right":
				default:
					options = {
						of: $(el),
						my: "top left",
						at: "top right",
						offset: "15 0"
					};
					$("#hoverTip").addClass("right").find("img").attr("src","/gfx/admin/hovertip_r.gif");
					break;

			}

			$("#hoverTipInner").html("<p>"+msg+"</p>").addClass(strClass);
			$("#hoverTip").fadeIn("fast").position(options);

			setTimeout(Message.hideHoverTip, 3000);

		},

		hideHoverTip : function()
		{
			$("#hoverTip").stop(true, true).fadeOut("fast",function(){
				$("#hoverTipInner").html("").removeClass("errorTip").removeClass("successTip");
			}).removeClass("left").removeClass("right");
		},

		highlightElement : function(el, type)
		{

			switch(type)
			{

				case 'success':
					strColor = "#D9FFA9";
					break;

				case 'info':
					strColor = "#ffff99";
					break;

				default:
					strColor = "#FFD0D4";
					break;

			}

			var oldColor = el.css("backgroundColor");
			el.animate({'backgroundColor' : strColor}, 1000, function(){
				setTimeout(function(){
					el.animate({"backgroundColor": oldColor}, 1000);
				}, 100);
			});

		}

	}

}();

$(function (){
	Message.Init ();
});