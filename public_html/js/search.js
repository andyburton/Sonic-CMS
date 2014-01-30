
$(function () {
	
	$('.search_form').submit (function () {
		
		var url		= '/search/' + $('input[name=search_query]', this).val ();
		var args	= [];
		
		if ($('select[name=search_count]', this).length) {
			args.push ('search_count=' + $('select[name=search_count]', this).val ());
		}
		
		if ($('select[name=search_start]', this).length) {
			args.push ('search_start=' + $('select[name=search_start]', this).val ());
		}
		
		if (args.length)
		{
			url += '?' + args.join ('&');
		}
		
		document.location.href = url;
		return false;
		
	});
	
});