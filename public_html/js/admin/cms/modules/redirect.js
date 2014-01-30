$('#redirect_add').click (function (e) {
	Redirect.add ();
	return false;
});

var Redirect = function ()
{
	return {

		el		: false,
		name	: '',
		newid	: 0,
		
		init : function (el, name)
		{
			this.el		= el;
			this.name	= name;
		},
		
		add : function (url, id)
		{
			
			if (typeof url === 'undefined')
			{
				url = '';
			}
			
			if (typeof id === 'undefined')
			{
				id = 'new-' + ++this.newid;
			}
			
			var inputID	= this.getInputID (id);
			
			var p		= $('<p>' +
			  '<input type="name" name="' + inputID + ']" id="' + inputID + '" value="' + url + '" maxlength="500" class="xwide" />' +
			  '</p>').appendTo (this.el);
		  
			$('<span class="delete"></span>').click (function (e) {
				p.remove ();
			}).appendTo (p);
			
		},
		
		getInputID : function (id)
		{
			return this.name + '[redirects][' + id + ']';
		}
	
	}
}();
		
		