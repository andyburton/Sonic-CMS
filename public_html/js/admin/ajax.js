
function adminGetJSON (url, data, func)
{
	var request = $.getJSON (url, data, function (json) {
		json.success? request.done (func) : (json.auth_error? location.reload () : Message.addError (json.error_description));
	});	return request;
}

function adminPost (url, data, func)
{
	var request = $.post (url, data, function (json) {
		json.success? request.done (func) : (json.auth_error? location.reload () : Message.addError (json.error_description));
	});	return request;
}