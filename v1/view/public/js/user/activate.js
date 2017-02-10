/**
 * Script to activate user account
 */

(function($) {
	$(document).ready(function() {
		var uri = config.api_url + '/accounts/verify';
		/* Get Current URL */
		//var url = $.url(), source = url.attr('source');
		//var email = url.param("email");	
		//var verify_token = url.param("verify_token");
		var params = get_query();
		//$.url(source).param()
		console.log(params);
		//{"email":email,"verify_token":verify_token}
		$.ajax({
			url: uri,
			type: "GET",
			contentType: "application/json",
			crossDomain: true,
			dataType: "json",
			data: params,
			headers: {
				"x-client-id": "0000",
				"Content-Type": "application/json"
			}
		})
		// if everything is ok
		.done(function(data, textStatus, jqXHR) {
			//var uri;
			if(data.success==1){
				alertNotify(data.message, 'success');
			}
			console.log(data);
		})
		.fail(function(jqXHR, textStatus, errorThrown) {
			var response = JSON.parse(jqXHR.responseText);
			console.info(response.code);
			if(response.code == 4000 || response.code == 4003){
				alertNotify(response.description, 'error');
			}else{
				alertNotify("An error occurred. Please try again later", 'error');
			}
			console.info(response.description);
			//console.error(jqXHR);
		});
		
		function get_query(){
			var url = location.search;
			var qs = url.substring(url.indexOf('?') + 1).split('&');
			for(var i = 0, result = {}; i < qs.length; i++){
				qs[i] = qs[i].split('=');
				result[qs[i][0]] = decodeURIComponent(qs[i][1]);
			}
			return result;
		}
		
		function getParameterByName(name, url) {
			if (!url) {
			  url = window.location.href;
			}
			name = name.replace(/[\[\]]/g, "\\$&");
			var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
				results = regex.exec(url);
			if (!results) return null;
			if (!results[2]) return '';
			return decodeURIComponent(results[2].replace(/\+/g, " "));
		}
	});
})(jQuery);