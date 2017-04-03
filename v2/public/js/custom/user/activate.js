/**
 * Script to activate user account
 */

(function($) {
	$(document).ready(function() {
		var uri = config.api_url + '/accounts/verify';
		/* Get Current URL */		
		var params = qs();
		console.log(params);
		if(params[0] == undefined){
			window.location.assign($('body').attr('data-base-url')+'/login');
		}
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
				$('.response-message').append('<p>'+ settings.i18n.translate("activate.1") +' <a href="'+$('body').attr('data-base-url')+'/login">'+ settings.i18n.translate("login.1") +'</a> </p>');
				setTimeout(function(){
					window.location.assign($('body').attr('data-base-url')+'/login');
				},3000);
			}
			console.log(data);
		})
		.fail(function(jqXHR, textStatus, errorThrown) {
			//if  status code is 400
			if(jqXHR.status == 400){
				var response = JSON.parse(jqXHR.responseText);
				console.info(response.code);
				if(response.code == 4000){
					alertNotify(response.description, 'error');
				}else if(response.code == 4010){
					alertNotify(response.description, 'warning');
				}else{
					alertNotify(settings.i18n.translate("error.1"), 'error');
				}
			}else{
				alertNotify(settings.i18n.translate("error.1"), 'error');
			}                   
		});				
	});
})(jQuery);