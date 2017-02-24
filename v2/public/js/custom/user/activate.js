/**
 * Script to activate user account
 */

(function($) {
	$(document).ready(function() {
		var uri = config.api_url + '/accounts/verify';
		/* Get Current URL */		
		var params = get_query();
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
				$('.response-message').append('<p> If you are not redirected to log in page in 3 secondes, Please click on the following link: <a href="'+$('body').attr('data-base-url')+'/login">Log in</a> </p>');
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
					alertNotify("An internal server error occurred. Please try again later", 'error');
				}
			}else{
				alertNotify("An internal server error occurred. Please try again later", 'error');
			}                   
		});				
	});
})(jQuery);