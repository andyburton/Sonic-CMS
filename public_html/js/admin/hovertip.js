
var HoverTip = function ()
{

	return {
		
		Init : function ()
		{
			if ($('.infoHover').length > 0)
			{
				HoverTip.setHoverTips ();
			}

			if ($('form').length > 0)
			{
				$('form input').eq (0).focus ();
			}

		},
		
		/**
		 * HoverTip.setHoverTips
		 * Creates tooltips for elements with a specific class
		 **/
		
		setHoverTips : function ()
		{

			if ($('#hoverTip').length === 0)
			{
				$('body').append ('<div id="hoverTip">'+
					'<img src="/gfx/admin/hovertip_r.gif" alt="Tip Arrow" />'+
					'<div id="hoverTipInner">'+
					'</div></div>');
				$('hoverTip').hide ();
			}

			$('.infoHover').each (function () {
				$(this).next ('.infoHover_txt').hide ();
			}).mouseover (function () {
				
				$('#hoverTipInner').html ('<p>' + $(this).next ('.infoHover_txt').html () + '</p>');
				$('#hoverTip').stop (true, true).fadeIn ();
				
			}).mousemove(function(e) {
				
				$('#hoverTipInner').html ('<p>' + $(this).next ('.infoHover_txt').html () + '</p>');
				
				var halfHeight = (($('#hoverTip').height ())/2) + 5; // Get the height, divide by 2 then add the padding
				
				$('#hoverTip').css ({
					'top':(e.pageY-halfHeight)+'px',
					'left':(e.pageX+15)+'px'
				})

			}).mouseout (function () {
				HoverTip.hideHoverTip ();
			});

		},

		showHoverTip : function (el, msg, type, pos)
		{

			if ($('#hoverTip').length === 0)
			{
				$('body').append ('<div id="hoverTip">'+
					'<img src="/gfx/admin/hovertip_r.gif" alt="Tip Arrow" />'+
					'<div id="hoverTipInner">'+
					'</div></div>');
				$('hoverTip').hide ();
			}

			switch (type)
			{

				case 'success':
					var className = 'successTip';
					break;

				default:
					var className = 'errorTip';
					break;

			}

			switch (pos)
			{

				case 'left':
					var options = {
						of: $(el),
						my: 'right top',
						at: 'left top',
						offset: '-15 0'
					};
					$('#hoverTip').addClass ('left').find ('img').attr ('src','/gfx/admin/hovertip_l.gif');
					break;

				case 'right':
				default:
					var options = {
						of: $(el),
						my: 'top left',
						at: 'top right',
						offset: '15 0'
					};
					$('#hoverTip').addClass ('right').find ('img').attr ('src','/gfx/admin/hovertip_r.gif');
					break;

			}

			$('#hoverTipInner').html( '<p>'+msg+'</p>').addClass (className);
			$('#hoverTip').fadeIn ('fast').position (options);

			setTimeout (HoverTip.hideHoverTip, 3000);

		},

		hideHoverTip : function ()
		{
			$('#hoverTip').stop (true, true).fadeOut ('fast', function () {
				$('#hoverTipInner').html('').removeClass ('errorTip').removeClass ('successTip');
			}).removeClass ('left').removeClass ('right');
		}

	}

}();

$(function(){
	HoverTip.Init();
});